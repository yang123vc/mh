<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cartoon_list;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

class ScriptController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {

        return Admin::content(function (Content $content) {

            $content->header('目录添加');


            $form = new \Encore\Admin\Widgets\Form();

            $form->select('type_id', '广告类型');

            $form->text('name', '广告名称');



            $form .= '233';

            $html = view('admin.cate_script',[

            ]);
            $content->row($html);



        });

    }



    /**
     * @param $cartoon_id 漫画ID
     * @param $average    平均每页图片数量
     * @param $num        图片总数
     * @param $name       路径名称
     */
    public function listScript(Request $request)
    {
        if(!Admin::user()){
            admin_toastr('未登录','error');
            return redirect()->back();
        }

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



}
