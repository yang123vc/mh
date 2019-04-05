<html>
<head>
    <meta charset="utf-8">

    <title>注册</title>
    @include('common.header')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        html,body{ max-width:600px; margin:0 auto;}
        .mui-bar-tab .mui-tab-item.mui-active{ color:#3688ff}
    </style>


    <style type="text/css">
        .box_login{
            margin: 15px 15px 0;
            overflow: auto;
        }
        .box_login header{
            margin-top: 59px;
            margin-bottom: 44px;
        }
        .box_login header img{
            display: block;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 10px;
        }
        .box_login header p{
            text-align: center;
            color: #FFFFFF;
            font-size: 16px;
            line-height: 16px;
        }
        .box_login .binding_content{
            background-color: #FFFFFF;
            padding: 0 15px;
            border-radius: 6px;
        }
        .box_login .binding_content .mobile{
            padding-left: 29px;
            border-bottom: 1px solid #F4F4F4;
        }
        .box_login .binding_content .pass{
            padding-left: 29px;
        }
        .box_login .binding_content .mobile input{
            width: 100%;
        }
        .box_login .binding_content form input{
            border: none;
            line-height: 50px;
            font-size: 14px;
            width: 50%;
            height: auto;
        }
        .box_login .binding_content #yzm{
            padding: 0;
            margin: 0;
            float: right;
            text-align: right;
            color: #fb635c;
            font-size: 12px;
        }
        .box_login .btn{
            margin-top: 40px;
        }
        .box_login #toastBtn{
            padding: 0;
            margin: 0;
            border: none;
            width: 100%;
            border-radius: 6px;
            line-height: 44px;
            text-align: center;
            font-size: 15px;
            color: #FFFFFF;
            background-color: #FB635C;
        }
        .box_login .toastBtn_active{
            background-color: #FB655C !important;
            color: #FFFFFF !important;
        }
        .box_login #pass{
            width: 100%;
        }
        .box_login .mobile,.pass{
            position: relative;
        }
        .box_login .binding_content img{
            position: absolute;
            top: 50%;
        }
        .box_login .mobile img{
            width: 15px;
            height: 22px;
            margin-top: -11px;
            left: 2px;
        }
        .box_login .pass img{
            width: 17px;
            height: 18px;
            margin-top: -11px;
            left: 2px;
        }
        .box_login .pass span{
            position: absolute;
            top: 50%;
            margin-top: -8px;
            right: 3px;
            color: #A5A5A5;
        }
        .box_login .forget_pass{
            float: right;
            font-size: 10px;
            color: #FFFFFF;
            margin-top: 10px;
            line-height: 10px;
        }
        .box_login .bottom{
            font-size: 13px;
            color: #FFFFFF;
            position: absolute;
            bottom: 50px;
            left: 50%;
            margin-left: -80px;
        }
        .box_login .bottom a{
            font-size: 13px;
            color: #FB635C;
        }
        .box_binding header{ background:none;}
        .binding_content .mobile, .code, .pass{ padding-top:0;}
    </style>

</head>
<body style="background-color: #0b2a49;background-size: cover;">
<div class="box_binding box_login">
    <header>

        <p>用户注册</p>
    </header>
    <div class="binding_content">
        <form name="binding">
            <div class="mobile">
                <img src="http://m8.hongjingkeji.com/Public/images/nohead.jpg">
                <input type="text"  value="" name="username" placeholder="请输入您的用户名">
            </div>
            <div class="mobile">
                <img src="{{asset('/image/icon/password_img4.png')}}">
                <input type="text"  value="" name="mobile" placeholder="请输入您的手机号码">
            </div>
            <div class="pass" id="pass">
                <img src="{{asset('/image/icon/password_img3.png')}}">
                <span class="iconfont icon-yanjing"></span>
                <input type="password"  id="password" value="" name="password" placeholder="请输入大于5位数的密码">
            </div>
            <div class="pass" id="pass1">
                <img src="{{asset('/image/icon/password_img3.png')}}">
                <span class="iconfont icon-yanjing" id="seePsd1"></span>
                <input type="password"  id="password1" value="" name="password1" placeholder="确认密码">
            </div>
        </form>
    </div>
    {{--<a href="/index.php?m=&amp;c=Public&amp;a=setpass" class="forget_pass">忘记密码？</a>--}}
    <div class="btn">
        <button id="toastBtn" type="button" class="mui-btn mui-btn-blue mui-btn-outlined">注册</button>
        <div class="bottom" ><a href="/" >返回首页</a> 已有账号？<a href="/login">去登陆</a>


        </div>
    </div>

</div>
@include('common.js')
<script src="{{asset('js/start.js')}}"></script>


<script type="text/javascript">

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    //设置密码是否可见
    var bool = true;
    $('#pass span').click(function(){
        if(bool){
            bool = false;
            $('#password').attr('type','text');
            $(this).css({
                color : '#fb635c'
            });
        }else{
            bool = true;
            $('#password').attr('type','password');
            $(this).css({
                color : '#A5A5A5'
            });
        }
    });

    //设置密码是否可见
    var bool1 = true;
    $('#pass1 span').click(function(){
        if(bool1){
            bool1 = false;
            $('#password1').attr('type','text');
            $(this).css({
                color : '#fb635c'
            });
        }else{
            bool1 = true;
            $('#password1').attr('type','password');
            $(this).css({
                color : '#A5A5A5'
            });
        }
    });




    //点击按钮 判断输入框中的输入内容
    $('#toastBtn').click(function(){
        var m = $("input[name='username']").val();
        var mobile = $("input[name='mobile']").val();
        var p = $("#password").val();
        var p1 = $("#password1").val();

        var pattern = /^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\d{8}$/;
        if(mobile.length<1 || mobile.length>11 || !pattern.test(mobile)){
            layer.msg('请输入正确的11位电话号码');
            return false;
        }

        if(p !== p1){
            layer.msg('两次密码不一致');
            return false;
        }
        if(m =='' || p.length < 5){
            layer.msg('用户名和密码必须大于5个字');
            return false;
        }
        var l = layer.load(1);
        $.post("/doReg", {mobile:mobile,username:m, password:$("#password").val()}, function(d){

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
</script>
</body></html>