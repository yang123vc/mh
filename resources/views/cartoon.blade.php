<html>
<head>

    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    @include('common.header')
    <title>第{{$cartoon->page}}话 {{$cartoon->name}}</title>
    <style>
        html,body{ max-width:600px; margin:0 auto;}
        .mui-bar-tab .mui-tab-item.mui-active{ color:#3688ff}
    </style>

    <style>
        h5{  padding-top: 5px;  }
        .field-contain label{  width: auto;  padding-right: 0;  }
        .field-contain input[type='text']{
            width: 40px;
            height: 30px;
            padding: 5px 0;
            float: none;
            text-align: center;
        }
        .flex{ display:flex; display:-webkit-flex;}
        .flex>div{ flex:1; -webkit-flex:1; text-align:center; padding:30px 0;}
        .flex div a{ border:1px solid #aaa; border-radius:5px; padding:10px 20px; color:#aaa;}
        .box_read{ padding:0;}
        .box_read p{ text-indent:0;}
        #content img{ max-width:100%; display:block;}
    </style>

</head>
<body class="mui-ios mui-ios-11 mui-ios-11-0" style="">
<div></div>

<div class="box_read" style="padding-bottom: 15px;">

    <p id="content" style=" font-size:18px">
        @foreach(explode(PHP_EOL,trim($cartoon->url))? : [trim($cartoon->url)] as $url)
        <img src="{{$url}}" onerror="this.src='/image/index/line.png'">
            @endforeach
      </p>
    <div class="flex">
        <div>
            <a href=" @if($cartoon->page > 1)/cartoon/{{$cartoon->cartoon_id}}/{{$cartoon->page-1}}  @endif" class="before">上一章</a>

        </div>
        <div>
            <a href="/cartoon/{{$cartoon->cartoon_id}}/{{$cartoon->page+1}}" class="after">下一章</a>
        </div>
    </div>
</div>
<div class="read_btmnav" style="height: 50px">
    <style>
        .float-top{
            width: 100%;
            height: 35px;
            position: fixed;
            top: 0;
            background-color: black;
            opacity:0.9;
        }

    </style>
    <div class="float-top">
            {{--<div style="color: #ffffff;text-align:center">{{$cartoon->name}}</div>--}}

           <div style="color: #ffffff;text-align:center">第{{$cartoon->page}}章     {{$cartoon->name}}</div>
    </div>



    <ul class="read_btmnav_btm">
        <li>
            <a href="@if($cartoon->page > 1)/cartoon/{{$cartoon->cartoon_id}}/{{$cartoon->page-1}} @endif">
                <span class="iconfont icon-mulu"></span>
                <span>上一章</span>
            </a>
        </li>

        <li>
            <a href="/list/{{$cartoon->cartoon_id}}">
                <span class="iconfont icon-mulu"></span>
                <span>目录</span>
            </a>
        </li>
        <li>
            <a href="javascript:;" @if($collect_type=='uncollect') id="fav" @endif>
                <span class="iconfont icon-shoucang"></span>
                <span class="txt">@if($collect_type=='uncollect')收藏@else 已收藏 @endif</span>
            </a>
        </li>
        <li>
            <a href="/index.php?m=&amp;c=Commic&amp;a=comments&amp;commic_id=1&amp;chapter_id=10882">
                <span class="iconfont icon-pinglun"></span>
                <span>评论</span>
            </a>
        </li>
        <li>
            <a href="/cartoon/{{$cartoon->cartoon_id}}/{{$cartoon->page+1}}">
                <span class="iconfont icon-mulu"></span>
                <span>下一章</span>
            </a>
        </li>
    </ul>

    <style>
        .float-btn{position:fixed;right:0px;bottom: 100px; text-align:center;}
        .float-btn a{background: rgba(0,0,0,.5); padding: 10px;color: #fff; border-bottom:1px solid #ccc; display:block;}
    </style>
    <div class="float-btn">

        <a href="/">
            <div>
                <span class="iconfont icon-shoucang"></span>
            </div>
            <div>首页</div>
        </a>
        <a href="/message">
            <div>
                <span class="iconfont icon-pinglun"></span>
            </div>
            <div>举报</div>
        </a>

    </div>
</div>

<style>
    .subscribe{ text-align:center;  padding:20px;}
    .subscribe .title{ font-size:20px; color:green;;}
    .subscribe img{ width:200px;}
    .subscribe .tips{ font-size:14px; color:#aaa; line-height:30px;}
</style>
<div id="subscribe" style=" display:none;">
    <div class="subscribe">
        <div class="title" style="">
            关注作者授权公众号继续阅读
        </div>
        <div class="qrcode">
            <img src="">
        </div>
        <div class="tips">长按识别上方二维码</div>
    </div>
</div>

<style>
    .buyway-mask{ display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,.7)}
    .buyway{ display:none; position:fixed; bottom:0; left:0; background:#fff; width:100%; padding:0;}
    .buyway-title{ line-height:40px; border-bottom:1px solid #ccc; padding-left:15px; font-size:12px; color:#aaa;}
    .buyway-list{ padding:0 15px;}
    .buyway-list .buyway-item:last-child{ border-bottom:none;}
    .buyway .buyway-item{ padding:10px 0; border-bottom:1px solid #ddd;}
    .buyway-item .buyway-name{ font-size:16px; color:#000;}
    .buyway-item .buyway-desc{ font-size:14px; color:#999;}
</style>
<div class="buyway-mask"></div>
<div class="buyway">
    <div class="buyway-title">
        请选择购买方式
    </div>
    <div class="buyway-list">
        <div class="buyway-item" onclick="buy('price')">
            <div class="buyway-name">按章节购买(45书币/章)</div>
            <div class="buyway-desc">看多少买多少，后续自动购买</div>
        </div>		</div>
</div>
@include('common.js')
<script type="text/javascript">
    function NoImage(imgObject){   this.style.display="none";  }
    //点击文本内容  隐藏上下属性栏
    var toolBarVisiable = true;
    $('.box_read p').click(function(){
        toolBarVisiable = !toolBarVisiable;
        toggleToolBar();
    });
    function toggleToolBar(){
        if(!toolBarVisiable){
            $('.box_read figure,.read_btmnav').fadeOut();
            $('.box_read').css({
                paddingBottom : '15px'
            });
        }else{
            $('.box_read figure,.read_btmnav').fadeIn();
            $('.box_read').css({
                paddingBottom : '95px'
            });
        }
    }
    $(window).scroll(function(){
        toolBarVisiable = false;
        toggleToolBar();
    })




    //点击收藏  改变里面文本内容
    $('#fav').click(function(){
        var cartoon_id = "{{$cartoon->cartoon_id}}"

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


    function changeUrlArg(url, arg, val){
        var pattern = arg+'=([^&]*)';
        var replaceText = arg+'='+val;
        return url.match(pattern) ? url.replace(eval('/('+ arg+'=)([^&]*)/gi'), replaceText) : (url.match('[\?]') ? url+'&'+replaceText : url+'?'+replaceText);
    }

    var subShow = 0; // 关注显示次数
    function subscribe(){
        // 跳转到关注页面
        var chapterId = chapterList[curIndex].id;
        var url = subscribeUrl.replace('_cpid_', chapterId);
        var l = layer.load(1);
        $.post(changeUrlArg(url,'ajax', 1), {}, function(d){
            layer.close(l);
            $("#subscribe .qrcode img").attr('src', d.qrcode);
            layer.open({
                btn:false,
                shade: [0.8,"#000"],
                title: false, //不显示标题
                content: $('#subscribe').html(), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
                cancel: function(){

                }
            });

            subShow ++;
        });
    }



    function buy(buyway){
        var l = layer.load(1);
        $.post("/index.php?m=&c=Commic&a=buy&commic_id=1&spread_id=", {index:curIndex, buyway:buyway}, function(d){
            layer.close(l);
            $(".buyway-mask,.buyway").hide();
            // 如果返回2则表示需要购买，3表示需要充值
            if(d.status!=1){
                if(d.status == 3){
                    layer.msg('书币不足，请充值',{time:800}, function(){
                        location.href = d.url;
                    });
                    return false;
                }
                alert(d.info);
                if(d.url && d.url !='')location.href = d.url;
                return false;

            }
            layer.msg('购买成功');
            document.title = d.info.title;
            $("#content").html(d.info.body);
            $('html,body').animate({scrollTop:0}, 100);
            var curUrl = changeUrlArg(location.href, 'chapter_id', chapterId);
            window.history.replaceState(null, '阅读', curUrl);
            saveHistory();
        });
    }

    $(".before").on("click", function(){
        if(curIndex < 1){
            layer.msg('没有了');
            return false;
        }

    });

    $(".after").on("click", function(){
        if(curIndex >= 74){
            layer.msg('没有了');
            return false;
        }

    });

</script>
<div class="layui-layer-move"></div>



</body>
</html>