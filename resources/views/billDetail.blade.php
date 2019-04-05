<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title>账单明细</title>
    <link rel="stylesheet" href="{{asset('/css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/iconfont.css')}}">
    <link rel="stylesheet" href="{{asset('css/novel.css')}}">
    <meta name="poweredby" content="dragondean">

</head>
<body style="background-color: #FFFFFF;">
<div class="box_binding box_contribute box_bill">
    <header>
        <a href="/index.php?m=&amp;c=my&amp;a=index">
            <span class="iconfont icon-xiangzuojiantou"></span>
        </a>
        <span class="bdsj">账单明细</span>
    </header>
    <ul class="box_bill_list">
     @foreach($userOrders as $userOrder)
        <li>
            <h3>
                充值	<span style=" float:right; font-size:20px;">{{$userOrder->money}}</span>
            </h3>
            <div class="box_bill_list_btm">
                <span>备注：</span>
                @if($userOrder->type == 1)
                <span>充值金币{{$userOrder->recharge_gold}} - 赠送金币{{$recharge_gold->send_gold ?? 0}}</span>
                @elseif($userOrder->type == 2)
                    <span>年费VIP</span>
                @else
                    <span>终身VIP</span>
                @endif
                <p>{{$userOrder->created_at}}</p>
            </div>
        </li>
        @endforeach

       							</ul>
    <style>
        .pages{ padding:10px;}
        .pages ul:after{ content:''; display:block; clear:both;}
        .pages ul li{ float:left; border: 1px solid #eee; padding:3px 10px; margin-right:10px; margin-bottom:10px;}
        .pages ul li.disabled{ display:none;}
        .pages ul li.active a{ color:#aaa;}
    </style>

    <div class="pages">
        <ul class="pagination"><li class="disabled"><a href="javascript:;">共 4 条记录</a></li>     </ul>			</div>
</div>


</body></html>