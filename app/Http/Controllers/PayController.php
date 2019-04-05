<?php

namespace App\Http\Controllers;
require_once ('Pay/dkSdk/lib/epay_submit.class.php');
require_once("Pay/dkSdk/epay.config.php");
require_once("Pay/dkSdk/lib/epay_notify.class.php");
use App\Http\Helper\Code;
use App\Models\Order;
use App\Models\Recharge_activity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayController extends Controller
{
    use Code;
    private $way='dk';

    public function pay(Request $request)
    {

        $way = $this->way;
        $user_id = $this->checkLogin();
        $type = 'wxpay';
        if($request->pay_type != 'wxpay')
        {
            $type = 'alipay';
        }
        //默认包年
        $money='365';
        $recharge_type = $request->recharge_type?:5;
        $recharge_gold = 0;
        $send_gold = 0;
        $orderType = 2; //年费VIP
        if($recharge_type !=5){

            if($recharge_type == 6){
                $money='688';
                $orderType = 3;   //终身VIP
            }else{
                if($recharge = Recharge_activity::find($recharge_type)){
                    $money = $recharge->money;
                    $send_gold = isset($recharge->present_money)?$recharge->present_money*100:0;
                    $recharge_gold = $money * 100;
                    $orderType = 1;   //充值金币
                }

            }

        }
        if($recharge_type == 1){
            $money = 0.01;
        }


        $order_num = $this->randOrderNum($user_id);
//构造要请求的参数数组，无需改动
        $parameter = array(
            "pid" => trim(config('epay.'.$way.'.partner')),
            "type" => $type,
            "notify_url"	=> config('epay.'.$way.'.notify_url'),
            "return_url"	=>  config('epay.'.$way.'.return_url'),
            "out_trade_no"	=>$order_num,
            "name"	=> '充值',
            "money"	=> $money,
            "sitename"	=> '易支付',
        );
        $alipay_config = config('epay.'.$way);
        Order::create([
            'order_num' => $order_num,
            'user_id' => $user_id,
            'recharge_id' => $recharge_type,
            'money' => $money,
            'recharge_gold' => $recharge_gold,
            'send_gold' => $send_gold,
            'type' => $orderType
        ]);
//建立请求

        $alipaySubmit = new \AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter);
        return $html_text;

    }





    public function notify_url()
    {

      $way = $this->way;
      $alipay_config = config('epay.' . $way);
      //计算得出通知验证结果
      $alipayNotify = new \AlipayNotify($alipay_config);
      $verify_result = $alipayNotify->verifyNotify();
      if($verify_result) {//验证成功
          Log::info('支付成功 '.date('Y-m-d H:i:s', time()));/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //请在这里加上商户的业务逻辑程序代

    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

    //商户订单号

    $out_trade_no = $_GET['out_trade_no'];

    //蛋白云易支付交易号

    $trade_no = $_GET['trade_no'];

    //交易状态
    $trade_status = $_GET['trade_status'];

    //支付方式
    $type = $_GET['type'];



    if ($_GET['trade_status'] == 'TRADE_SUCCESS') {
        $order = Order::where('order_num',$out_trade_no)->first();
        $order->update([
            'state'=>2
        ]);
        if($user = User::find($order->user_id)){
            switch ($order->money){
                case 365:
                    $user->update([
                        'level' => 2,
                        'vip_end_time' => Carbon::now()->modify('+1 year')
                    ]);
                break;
                case  688:
                    $user->update([
                        'level' => 2,
                        'vip_end_time' => Carbon::now()->modify('+10 year')
                    ]);
                break;
                default:
                    if($order->recharge_id == 1){
                        $user->update([
                            'gold' => $user->gold + 100000
                        ]);
                    }else{
                        $user->update([
                            'gold' => $user->gold + $order->recharge_gold + $order->send_gold
                        ]);
                    }
                break;
            }

        }
        Log::info($order);
        Log::info($user);
        Log::info($_GET);
        //判断该笔订单是否在商户网站中已经做过处理
        //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
        //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
        //如果有做过处理，不执行商户的业务程序

        //注意：
        //付款完成后，支付宝系统发送该交易状态通知


    }

    //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

    echo "success";		//请不要修改或删除

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    Log::error('验证失败 '.date('Y-m-d H:i:s',time()));
    //验证失败
    echo "fail";
}

    }


    public function return_url()
    {
        $way = $this->way;
        $alipay_config = config('epay.'.$way);
//计算得出通知验证结果
        $alipayNotify = new \AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码

            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号

            $out_trade_no = $_GET['out_trade_no'];

            //支付宝交易号


            $trade_no = $_GET['trade_no'];

            //交易状态
            $trade_status = $_GET['trade_status'];

            //支付方式
            $type = $_GET['type'];


            if($_GET['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序
            }
            else {
                echo "trade_status=".$_GET['trade_status'];
            }

            return "<script>alert('充值成功');window.location.href='/my'</script>";

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            return "<script>alert('充值失败');window.location.href='/my'</script>";
        }
    }
}
