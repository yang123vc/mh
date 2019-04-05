<?php

namespace App\Http\Controllers;

use App\Models\Sign;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SignController extends Controller
{
    public function userSign()
    {

        $user = User::find($this->checkLogin());
        if(Sign::where('user_id',$user->id)
            ->whereDate('created_at',Carbon::today()->format('Y-m-d'))
            ->first()
        ){
            return $this->error('你已经签过到了哦');
        }
        Sign::create([
            'user_id'=>$user->id
        ]);
        $user->update([
            'gold'=>$user->gold + 100
        ]);
       return $this->success('签到成功');
    }
}
