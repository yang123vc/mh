<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function getShareUrl()
    {
        $user = $this->getUser();
        return $_SERVER['HTTP_HOST'].'?share_user_id='.encrypt($user->id);
    }

}
