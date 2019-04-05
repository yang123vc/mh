<?php

namespace App\Http\Controllers;

use App\Models\Collect;
use Illuminate\Http\Request;

class CartoonController extends Controller
{
    public function addCollect(Request $request)
    {

        if(!isset($request->cartoon_id) || empty($request->cartoon_id)){
            return $this->error();
        }
        if($user_id = $this->checkLogin()){
           if(Collect::where('cartoon_id',$request->cartoon_id)->where('user_id',$user_id)
           ->first()){
               return $this->error('已经收藏此漫画了哦');
           }

           try{
               Collect::create([
                   'user_id'=>$user_id,
                   'cartoon_id'=>$request->cartoon_id,
               ]);
           }catch (\Exception $exception){
               return $this->error();
           }

           return $this->success();

        }
        return $this->error('请先登陆再收藏哦',501);

    }


    public function delCollect(Request $request)
    {
        if(!isset($request->cartoon_id) || empty($request->cartoon_id)){
            return $this->error();
        }
        if($user_id = $this->checkLogin()) {
            if ($collect = Collect::where('cartoon_id', $request->cartoon_id)
                ->where('user_id', $user_id)
                ->first()) {
                $collect->delete();
                return $this->success();
            }
            return $this->error();
        }

        return $this->error('请先登陆再收藏哦',501);


    }
}
