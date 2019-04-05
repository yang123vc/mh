<?php
namespace App\Http\Helper;
trait Code{



public function randOrderNum($user_id){

    return 'O'.rand(1000,9999).date('YmdHis',time()).$user_id;

}


}