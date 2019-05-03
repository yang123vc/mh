<html>
<head>
    <meta charset="utf-8">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>提交反馈</title>
    <link href="{{asset('/css/mui.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/reset.css')}}">
    <link rel="stylesheet" href="http://m8.hongjingkeji.com/Public/plugins/layer/theme/default/layer.css?v=3.1.1" id="layuicss-layer">
    <link rel="stylesheet" href="{{asset('/css/swiper-3.4.2.min.css')}}">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_809906_xsowanr9ms8.css">
    <link href="{{asset('/css/novel.css')}}" rel="stylesheet">

    <style>
        html,body{ max-width:600px; margin:0 auto;}
    </style>


<style>
    .item{ padding:5px 15px;}
    .item input{ width:100%; padding:0 10px;}
</style>
<meta name="poweredby" content="dragondean">
</head>


<body>
<div class="box_comments">
    <header>
        <a href="/my">
            <span class="iconfont icon-xiangzuojiantou"></span>
        </a>
        <span class="xsp" style="line-height: 38px !important;">提交反馈</span>
    </header>

    <div class="success" id="success" style=" display:none;">

        <div style=" padding:15px; font-size:18px; text-align:center;">
            反馈已提交
        </div>
    </div>
    <form method="post" id="form" name="form">
        <div style=" padding:15px; color:#aaa;">
            为了更好的为您服务，解决您遇到的问题，或者举报不良漫画，请认真填写以下内容
        </div>
        <div style=" padding:15px; color:red;">
            也可以联系客服QQ群：939884850
        </div>
        {{--<div class="item">--}}
            {{--<input type="text" name="name" placeholder="请输入您的称呼">--}}
        {{--</div>--}}
        {{--<div class="item">--}}
            {{--<input type="text" name="contact" placeholder="请输入联系方式">--}}
        {{--</div>--}}
        <div class="comments_content" style=" border:1px solid #ddd;">
            <textarea name="_content" rows="" cols="" placeholder="需要什么漫画也可以提交上来，我们添加，如果您有什么意见和建议，或者遇到什么问题，请反馈给我们"></textarea>
        </div>

        <div class="btm" style=" padding:15px;">
            <button type="button" onclick="formSubmit()" style=" display:block; width:100%; line-height:30px;" class="mui-btn mui-btn-danger">提交反馈</button>
        </div>
    </form>
</div>


<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('js/layer.js')}}"></script>
<script type="text/javascript">
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    function formSubmit(){
        var l = layer.load(2);
        $.post("", $("form").serialize(), function(d){
            layer.close(l);
            if(d.code == 201){
                $("#form").hide();
                $("#success").show();
                return false;
            }
            layer.alert(d.msg);
        });
    }
</script>
</body>
</html>