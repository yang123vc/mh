<html><head>

    <title>充值</title>
    @include('common.header')
    <style>
        html,body{ max-width:600px; margin:0 auto;}
        /*底部nav*/

        .mui-bar-tab {
            box-shadow: 0 0 0 #000000;
            border-top: 1px solid #E6E6E6;
        }
        .mui-bar-tab .mui-active img.posi_img{ display:block;}
        .mui-bar-tab div {
            width: 100%;
            height: 26px;
            position: relative;
        }

        .mui-bar-tab a:nth-child(1) div img {
            width: 23px;
            height: 21px;
            position: absolute;
            top: 0;
            left: 50%;
            margin-left: -11.5px;
        }

        .mui-bar-tab a:nth-child(2) div img {
            width: 22px;
            height: 22.5px;
            position: absolute;
            top: 0;
            left: 50%;
            margin-left: -11px;
        }

        .mui-bar-tab a:nth-child(3) div img {
            width: 25px;
            height: 21.5px;
            position: absolute;
            top: 0;
            left: 50%;
            margin-left: -12.5px;
        }

        .mui-bar-tab a:nth-child(4) div img {
            width: 24px;
            height: 21px;
            position: absolute;
            top: 0;
            left: 50%;
            margin-left: -12px;
        }

        .mui-bar-tab a div .posi_img {
            z-index: 999;
            display: none;
        }

        .mui-bar-tab a div .active {
            display: block;
        }

        .mui-bar-tab a span {
            display: block;
            line-height: 11px;
            font-size: 11px;
        }

    </style>


    <style>
        body{ background:#fbf9fe; color:#555;}
        .top_up_mask{
            position: absolute;
            z-index: 99;
            background-color: rgba(000,000,000,0.5);
            width: 100%;
            height: 100%;
            bottom: 0;
            left: 0;
            display: none;
        }
        .top_up_mask_content{
            position: absolute;
            z-index: 999;
            background-color: #FFFFFF;
            width: 100%;
            bottom: 0;
            left: 0;
            padding: 0 15px 37px;
        }
        .top_up_mask_top{
            text-align: center;
            line-height: 45px;
            font-size: 15px;
            overflow: hidden;
        }
        .top_up_mask_top span{
            font-size: 15px;
            float: left;
        }
        .top_up_mask b{
            font-weight: 500;
        }
        .top_up_mask_num_top{
            text-align: center;
            font-size: 14px;
            line-height: 14px;
            padding-top: 16px;
        }
        .top_up_mask_num_btm{
            text-align: center;
            font-size: 30px;
            line-height: 30px;
            padding-top: 15px;
            padding-bottom: 22px;
            position: relative;
        }
        .top_up_mask_num_btm:after{
            content: '';
            width: 100%;
            height: 1px;
            background-color: #F4F4F4;
            bottom: 0;
            left: 0;
            position: absolute;
        }
        .top_up_mask_list{
            padding: 7px 0;
        }
        .top_up_mask_list li{
            overflow: hidden;
            line-height: 40px;
            border-bottom:1px solid #eee;
        }
        .top_up_mask_list li:last-child{
            margin-bottom: 21px;
        }
        .top_up_mask_list li span{
            float: left;
            font-size: 13px;
        }
        .top_up_mask_list li span:nth-child(1){
            width: 29px;
            font-size: 15px;
        }
        .top_up_mask_list li p{
            float: right;

        }
        .top_up_mask_list li p a{
            width: 10px;
            height: 10px;
            display: block;
            border-radius: 50%;
            border: 1px solid #FB655C;
            margin-top: 5px;
        }
        .top_up_mask_list li p a b{
            width: 4px;
            height: 4px;
            border-radius: 50%;
            margin: 0 auto;
            margin-top: 2px;
            display: block;
            background-color: #FB655C;
            display: none;
        }
        .top_up_mask_list_active{
            display: block !important;
        }
        .top_up_mask_btm a{
            display: block;
            line-height: 45px;
            background-color: #FB655C;
            color: #FFFFFF;
            font-size: 14px;
            text-align: center;
            border-radius: 7px;
        }

        .payway{ display:inline-block; width:10px; height:10px; border-radius:50%; border:1px solid #ccc;}
        .payway-list .payway-active b{ background:green; border-color:green;}

        .box_top_up_list .left_posi{ -webkit-transform:rotate(45deg);}
        .box_top_up header{ position:static;}
        .box_top_up_list li div{ padding:0;}
        .box_top_up_btm p{ color:inherit; font-size:14px; text-indent:0;}
        .box_top_up_btm{ padding:15px;}

        .selected{ border:1px solid red !important; background:red;}
    </style>
    <meta name="poweredby" content="dragondean">

    <link rel="stylesheet" href="http://m8.hongjingkeji.com/Public/plugins/layer/theme/default/layer.css?v=3.1.1" id="layuicss-layer"></head>
<body style="">
<div class="box_binding box_top_up">
    <header style=" background:#fbf9fe; padding:10px; font-size:20px;">
        <!--a href="javascript:;" onclick="history.go(-1)">
            <span class="iconfont icon-xiangzuojiantou"></span>
        </a-->
        <span class="bdsj" style=" color:#fe8d98; font-size:24px; font-weight:400;">充值</span>
    </header>


    <div style=" padding:15px; border-bottom:1px solid #eee; font-size:16px;">
        您剩余: <span style="color:darkorange;">0.00</span>书币
    </div>			<ul class="box_top_up_list" style=" padding:15px; ">
        {{--<li is_hot="0" onclick="setSelect(1)" id="item1">--}}
            {{--<div style=" padding:10px; border:1px solid #ddd;overflow:visible !important;">--}}
                {{--<p><span>29.00</span>元</p>--}}
                {{--<p style=" color:#888;">2900书币<br>29元</p>--}}
            {{--</div>--}}
        {{--</li><li is_hot="1" onclick="setSelect(2)" id="item2">--}}
            {{--<div style=" padding:10px; border:1px solid #ddd;overflow:visible !important;" class="selected">--}}
                {{--<p><span>49.00</span>元</p>--}}
                {{--<p style=" color:#888;">4900+3100书币<br>多送31元</p>--}}
                {{--<img src="http://m8.hongjingkeji.com/Public/images/hot.png" style=" width:30px; height:30px; position:absolute; top:-5px; right:-5px;" class="hot">					</div>--}}
        {{--</li><li is_hot="0" onclick="setSelect(3)" id="item3">--}}
            {{--<div style=" padding:10px; border:1px solid #ddd;overflow:visible !important;">--}}
                {{--<p><span>79.00</span>元</p>--}}
                {{--<p style=" color:#888;">7900+6100书币<br>多送61元</p>--}}
            {{--</div>--}}
        {{--</li>--}}
        {{--<li is_hot="0" onclick="setSelect(4)" id="item4">--}}
            {{--<div style=" padding:10px; border:1px solid #ddd;overflow:visible !important;">--}}
                {{--<p><span>199.00</span>元</p>--}}
                {{--<p style=" color:#888;">（半年VIP）<br>半年全站免费看</p>--}}
            {{--</div>--}}
        {{--</li>--}}
            @foreach($recharges as $k=> $recharge)
            <li is_hot="0" onclick="setSelect({{$k+1}})" id="item{{$k+1}}">
                <div style=" padding:10px; border:1px solid #ddd;overflow:visible !important;">
                    <p><span>{{$recharge->money}}.00</span>元</p>
                    @if($recharge->present_money >0)
                    <p style=" color:#888;">{{$recharge->money}}00+{{$recharge->present_money * 100}}书币<br>多送{{intval($recharge->present_money)}}元</p>
                        @else
                        <p>
                        {{--<p style=" color:#888;">{{$recharge->money}}00书币</p>--}}
                        <p style=" color:red;">{{$recharge->money}}00000书币</p>
                        </p>
                        @endif
                </div>
            </li>
                @endforeach



        <li is_hot="0" onclick="setSelect(5)" id="item5">
            <div class="selected" style=" padding:10px; border:1px solid #ddd;overflow:visible !important;">
                <p><span>365.00</span>元</p>
                <p style=" color:#888;">（一年VIP）<br>365天全站免费看</p>
            </div>
        </li><li is_hot="0" onclick="setSelect(6)" id="item6">
            <div style=" padding:10px; border:1px solid #ddd;overflow:visible !important;">
                <p><span>888.00</span>元</p>
                <p style=" color:#888;">（永久VIP）<br>全站免费看</p>
            </div>
        </li>

    </ul>

    <div style=" padding:20px 15px;">
        <a href="javascript:charge();" style=" display:block; text-align:center; background:#fe8d98; color:#fff; padding:10px; border-radius:5px; font-size:18px; border:1px solid rgba(0,0,0,.2);">确认充值</a>
    </div>

    <div class="box_top_up_btm">

        <p>温馨提示：</p>
        <p>客服QQ群 ：939884850 ，免费下载所有图书</p>
        <p>1、充值书币仅限本书城使用；</p>
        <p>2、充值时，一元兑换<span>100</span>书币；</p>
        <p>3、充值会员后即可免费看全站；</p>
        <p>4、若充值后账户余额无变化，请记录您的用户ID联系书城客服<span></span>.</p>
    </div>
</div>

<form method="post" action="/payy">
<input type="hidden" name="recharge_type" id="recharge_type" value="5">
<input type="hidden" name="pay_type" id="pay_type" value="wxpay">
<input type="hidden" name="_token" value="{{csrf_token()}}">
<!--点击支付  弹出层-->
<div class="top_up_mask">
    <div class="top_up_mask_content">
        <div class="top_up_mask_top">
            <span class="iconfont icon-cha" id="close"></span>
            <b onclick="javascript:window.location.href='/recharge'" style="color: red">返回</b>
            <br>
            <b>选择支付方式</b>
        </div>
        <div class="top_up_mask_num">
            <p class="top_up_mask_num_top" id="desc">在线充值</p>
            <p class="top_up_mask_num_btm">

            </p>
        </div>
        <ul class="top_up_mask_list payway-list">
            <li data-payway="wxpay" class2="payway-active" class="payway-active">
                <span class="iconfont icon-weixin" style="color: #3FB842;font-size: 19px;"></span>
                <span>微信支付</span>
                <p>
                    <b class="payway" style="margin-top: 15px"></b>
                </p>
            </li>
            <li data-payway="alipay">
                <span class="iconfont icon-yue" style="color: #F7CF54;font-size: 17px;"></span>
                <span>支付宝支付</span>
                <p style="font-size: 12px;color: #999999;">
                    <b class="payway" style="margin-top: 15px"></b>
                </p>
            </li>
        </ul>
        <div class="top_up_mask_btm">
         <center>  <input type="submit" value="确认支付"></center>
            {{--<a href="javascript:pay();">确认支付</a>--}}
        </div>
    </div>
</div>
</form>
<div style="height: 49px;"></div>
<!-- 底部nav -->
@include('common.footer')
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    window.chargeId = 5;
    var recharge_type = 5;
    function setSelect(chargeId){
        window.chargeId = chargeId;

        recharge_type =chargeId;

        $('#recharge_type').val(recharge_type);
        $(".box_top_up_list li>div").removeClass('selected');
        $("#item" + chargeId + '>div').addClass('selected');

    }
    function charge(){
            $(".top_up_mask").show();
    }

    $("#close").on('click', function(){
        $(".top_up_mask").hide();
    });

    $(".payway-list li").on("click", function(){
        $(".payway-list li").removeClass('payway-active');
        $(this).addClass('payway-active');
        window.payway = $(this).data('payway');
        $('#pay_type').val($(this).data('payway'));
    });

    // 默认选中第一个支付方式
    $(".payway-list li:eq(0)").trigger('click');
    $("li[is_hot=1]:eq(0)").trigger('click');

    function pay(){
        if(!window.sn){
            layer.msg('请选择充值内容');
            return false;
        }
        if(!window.payway){
            layer.msg('请选择支付方式');
            return false;
        }

        // 关闭支付方式选择层
        $(".top_up_mask").hide();

        var l = layer.load(1);
        $.post("/index.php?m=&c=Pay&a=index",{payway:payway,sn:sn}, function(d){
            layer.close(l);
            if(!d.status){
                layer.msg(d.info);
                return false;
            }
            if(d.status == 1)location.href = d.url;
            else{
                layer.msg(d.info, function(){
                    location.href = d.url;
                });
            }
        });
    }

</script>
</body></html>