<html><head>
    <title>书库</title>
    @include('common.header')
    <style>
        .cftion_top div select{ -webkit-appearance:none;}
    </style>
</head>
<body style="background-color: #F4F4F4;">
<div class="box_cftion">
    <header>
        <a href="/">
            <span class="iconfont icon-xiangzuojiantou"></span>
        </a>
        <span>分类</span>
    </header>
    <div class="cftion_top">
        <div>类型</div>
        <div>
            <select style="margin-top:10px" id="sex_type" default="" onchange="fi()">
                <option value="" selected="selected">频道</option>
                <option value="2">男生</option>
                <option value="1">女生</option>
            </select>
        </div>
        <div>
            <select style="margin-top:10px" id="is_end" default="" onchange="fi()">
                <option value="3"  @if(isset($_GET['is_end']) && $_GET['is_end'] ==3) selected="selected" @endif>状态</option>
                <option value="2" @if(isset($_GET['is_end']) && $_GET['is_end'] ==2) selected="selected" @endif>连载</option>
                <option value="1" @if(isset($_GET['is_end']) && $_GET['is_end'] ==1) selected="selected" @endif>完结</option>
            </select>
        </div>
        <div>
            <select style="margin-top:10px" id="is_free" default="" onchange="fi()">
                <option value="3"  @if(isset($_GET['is_free']) && $_GET['is_free'] ==3) selected="selected" @endif>属性</option>
                <option value="2"  @if(isset($_GET['is_free']) && $_GET['is_free'] ==2) selected="selected" @endif>付费</option>
                <option value="1"  @if(isset($_GET['is_free']) && $_GET['is_free'] ==1) selected="selected" @endif>免费</option>
            </select>
        </div>

    </div>
    <div class="cftion_content">
        <div class="tab_menu">
            <ul>
                <li><a class="@if(!isset($_REQUEST['cate_id']))selected @endif" href="/cate">全部</a></li>
                @foreach($cates as $cate)
                    <li><a class="@if(isset($_REQUEST['cate_id']) && $_REQUEST['cate_id'] == $cate->id)selected @endif" href="/cate?cate_id={{$cate->id}}">{{$cate->name}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="tab_box">
            <div>
                <ul class="tab_box_list">
                    @foreach($cartoons as $cartoon)
                        <li onclick="location.href='/detail/{{$cartoon->id}}'">
                            <img style="height: 150px" src="{{$cartoon->thumb}}">
                            <div class="tab_box_list_right">
                                <h3>{{$cartoon->name}}</h3>
                                <p class="tab_box_list_txt" style=" height:40px; line-height:20px;white-space:normal;">简介：{{$cartoon->detail}}</p>
                                <p class="tab_box_list_txt_btm" style="margin-top:5px;">
                                    <span>作者：佚名</span>

                                    <span class="tab_box_list_txt_btm_span">
	            						<span>{{$cartoon->hit}}</span>
	            						<span style="padding: 0;border: none;">热度</span>
	            					</span>
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>


        </div>
    </div>
</div>
@include('common.js')
{{--<script>--}}
    {{--if ('addEventListener' in document) {--}}
        {{--document.addEventListener('DOMContentLoaded', function() {--}}
            {{--FastClick.attach(document.body);--}}
        {{--}, false);--}}
    {{--}--}}
{{--</script>--}}



{{--<script>--}}
    {{--$('ul.tab_box_list').infiniteScroll({--}}
        {{--path: '.pagination .next',--}}
        {{--append: 'ul.tab_box_list li',--}}
        {{--history: false,--}}
        {{--hideNav: '.pages',--}}
        {{--checkLastPage: '.pagination .next',--}}
        {{--status: '.page-load-status'--}}
    {{--});--}}

{{--</script>--}}
<script type="text/javascript" charset="utf-8">

    function fi() {
        var cate  = '{{isset($_GET['cate_id'])?'cate_id='.$_GET['cate_id']:'cate_id='}}';
        var is_end = $('#is_end').val();
        var is_free = $('#is_free').val();
        location.href = '/cate?'+cate+'&is_end='+is_end+'&is_free='+is_free;
    }
    
    $("li[href]").on('click', function(){
        location.href = $(this).attr('href');
    });

    // 调整默认选择内容
    $("select").each(function(index, element) {
        $(element).find("option[value='" + $(this).attr('default') + "']:eq(0)").attr('selected', 'selected');
    });


</script>
</body></html>