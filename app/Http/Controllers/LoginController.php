<?php

namespace App\Http\Controllers;

use App\Http\Helper\Ip;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use Ip;
    public function login()
    {


        return view('login',[

        ]);

    }


    public function doLogin(Request $request)
    {


        $this->validate($request,[
            'username'=>'required|min:5|max:12',
            'password'=>'required|min:5|max:15'
        ]);

        if(!$user = User::where('username',$request->username)->first()){
            return $this->error('账号不存在哦');
        }

        if(decrypt($user->password) != $request->password){
            return $this->error('账号或密码错误');
        }


        session()->put(['user_id'=>$user->id]);

        return $this->success('登陆成功',['url'=>'/']);

    }

    public function reg()
    {

        return view('reg',[

        ]);


    }


    public function doReg(Request $request)
    {
        $this->validate($request, [
            'username'=>'required|min:5|max:12',
            'mobile'=>'check_mobile',
            'password'=>'required|min:5|max:15',

        ]);


        if ($user = User::where('username', $request->username)->first()) {
            return $this->error('用户名已被注册');      //如果用户名重复返回error
        }




        $ip = $this->getIp();
        $count = User::where('reg_ip',$ip)->where('reg_ip','!=','0.0.0.0')->count();
        if($count >3)
        {
            return $this->error('同一ip只能注册3次账号!');
        }

        $data = $request->all();
        $data['password'] = encrypt($request->password);
        $data['reg_ip'] = $ip;
        $data['share_user_id'] = null;
        if ($share_user_id = session()->get('share_user_id')){
            if($share_user = User::find($share_user_id)){
                $data['share_user_id'] = $share_user_id;
                if($ip != $share_user->reg_ip){
                    $share_user->update([
                        'gold' => config('mh.share.gold') + $share_user->gold
                    ]);
                }

            }

        }
        if ($user =  User::create($data)){

            session()->put(['user_id'=>$user->id]);


            return $this->success('注册成功',['url'=>'/']);

        } else {
            return $this->error();
        }
    }

    /**注销登陆
     * @return bool
     */
    public function logOut()
    {

        session()->forget('user_id');

        if(session()->has('user_id')){
            return $this->error('注销失败');

        }
        return $this->success('注销成功',['url'=>'/']);

    }


    /**获取iP
     * @param int $type
     * @param bool $client
     * @return mixed
     */
    public function getIp1($type = 0,$client=true)
    {

        $type       =  $type ? 1 : 0;
        static $ip  =   NULL;
        if ($ip !== NULL) return $ip[$type];
        if($client){
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $pos    =   array_search('unknown',$arr);
                if(false !== $pos) unset($arr[$pos]);
                $ip     =   trim($arr[0]);
            }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip     =   $_SERVER['HTTP_CLIENT_IP'];
            }elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip     =   $_SERVER['REMOTE_ADDR'];
            }
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
        // 防止IP伪造
        $long = sprintf("%u",ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];

    }


}
