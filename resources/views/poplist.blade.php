<html>
<head>
    <meta charset="utf-8">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>排行榜</title>
    <link href="{{asset('/css/mui.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/reset.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/font_921482_i89ed3fqez.css')}}">
    <link rel="stylesheet" href="{{asset('/css/swiper-3.4.2.min.css')}}">
    <link href="{{asset('/css/novel.css')}}" rel="stylesheet">
    <link href="//at.alicdn.com/t/font_809906_xsowanr9ms8.css" rel="stylesheet">

    <style>
        html,body{ max-width:600px; margin:0 auto;}
    </style>


<style>
    .flex{ display:flex; display:-webkit-flex;}
    .flex>a{ display:block; flex:1; -webkit-flex:1;}
    .tabs a{ padding:10px; text-align:center; color:#636262; border-bottom:1px solid #ccc;}
    .tabs a.active{ color:#FB655C; border-bottom-color:#FB655C}
    .index_list_ol_div_btm span:nth-child(2) span{ width:auto; padding:0px 10px;}
</style>
<meta name="poweredby" content="dragondean">



<div class="box_free">
    <header>
        <a href="/">
            <span class="iconfont icon-xiangzuojiantou"></span>
        </a>
        <span class="mf" style="line-height: 40px !important;">排行榜</span>
    </header>
    <div class="flex tabs" style=" padding-top:44px;">
        <a href="/poplist" @if(!request()->input('type'))class="active"@endif>人气榜</a>
        <a href="/poplist?type=2" @if(request()->input('type'))class="active"@endif>收藏榜</a>
    </div>
    <ol class="index_list_ol free_list" style=" padding-top:0;">
@foreach($cartoons as $cartoon)
        <li onclick="javascript:window.location.href='/detail/{{$cartoon->id}}'">
            <img src="{{$cartoon->thumb}}">
            <div class="index_list_ol_div">
                <h3>{{$cartoon->name}}</h3>
                <p class="index_list_ol_tex">简介：{{$cartoon->detail}}</p>
                <p class="index_list_ol_div_btm">

                    <span>
								<span>{{$cartoon->hit}}人气</span>

							</span>
                </p>
            </div>
        </li>
@endforeach
    </ol>
</div>



</body>
</html>