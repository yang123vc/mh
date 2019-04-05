<?php

namespace App\Http\Controllers;

use App\Http\Helper\Ip;
use App\Models\Banner;
use App\Models\Browsing_history;
use App\Models\Cartoon;
use App\Models\Cartoon_list;
use App\Models\Cate;
use App\Models\Collect;
use App\Models\Footprint;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    use Ip;
    /**首页页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $ip=$this->getIp();

        $nowDayFirst = date('Y-m-d').' 00:00:00'; //当天开始时间
        $nowDayLast  = date('Y-m-d').' 23:59:59'; //当天结束时间

        //访问地址IP记录
        if(!Browsing_history::where('ip',$ip)->whereBetween('created_at',[$nowDayFirst,$nowDayLast])->first()){
            $city = $this->getCity($ip);

            Browsing_history::create([
                'ip' => $ip,
                'city' => $city
            ]);
        }

        //判断是否是分享链接流量
        if($request->has('share_user_id')){
            $share_user_id = decrypt($request->share_user_id);
            session()->put(['share_user_id'=>$share_user_id]);
        }

        $banners = Banner::select(
            'image',
            'cartoon_id'
        )
            ->get()
            ->toArray();    //轮播图

        $cartoons_first_thumb = Cartoon::where('recommend',3)
            ->where('cate_id',1)
            ->first();      //强烈推荐大图

        $cartoons_firsts = Cartoon::where('recommend','!=',4)
            ->where('cate_id',1)
            ->limit(8)
            ->get();        //强烈推荐


        $cartoons_second_thumb = Cartoon::where('recommend',3)
            ->where('end',1)
            ->first();      //经典完结推荐大图

        $cartoons_seconds = Cartoon::where('recommend','!=',4)
            ->where('end',1)
            ->limit(8)
            ->get();        //经典完结



        $cartoons_third_thumb = Cartoon::where('recommend',3)
            ->where('pay',1)
            ->first();      //免费专区推荐大图

        $cartoons_thirds = Cartoon::where('recommend','!=',4)
            ->where('pay',1)
            ->limit(8)
            ->get();        //免费专区


        $cartoons_fours = Cartoon::where('recommend','!=',4)
            ->OrderBy('id','desc')
            ->limit(8)
            ->get();        //新书报道


        return view('index',[
            'type'=>config('mh.type.index'),
            'banners'=>$banners,
            'cartoons_first_thumb'=>$cartoons_first_thumb,
            'cartoons_firsts'=>$cartoons_firsts,
            'cartoons_second_thumb'=>$cartoons_second_thumb,
            'cartoons_seconds'=>$cartoons_seconds,
            'cartoons_third_thumb'=>$cartoons_third_thumb,
            'cartoons_thirds'=>$cartoons_thirds,
            'cartoons_fours'=>$cartoons_fours,
            'user' => $this->checkLogin(),
        ]);

    }

public function test()
{

    return session()->get('233');



}
    /**漫画详情页面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function detail($id)
    {
        if(!$cartoon = Cartoon::find($id)){
            return 'error ! 未找到此页面';
        }

        $likes = Cartoon::where('cate_id',$cartoon->cate_id)->orderBy('sort','desc')->limit(6)->get();

        $collect_type = 'uncollect';

        if($user_id = $this->checkLogin()){
            if($collect =  Collect::where('user_id',$user_id)->where('cartoon_id',$id)->first()){
                $collect_type = 'collect';
            }
        }

        $cartoon->update(['hit'=>$cartoon->hit+1]);

        return view('detail',[
            'cartoon'=>$cartoon,
            'likes'=>$likes,
            'collect_type'=>$collect_type,
        ]);

    }


    /**漫画页面
     * @param $id
     * @param $list_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function cartoon($id,$list_id)
    {
        if(!$cartoon_list =  Cartoon_list::where('cartoon_id',$id)->where('page',$list_id)->first()){
            return 'error ! 未找到此页面';
        }


        $collect_type = 'uncollect';

        if($user_id = $this->checkLogin()){
            if($user =User::find($user_id)){
                //如果不是会员
                if($user->level != 2){
                    //判断该章节是否观看过
                    if(!Footprint::where('user_id',$user_id)->where('cartoon_id',$id)
                        ->where('page',$list_id)
                        ->first()){
                        if($user->gold - $cartoon_list->pay <0){
                            return "<script>alert('余额不足哦');window.history.go(-1)</script>";
                        }{
                            $user->update([
                                'gold'=>$user->gold - $cartoon_list->pay
                            ]);
                            Footprint::create([
                                'user_id'=>$user_id,
                                'cartoon_id'=>$id,
                                'page'=>$list_id,
                                'list_name'=>$cartoon_list->name
                            ]);
                        }
                    }
                }

            }else{
                return 'error';
            }

            if($collect =  Collect::where('user_id',$user_id)->where('cartoon_id',$id)->first()){
                $collect_type = 'collect';
            }


        }else{
            if($cartoon_list->pay != 0){
                return "<script>alert('请先登陆');window.history.go(-1)</script>";
            }
        }




        return view('cartoon',[
            'cartoon'=>$cartoon_list,
            'collect_type'=>$collect_type,
        ]);
    }


    /**漫画目录页面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function cartoon_list($id)
    {
        if(!$cartoon_list =  Cartoon_list::where('cartoon_id',$id)->orderBy('id','asc')->get()){
            return 'error ! 未找到此页面';
        }

        $status = Cartoon::find($id)->end==1?'已完结':'连载中';
        return view('list',[
            'cartoons'=>$cartoon_list,
            'status'=>$status,
            'id'=>$id,
        ]);

    }

    /**分类页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cate(Request $request)
    {

        $cates = Cate::select(['id','name'])->get();
        $cartoons = Cartoon::select(['id','name','thumb','detail','introduce','hit'])
        ->where('recommend','!=',4);
        if($request->cate_id){
            $cartoons =  $cartoons->where('cate_id',$request->cate_id);
        }
        if(isset($request->is_end) && $request->is_end !=3  && !empty($request->is_end)){
            $cartoons =  $cartoons->where('end',$request->is_end);
        }
        if(isset($request->is_free) && $request->is_free !=3 &&  !empty($request->is_free)){
            $cartoons =  $cartoons->where('pay',$request->is_free);
        }


        $cartoons = $cartoons->get();

        return view('cate',[
            'type'=>config('mh.type.cate'),
            'cates'=>$cates,
            'cartoons'=>$cartoons,
        ]);
    }


    /**书架
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bookcase()
    {

        if($user_id = $this->checkLogin()){

            $cartoon_ids = Collect::where('user_id',$user_id)->pluck('cartoon_id')->toArray();

            $cartoons =Cartoon::with(['footprint'=>function ($q) use ($user_id){
                $q->where('user_id',$user_id)->orderBy('created_at','desc')->limit(1);
            }])->whereIn('id',$cartoon_ids)->get();


            return view('bookcase',[
                'cartoons'=>$cartoons,
                'type'=>config('mh.type.bookcase'),
            ]);
        }

        return "<script>alert('请先登陆');window.history.go(-1)</script>";

//        return  view('login');


    }

    /**
     * @param $cartoon_id 漫画ID
     * @param $average    平均每页图片数量
     * @param $num        图片总数
     * @param $name       路径名称
     */
    public function listScript(Request $request)
    {
        $this->validate($request,[
            'cartoon_id'=>'required',
            'average'=>'required',
            'num'=>'required',
            'name'=>'required',
            'free_page'=>'required'
        ]);
        $cartoon_id = $request->input('cartoon_id');
        $average = $request->input('average');
        $num = $request->input('num');
        $name = $request->input('name');
        $free_page = $request->input('free_page');
        //多少页
        $pages = ceil($num/$average);

        for ($i=1;$i<=$pages;$i++){
            $k = $i*$average-$average+1;
            $url='';
            for ($j=$k;$j<=$i*$average;$j++){
               $url.='/cartoon/'.$name.'/'.$j.'.jpg'.PHP_EOL;
            }
            rtrim($url);
            $pay = 50;
            if($i<=$free_page){
                $pay=0;
            }
            Cartoon_list::create([
                'cartoon_id'=>$cartoon_id,
                'name'=>'第'.$i.'话',
                'url'=>$url,
                'page'=>$i,
                'pay'=>$pay,
            ]);
        }

        $count = Cartoon_list::where('cartoon_id',$cartoon_id)->count();
        admin_toastr('操作成功，漫画目录成功写入' . $count . '章节!');
        return redirect()->back();


    }
    function download($url='http://t.wzfcyy.cn/www.wzfcyy.cn/125131/4/1.jpg',$save_dir='image/',$filename='',$type=0){
        if(trim($url)==''){
            return array('file_name'=>'','save_path'=>'','error'=>1);
        }
        if(trim($save_dir)==''){
            $save_dir='./';
        }
        if(trim($filename)==''){//保存文件名
            $ext=strrchr($url,'/');
            $date = date('YmdHis',time()).'-';
            $filename = str_replace('/',$date,$ext);

//            if($ext!='.gif'&&$ext!='.jpg'){
//                return array('file_name'=>'','save_path'=>'','error'=>3);
//            }
//            $filename=time().'.jpg';
        }
        if(0!==strrpos($save_dir,'/')){
            $save_dir.='/';
        }
        //创建保存目录
        if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
            return array('file_name'=>'','save_path'=>'','error'=>5);
        }
        //获取远程文件所采用的方法
//        if($type){
//            $ch=curl_init();
//            $timeout=5;
//            curl_setopt($ch,CURLOPT_URL,$url);
//            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
//            $img=curl_exec($ch);
//            curl_close($ch);
//        }else{
                ob_start();
                readfile($url);
                $img=ob_get_contents();
                ob_end_clean();


//        }
        //$size=strlen($img);
        //文件大小
        $fp2=fopen($save_dir.$filename,'a');
        fwrite($fp2,$img);
        sleep(1);
//        if (!file_exists($save_dir.$filename)) {
//           dd(1);
//        }else{
//          Log::info($save_dir.$filename);
//        }
        fclose($fp2);
        unset($img,$url);
    }




    public function preg_image1($mulu,$num,$name)
    {

        set_time_limit(0);
        for ($i=1;$i<=$num;$i++){

            for ($j=1;$j<=160;$j++){
                $url =  'http://t.wzfcyy.cn/www.wzfcyy.cn/'.$mulu.'/'.$i.'/'.$j.'.jpg';

                try{
                    $this->download($url,'image/'.$name);
                }catch (\Exception $exception){
                   continue;
                }

            }


        }
        return '完成'.date('Y-m-d H:i:s',time());


    }


    public function preg_image2($first,$num,$name)
    {

        set_time_limit(0);
        for ($i=$first;$i<=$first+$num-1;$i++){

            for ($j=1;$j<=100;$j++){
//                $url =  'http://t.wzfcyy.cn/www.wzfcyy.cn/'.$mulu.'/'.$i.'/'.$j.'.jpg';
                $url = 'http://manhua-1251281796.cos.ap-chengdu.myqcloud.com/bookimg/143/1533713519_book_143_chapter_'.$i.'_'.$j.'.jpg';
                try{
                    $this->download($url,'image/'.$name);
                }catch (\Exception $exception){
                    continue;
                }

            }


        }
        return '完成'.date('Y-m-d H:i:s',time());


    }

    public function poplist(Request $request)
    {
        $cartoons = Cartoon::orderBy('hit','desc')->limit(10)->get();
        if($request->has('type') && $request->type == 2){
            $cartoons = Cartoon::orderBy('sort','desc')->limit(10)->get();
        }
        return view('poplist',[
            'cartoons'=>$cartoons
        ]);
    }



}
