<html><head>

    <title>{{$cartoons[0]->cartoon->name}} - 章节目录</title>
    @include('common.header')
    <link rel="stylesheet" href="{{asset('css/font_921482_7ri78ecz91b.css')}}">
    <style type="text/css">
        body{
            background-color: #FCFCFC;
        }
    </style>


</head>
<body>
<div class="directory">
    <div class="header_tab">
        <div class="flex">
            <p><a href="/detail/{{$id}}">详情</a></p>
            <p class="active"><a style="display: block;" href="javascript:;">目录</a></p>
        </div>
        <div class="activeBoth title">
            <p>{{$status}}</p>
            <div class="activeBoth sequence">
                共 {{$cartoons->count()}} 章
            </div>
        </div>
    </div>
    <ul class="list">
@foreach($cartoons as $cartoon)
        <li class2="pay_active" onclick="location.href='/cartoon/{{$cartoon->cartoon_id}}/{{$cartoon->page}}'">
            <p class="txt">第{{$cartoon->page}}话 {{$cartoon->name}}</p>
            @if($cartoon->pay>0)
            <span class="iconfont icon-zuanshi pay">{{$cartoon->pay}}</span>
                @endif
        </li>
    @endforeach
    </ul>
    <div style="height: 47.5px;"></div>
    <div class="foot">
        <a href="/">返回首页</a>
        <a href="/cartoon/{{$cartoon->cartoon_id}}/1">开始阅读</a>
    </div>
</div>
@include('common.js')
<script type="text/javascript">

    //点击切换排序方式
    $('.header_tab .title .sequence span').click(function() {
        $('.header_tab .title .sequence span').removeClass('sequence_active');
        $(this).addClass('sequence_active');
    });

    //设置空div撑开头部内容
    $(function(){
        $('.empty').css({
            height : $('.header_tab').height()
        })
    })

    //点击列表  改变样式
    $('.directory .list li').click(function(){
        $('.directory .list li').removeClass('pay_active');
        $(this).addClass('pay_active');
    })

</script>
</body></html>