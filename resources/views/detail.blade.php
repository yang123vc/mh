<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <link href="{{asset('css/mui.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="http://at.alicdn.com/t/font_921482_i89ed3fqez.css">
    <link rel="stylesheet" href="{{asset('css/swiper-3.4.2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/anime.css')}}">
    <link rel="stylesheet" href="http://m8.hongjingkeji.com/Public/plugins/layer/theme/default/layer.css?v=3.1.1" id="layuicss-layer">
    <style>
        .search{ display:block; width:30px; line-height:30px; text-align:center; background:rgba(0,0,0,.5); border-radius:50%;
            position:absolute; top:10px; right:10px; color:#fff; z-index:10;
        }
        .search-form{ display:none; position:absolute; top:10px; padding:15px; padding-top:0; opacity:0.7; z-index:20; width:100%;line-height:40px;}
        .search-form input{ text-align:center; padding:0 50px 0 5px; box-sizing:border-box; width:100%; height:40px; line-height:40px; background:#fff; border-radius:2px;}
        .search-form .search-btn{ position:absolute; right:10px; top:0; padding:0 15px;}
        .title{ font-weight:bold;}
    </style>
    <meta name="poweredby" content="dragondean">
    <title>Title</title>
    <style>
        .details_list li{
            height: 250px;
        }
    </style>
</head>
<body>
<div class="directory particulars">
    <div class="header_tab">

        <div class="top_window" style=" background:url({{$cartoon->thumb}}); background-size:cover; height:200px;">

            <div class="mask">
                <br>
                <a onclick="javascript:history.back(-1);"  style="color:#ff4a4a;font-size: x-large;" > 返回首页 </a>
                <span class="iconfont icon-xiangyou1 goback"></span>
                <a style="display: block;" href="/index.php?m=&amp;c=Commic&amp;a=index">
                    <span class="iconfont icon-fangzi home"></span>
                </a>
                <div class="headline">
                    <h3 class="p_over">{{$cartoon->name}}</h3>
                    <p class="activeBoth p_over">
                        <span class="txt">@if($cartoon->end ==1)已完结@else连载中@endif</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="flex">
            <p class="active"><a href="javascript:;">详情</a></p>
            <p><a href="/list/{{$cartoon->id}}">目录</a></p>
        </div>
    </div>

    <div class="content">
        <div class="works_introduce">
            <p class="introduce">{{$cartoon->detail}}</p>
            <div class="flex">
                <div class="active">
                    <img style="width: 28px;" src="http://m8.hongjingkeji.com/Public/anime/img/particulars_stars.png">
                    <p>评论(<span>5</span>)</p>
                </div>
                <div class="active">
                    <img style="width: 27px;margin-top: 3px;" src="http://m8.hongjingkeji.com/Public/anime/img/particulars_information.png">
                    <p>累计评价(<span>1</span>)</p>
                </div>
                <div>
                    <img style="width: 23px;margin-top: 2px;" src="http://m8.hongjingkeji.com/Public/anime/img/particulars_fire.png">
                    <p>人气值(<span>{{$cartoon->hit}}</span>)</p>
                </div>
            </div>
        </div>
        <div class="comments">
        {{--<div class="title">--}}
        {{--<h3>最新评论</h3>--}}
        {{--<a href="/index.php?m=&amp;c=Commic&amp;a=comments&amp;commic_id=1">--}}
        {{--<span class="iconfont icon-pinglun"></span>--}}
        {{--<span>写评价</span>--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<ul class="comments_list">--}}
        {{--<li>--}}
        {{--<div class="activeBoth personal_details">--}}
        {{--<img src="http://thirdwx.qlogo.cn/mmopen/rLpHsVF9HCUabuyR41lRAWAyOXMWwhMJWW7KHpFEfkhDHzS2vRXfT2Tiaa15Cn1n1WdMys39tEYZoEhpQ4u1ucw/132" alt="">--}}
        {{--<p class="name">Memoirs.♥</p>--}}
        {{--<span class="time">2019-01-03</span>--}}
        {{--</div>--}}
        {{--<p class="text">--}}
        {{--11111111111							</p>--}}
        {{--</li>--}}
        {{--</ul>--}}
        {{--<a class="entire" href="/index.php?m=&amp;c=Commic&amp;a=comments_list&amp;commic_id=1">查看全部评论</a>				</div>--}}
        <!--猜你喜欢-->
            <div class="bg_pad index_product">
                <div class="index_product_top">
                    <span class="iconfont icon-icon2"></span>
                    <h3>猜你喜欢</h3>

                </div>
                <ul class="details_list">
                    @foreach($likes as $like)
                        <li>
                            <a href="/detail/{{$like->id}}">
                                <img src="{{$like->thumb}}" style=" background:url(http://manhua-1251281796.cos.ap-chengdu.myqcloud.com/mhfm/b2jugu4byes1513.jpg); background-size:cover">
                                <div class="introduce">
                                    <p class="title">{{$like->name}}</p>
                                    <p class="details">{{$like->detail}}</p>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>


            </div>
        </div>

        <div style="height: 47.5px;"></div>
        <div class="foot">
            <div class="collection" @if($collect_type=='uncollect') id="fav" @endif>
                <span class="iconfont icon-guanzhu"></span>
                <span class="txt">@if($collect_type=='uncollect') 加入收藏@else 已收藏 @endif</span>
            </div>
            <div class="start">
                <a href="/cartoon/{{$cartoon->id}}/1">开始阅读</a>
            </div>
            <!--div class="exceptional">
                <span class="iconfont icon-liwu"></span>
                <span>打赏书籍</span>
            </div-->
        </div>
        {{--<div class="exceptional_mask">--}}
            {{--<div class="content">--}}
                {{--<img class="bg_img" src="/Public/anime/img/exceptional_mask_bg.png">--}}
                {{--<span class="iconfont icon-cha poor"></span>--}}
                {{--<ul class="mask_list">--}}
                    {{--<li class="active">--}}
                        {{--<div>--}}
                            {{--<img src="/Public/anime/img/mask_list_img.png" alt="">--}}
                            {{--<p class="num_mask">1</p>--}}
                        {{--</div>--}}
                        {{--<h3 class="name">面具</h3>--}}
                        {{--<p class="money">366金币</p>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<div>--}}
                            {{--<img src="/Public/anime/img/mask_list_img.png" alt="">--}}
                        {{--</div>--}}
                        {{--<h3 class="name">面具</h3>--}}
                        {{--<p class="money">366金币</p>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<div>--}}
                            {{--<img src="/Public/anime/img/mask_list_img.png" alt="">--}}
                        {{--</div>--}}
                        {{--<h3 class="name">面具</h3>--}}
                        {{--<p class="money">366金币</p>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<div>--}}
                            {{--<img src="/Public/anime/img/mask_list_img.png" alt="">--}}
                        {{--</div>--}}
                        {{--<h3 class="name">面具</h3>--}}
                        {{--<p class="money">366金币</p>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<div>--}}
                            {{--<img src="/Public/anime/img/mask_list_img.png" alt="">--}}
                        {{--</div>--}}
                        {{--<h3 class="name">面具</h3>--}}
                        {{--<p class="money">366金币</p>--}}
                    {{--</li>--}}
                {{--</ul>--}}
                {{--<div class="number">--}}
                    {{--<p class="balance">余额：0</p>--}}
                    {{--<div class="calculate">--}}
                        {{--<span class="iconfont icon-minusj"></span>--}}
                        {{--<span class="num">1</span>--}}
                        {{--<span class="iconfont icon-jia"></span>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<button class="btn">余额不足，请充值</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>


    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{asset('js/layer.js')}}"></script>
    <script src="{{asset('js/mui.min.js')}}"></script>

    <script type="text/javascript">
        //点击收藏/取消收藏
        $('#fav').click(function(){
            var cartoon_id = "{{$cartoon->id}}"

            $.get("/addCollect",{cartoon_id:cartoon_id}, function(d){
                if(d.code != 201){
                    if(d.code == 501){
                        layer.msg(d.msg);
                    }
                    layer.msg(d.msg);

                }else{
                    $("#fav .txt").text('已收藏');
                }
            });
        });

        //点击返回上一层(历史记录)
        function goBack(){
            window.history.back();
        }

        //点击显示充值页面
        $('.foot .exceptional').click(function(){
            $('.particulars .exceptional_mask').css({
                display: 'block'
            })
        });
        //点击隐藏充值页面
        $('.exceptional_mask .poor').click(function(){
            $('.particulars .exceptional_mask').css({
                display: 'none'
            })
        });


        //设置空div撑开头部内容
        $(function(){
            $('.empty').css({
                height : $('.header_tab').height()
            });
            $('.calculate .num').html(num); //动态写入充值数量
            $('.exceptional_mask .mask_list .num_mask').html(num); //动态写入充值数量
        });

        //点击切换充值金币
        $('.exceptional_mask .mask_list li').click(function(){
            $('.exceptional_mask .mask_list li').removeClass('active'); //清空充值页面的li标签的active样式
            $(this).addClass('active'); //添加充值页面点击的li标签的active样式

            $('.exceptional_mask .mask_list li div p').remove(); //清空充值页面图片上的充值数量标签
            $(this).find('div').append('<p class="num_mask"></p>'); //动态添加充值页面图片上的充值数量标签

            //重置充值数量的初始值
            num = 1;
            $('.calculate .num').html(num); //动态写入充值数量
            $('.exceptional_mask .mask_list .num_mask').html(num); //动态写入充值数量
        })

        var num = 1; //写入充值数量的初始值
        //点击增加充值数量
        $('.calculate .icon-jia').click(function(){
            num++;
            $('.calculate .num').html(num);
            $('.exceptional_mask .mask_list .num_mask').html(num);
        });
        //点击减少充值数量
        $('.calculate .icon-minusj').click(function(){
            if(num > 0){
                num--;
                $('.calculate .num').html(num);
                $('.exceptional_mask .mask_list .num_mask').html(num);
            }
        });

    </script>
</body>
</html>