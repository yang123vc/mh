<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     
    public function error($message = '操作失败',$code=500)
    {

        $error = [
            'code' => $code,
            'msg' => $message
        ];

        return response()->json($error);

    }

    public function success($message = '操作成功', $data = [])
    {

        $success = [
            'code' => 201,
            'msg' => $message,
            'data' => $data
        ];

        return response()->json($success);

    }

    public function validate($request,$rules, $messages = [])
    {

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            header('Content-Type:  application/json');
            echo json_encode([
                'code' => '500',
                'msg' => $validator->errors()->first()
            ]);
            exit;

        }

    }

    public function checkLogin()
    {
        if(session('user_id')){
            return session('user_id');
        }
        return false;


    }

    public function getUser()
    {
        return $user = User::find(session('user_id'));
    }

}
