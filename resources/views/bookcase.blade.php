<html><head>
    <meta charset="utf-8">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>阅读记录</title>
    <link href="{{asset('/css/mui.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('/css/swiper-3.4.2.min.css')}}">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_809906_xsowanr9ms8.css">
    <link rel="stylesheet" href="{{asset('css/novel.css')}}">
    <link rel="stylesheet" href="{{asset('/css/anime.css')}}">
    <style>
        html,body,{ max-width:600px; margin:0 auto;}
        .mui-bar-tab .mui-tab-item.mui-active{ color:#3688ff}
    </style>

    <style>
        .index_list_ol li{ position:relative; padding:15px 0;}
        .readbtn{ background:#FB645C; padding:5px 7px; font-size:12px; border-radius:5px;
            border:1px solid #e24d45; color:#fff; position:absolute; top:40px; right:10px;
        }
        .index_list_ol_div h3{ height:60px; overflow:hidden;}
    </style>
    <meta name="poweredby" content="dragondean">
</head>
<body style="background-color: #FFFFFF;">
<div class="bookcase">
    <div class="bookcase_top">
        <a href="javascript:;" class="bookcase_top_active">书签</a>

    </div>
    <div class="">
        <ol class="index_list_ol free_list">
            @foreach($cartoons as $cartoon)
            <li onclick="javascript:window.location.href='/detail/{{$cartoon->id}}'">

                <img src="{{$cartoon->thumb}}">
                <div class="index_list_ol_div">
                    <h3 >{{$cartoon->name}}</h3>
                    <p class="index_list_ol_div_btm" style=" color:#aaa; margin-top:0;">

                    </p>
                    <p class="index_list_ol_div_btm" style="color:#aaa; margin-top:8px;">
@if(isset($cartoon->footprint))上次看到：第{{$cartoon->footprint->page}}话 {{$cartoon->footprint->list_name}}
                    @endif
                    </p>
                    <a href="@if(isset($cartoon->footprint))/cartoon/{{$cartoon->id}}/{{$cartoon->footprint->page}}
                    @else/cartoon/{{$cartoon->id}}/1
@endif" class="readbtn">继续阅读</a>
                </div>
            </li>
                @endforeach
        </ol>
    </div>

    <div style=" height:60px;"></div>
    <!-- 底部nav -->

@include('common.footer')
</body>
</html>