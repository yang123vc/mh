<html><head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>我的</title>
    <link href="{{asset('css/mui.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="http://m8.hongjingkeji.com/Public/plugins/layer/theme/default/layer.css?v=3.1.1" id="layuicss-layer">
    <link rel="stylesheet" href="{{asset('css/swiper-3.4.2.min.css')}}">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_809906_xsowanr9ms8.css">
    <link rel="stylesheet" href="{{asset('css/novel.css')}}">
    <link rel="stylesheet" href="{{asset('/css/anime.css')}}">
    <style>
        html,body,{ max-width:600px; margin:0 auto;}
    </style>


    <style>
        .mine_top_content img{ border-radius:50%;}
        .mine_top_btm div{ -webkit-flex:1}
    </style>

</head>
<body style="background-color: #F4F4F4;">
<div class="box_mine" style="">
    <div class="mine_top">
        <div class="mine_top_content">
          <a  href="/login">  <img src="http://m8.hongjingkeji.com/Public/images/nohead.jpg"></a>
            <div style=" overflow:hidden; max-width:50%; height:60px;">
                @if($user ==false)
                  <a href="/login">  <p  style="color: #ff4a4a; line-height:30px; height:30px; overflow:hidden;">
                        点击登陆
                    </p></a>
                    @else
                    <p style=" line-height:30px; height:30px; overflow:hidden;">
                        {{$user->username}}
                        @if($user->level == 2)
                            <span style="color: red;margin-top: 10px">VIP</span>
                            @endif
                    </p>
                    <p style=" margin-top:0;">
                        <span class="mui-badge mui-badge-purple">每天签到可得100金币哦</span>
                    </p>
                    @endif

            </div>
            @if($user)
            <a href="javascript:;" class="last"><i class="iconfont icon-yiqiandao"></i><span>@if($sign == false)签到@else已签到@endif</span></a>
                @endif
        </div>
        @if($user !=false)
        <div class="mine_top_btm">
            <div>

                <a href="javascript:;">
                    <p>金币</p>
                    @if($user->level == 2)
                        <span style="color: red">VIP</span>
                        @else
                        <span>{{$user->gold}}</span>
                    @endif
                </a>
            </div>
            <div>
                <p>会员到期时间</p>
                <span>@if($user->level ==2){{Carbon\Carbon::parse($user->vip_end_time)->format('Y-m-d')}}@else  @endif</span>
            </div>
        </div>
        @endif
    </div>
    <ul class="mine_content">
        <li>
            <figure>
                <img src="http://m8.hongjingkeji.com/Public/novel/img/mine_top-up.png">
            </figure>
            <a href="/recharge">
                <span>立即充值</span>
                <span class="iconfont icon-xiangyoujiantou"></span>
            </a>
        </li>
        <li>
            <figure>
                <img src="http://m8.hongjingkeji.com/Public/novel/img/mine_bill.png">
            </figure>
            <a href="/message">
                <span> 交流反馈</span>
                <span class="iconfont icon-xiangyoujiantou"></span>
            </a>
        </li>
        {{--<li>--}}
            {{--<figure>--}}
                {{--<img src="http://m8.hongjingkeji.com/Public/novel/img/mine_gift.png">--}}
            {{--</figure>--}}
            {{--<a href="/index.php?m=&amp;c=My&amp;a=invite">--}}
                {{--<span>邀请有礼</span>--}}
                {{--<span class="iconfont icon-xiangyoujiantou"></span>--}}
            {{--</a>--}}
        {{--</li>--}}

        {{--<li>--}}
            {{--<figure>--}}
                {{--<img src="http://m8.hongjingkeji.com/Public/novel/img/mine_people_logo.png">--}}
            {{--</figure>--}}
            {{--<a href="/index.php?m=&amp;c=My&amp;a=friends">--}}
                {{--<span>我的好友</span>--}}
                {{--<span class="iconfont icon-xiangyoujiantou"></span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<figure>--}}
                {{--<img src="http://m8.hongjingkeji.com/Public/novel/img/mine_gift_box.png">--}}
            {{--</figure>--}}
            {{--<a href="/index.php?m=&amp;c=My&amp;a=expense">--}}
                {{--<span>好友贡献</span>--}}
                {{--<span class="iconfont icon-xiangyoujiantou"></span>--}}
            {{--</a>--}}
        {{--</li>--}}
    </ul>
    <ul class="mine_content mine_content_size">
        <li>
            <figure>
                <img src="http://m8.hongjingkeji.com/Public/novel/img/mine_bill.png">
            </figure>
            <a href="/bill/detail">
                <span>账单明细</span>
                <span class="iconfont icon-xiangyoujiantou"></span>
            </a>
        </li>
        {{--<li>--}}
            {{--<figure>--}}
                {{--<img src="http://m8.hongjingkeji.com/Public/novel/img/mine_gift.png">--}}
            {{--</figure>--}}
            {{--<a href="/index.php?m=&amp;c=My&amp;a=withdraw">--}}
                {{--<span>申请提现</span>--}}
                {{--<span class="iconfont icon-xiangyoujiantou"></span>--}}
            {{--</a>--}}
        {{--</li>--}}
      {{----}}
        {{--<li>--}}
            {{--<figure>--}}
                {{--<img src="http://m8.hongjingkeji.com/Public/novel/img/mine_mobile.png">--}}
            {{--</figure>--}}
            {{--<a href="/index.php?m=&amp;c=My&amp;a=bind">--}}
                {{--<span>绑定手机</span>--}}
                {{--<span class="iconfont icon-xiangyoujiantou"></span>--}}
            {{--</a>				</li>--}}
        <li>
            <figure>
                <img src="http://m8.hongjingkeji.com/Public/novel/img/mine_pass.png">
            </figure>
            <a href="/password">
                <span>修改密码</span>
                <span class="iconfont icon-xiangyoujiantou"></span>
            </a>
        </li>

        @if($user !=false)
        <li id="logOut">
        <figure>
        <img src="http://m8.hongjingkeji.com/Public/novel/img/mine_gift.png">
        </figure>
        <a>
        <span>注销登陆</span>
        <span class="iconfont icon-xiangyoujiantou"></span>
        </a>
        </li>
            @else
            <li onclick="javascript:window.location.href='/reg'">
                <figure>
                    <img src="http://m8.hongjingkeji.com/Public/novel/img/mine_gift.png">
                </figure>
                <a>
                    <span>用户注册</span>
                    <span class="iconfont icon-xiangyoujiantou"></span>
                </a>
            </li>
        @endif


    </ul>
    <div style="height: 49px;"></div>
    <!-- 底部nav -->
   @include('common.footer')

</div>
<script src="{{asset('/js/start.js')}}"></script>
@include('common.js')
<script type="text/javascript">

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    //点击按钮 判断输入框中的输入内容
    $('#logOut').click(function(){

        var l = layer.load(1);
        $.post("/logOut", {}, function(d){

            layer.close(l);
            if(d.code !=201){

                    layer.msg(d.msg);
                    return false;

            }
            layer.msg(d.msg, function(){
                location.href = d.data.url;
            });
        });
    });



    //监听a标签 跳转页面事件
    mui('.mui-bar-tab').on('tap', 'a', function(e) {
        location.href = $(this).attr('href');
    });

    //点击签到
    $('.last span').click(function(){
        $.post("/user/sign",{}, function(d){
            if(d.code == 201){
                layer.msg(d.msg);
                setTimeout("history.go(0)", 1000 )
            }else {
                layer.msg('今天已经签到过了哦');
            }

        });

    });

</script>

</body></html>