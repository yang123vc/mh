<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <link href="{{asset('/css/mui.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('/css/font_921482_i89ed3fqez.css')}}">
    <link rel="stylesheet" href="{{asset('/css/swiper-3.4.2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/anime.css')}}">
    <style>
        .index_product{
            background-color: transparent;
        }
        .search{ display:block; width:30px; line-height:30px; text-align:center; background:rgba(0,0,0,.5); border-radius:50%;
            position:absolute; top:10px; right:10px; color:#fff; z-index:10;
        }
        .search-form{ display:none; position:absolute; top:10px; padding:15px; padding-top:0; opacity:0.7; z-index:20; width:100%;line-height:40px;}
        .search-form input{ text-align:center; padding:0 50px 0 5px; box-sizing:border-box; width:100%; height:40px; line-height:40px; background:#fff; border-radius:2px;}
        .search-form .search-btn{ position:absolute; right:10px; top:0; padding:0 15px;}
        .title{ font-weight:bold;}
    </style>
    <meta name="poweredby" content="dragondean">
    <title>73漫画</title>
</head>
<body style="background:transparent">

{{--<a href="/search" class="search"><span class="iconfont icon-sousuo"></span></a>--}}

<div class="box_index">
    <div class="bg_pad" style="padding: 0;">

        <div class="index_top" style=" padding-top:0;">

            <div class="swiper-container swiper-container-horizontal">
                <div class="swiper-wrapper" style="transform: translate3d(-1106px, 0px, 0px); transition-duration: 0ms;">

                    @foreach($banners as $k => $banner)
                    <a href="/detail/{{$banner['cartoon_id']}}" class="swiper-slide swiper-slide-prev" data-swiper-slide-index="{{$k}}" style="width: 553px;">
                        <img src="{{$banner['image']}}" alt="">
                    </a>
                    @endforeach
                </div>

            </div>



            <!--头部列表-->
            <ul class="list">
                <li>
                    <a href="/cate?cate_id=&is_end=3&is_free=1">
                        <img style="width: 90%;" src="http://m8.hongjingkeji.com//Public/anime/img/1.png" alt="">

                    </a>免费动漫
                </li>
                <li>
                    <a href="/poplist">
                        <img style="width: 90%;" src="http://m8.hongjingkeji.com//Public/anime/img/2.png" alt="">

                    </a>热门动漫
                </li>
                {{--<li>--}}
                    {{--<a href="http://at.alicdn.com/index.php?m=&amp;c=My&amp;a=charge">--}}
                        {{--<img style="width: 90%;" src="http://m8.hongjingkeji.com//Public/anime/img/3.png" alt="">--}}
                    {{--</a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>
    <!--独家首发-->
    <div class="bg_pad index_product">
        <div class="index_product_top">
            <h3>
                <img src="http://m8.hongjingkeji.com/Public/anime/img/title1.png" style=" height:20px;">
                强烈推荐
                <img src="http://m8.hongjingkeji.com/Public/anime/img/title2.png" style=" height:20px;">
            </h3>

        </div>
        @if(isset($cartoons_first_thumb->id))
        <div class="cover" >
            <a href="/detail/{{$cartoons_first_thumb->id}}">
                <img style="height: 150px" src="{{$cartoons_first_thumb->thumb}}" alt="正在加载中...">
                <div class="introduce">
                    <p class="title">{{$cartoons_first_thumb->name}}</p>
                </div>
            </a>
        </div>
        @endif
        <ul class="details_list details_list2">
            @foreach($cartoons_firsts as $cartoons_first)
                <li>
                    <a href="/detail/{{$cartoons_first->id}}">
                        <img src="http://m8.hongjingkeji.com/Public/anime/img/300-150.png" style=" background:url({{$cartoons_first->thumb}}); background-size:cover">
                        <div class="introduce">
                            <p class="title">{{$cartoons_first->name}}</p>
                            <p class="details">{{$cartoons_first->introduce}}</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>

    </div>
    <div class="bg_pad index_product">
        <div class="index_product_top">
            <h3>
                <img src="http://m8.hongjingkeji.com/Public/anime/img/title1.png" style=" height:20px;">
                经典完结
                <img src="http://m8.hongjingkeji.com/Public/anime/img/title2.png" style=" height:20px;">
            </h3>

        </div>
        @if(isset($cartoons_first_thumb->id))
        <div class="cover">
            <a href="/detail/{{$cartoons_second_thumb->id}}">
                <img style="height: 150px" src="{{$cartoons_second_thumb->thumb}}" alt="正在加载中...">
                <div class="introduce">
                    <p class="title">{{$cartoons_second_thumb->name}}</p>
                </div>
            </a>
        </div>
        @endif
        <ul class="details_list details_list2">
            @foreach($cartoons_seconds as $cartoons_second)
                <li>
                    <a href="/detail/{{$cartoons_second->id}}">
                        <img src="http://m8.hongjingkeji.com/Public/anime/img/300-150.png" style=" background:url({{$cartoons_second->thumb}}); background-size:cover" alt="">
                        <div class="introduce">
                            <p class="title">{{$cartoons_second->name}}</p>
                            <p class="details">{{$cartoons_second->introduce}}</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>

    </div>

    <div class="bg_pad index_product">
        <div class="index_product_top">
            <h3>
                <img src="http://m8.hongjingkeji.com/Public/anime/img/title1.png" style=" height:20px;">
                免费专区
                <img src="http://m8.hongjingkeji.com/Public/anime/img/title2.png" style=" height:20px;">
            </h3>

        </div>
        @if(isset($cartoons_third_thumb->id))
        <div class="cover">
            <a href="/detail/{{$cartoons_third_thumb->id}}">
                <img style="height: 150px" src="{{$cartoons_third_thumb->thumb}}" alt="正在加载中...">
                <div class="introduce">
                    <p class="title">{{$cartoons_third_thumb->name}}</p>
                </div>
            </a>
        </div>
        @endif
        <ul class="details_list details_list2">
            @foreach($cartoons_thirds as $cartoons_third)
                <li>
                    <a href="/detail/{{$cartoons_third->id}}">
                        <img src="http://m8.hongjingkeji.com/Public/anime/img/300-150.png" style=" background:url({{$cartoons_third->thumb}}); background-size:cover" alt="">
                        <div class="introduce">
                            <p class="title">{{$cartoons_third->name}}</p>
                            <p class="details">{{$cartoons_third->introduce}}</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>

    </div>

    <div class="bg_pad index_product">
        <div class="index_product_top">
            <h3>
                <img src="http://m8.hongjingkeji.com/Public/anime/img/title1.png" style=" height:20px;">
                新书报道
                <img src="http://m8.hongjingkeji.com/Public/anime/img/title2.png" style=" height:20px;">
            </h3>

        </div>
        <ul class="details_list details_list2">
            @foreach($cartoons_fours as $cartoons_four)
                <li>
                    <a href="/detail/{{$cartoons_four->id}}">
                        <img src="http://m8.hongjingkeji.com/Public/anime/img/300-150.png" style=" background:url({{$cartoons_four->thumb}}); background-size:cover">
                        <div class="introduce">
                            <p class="title">{{$cartoons_four->name}}</p>
                            <p class="details">{{$cartoons_four->introduce}}</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
        <!--p class="ending">没有更多了~</p-->
    </div>
</div>

{{--<div style=" background:#fff; padding-top:20px;">--}}
    {{--<img src="{{asset('/image/index/xyss.png')}}">--}}

{{--</div>--}}
<div style="height: 49px;"></div>
<!-- 底部nav -->
@include('common.footer')

<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('js/swiper-3.4.2.min.js')}}"></script>
<script type="text/javascript" charset="utf-8">

    //banner 轮播
    var myswiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        loop: true,
        autoplay: 3000,
    });
    @if(!$user)
    confirm('漫画全部免费看！！！ 登陆后不再提示，也可以加Q群：939884850');
    @endif


</script>

</body>
</html>