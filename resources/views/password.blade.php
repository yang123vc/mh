<html><head>

    <title>修改密码</title>
    @include('common.header')
</head>
<body style="background-color: #F4F4F4;">
<div class="box_binding box_pass">
    <header>
        <a href="javascript:history.go(-1);">
            <span class="iconfont icon-xiangzuojiantou"></span>
        </a>
        <span class="bdsj">修改密码</span>
    </header>
    <div class="binding_content">
        <form name="binding">
            原始密码
            <div class="pass">
            <input type="text"  id="password" value="" name="password" placeholder="请输入原始密码">
            </div>
            新密码
            <div class="pass">
                <input type="text"  id="password1" value="" name="password1" placeholder="请输入5-15位新密码">
            </div>
            确认新密码
            <div class="pass">
                <input type="text"  id="password2" value="" name="password2" placeholder="确认新密码">
            </div>
            {{--<div class="code">--}}
                {{--<input type="tel"  value="" name="code" placeholder="验证码">--}}
                {{--<input type="button" id="yzm" value="获取验证码" onclick="yzmButton()">--}}
            {{--</div>--}}
            {{--<div class="pass">--}}
                {{--<input type="password"  id="pass" value="" name="pass" placeholder="请输入6-16位密码(数字加字母)">--}}
            {{--</div>--}}
        </form>
        <div class="btn">
            <button id="toastBtn" type="button" class="mui-btn mui-btn-blue mui-btn-outlined">确定</button>
        </div>
    </div>
</div>




</body>
</html>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('js/layer.js')}}"></script>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    //点击按钮 判断输入框中的输入内容
    $('#toastBtn').click(function(){
        var password = $("#password").val();
        var password1 = $("#password1").val();
        var password2 = $("#password2").val();
        if(password1 !== password2){
            layer.msg('两次密码不一致');
            return false;
        }
        if(password1 =='' || password1.length < 5){
            layer.msg('密码必须大于5个字');
            return false;
        }
        if(password ==''){
            layer.msg('原始密码不能为空');
            return false;
        }
        var l = layer.load(1);
        $.post("/changePassword", {password:password, password1:password1}, function(d){

            layer.close(l);
            if(d.code !=201){
                if(d.code == 202){
                    layer.msg(d.msg, function(){
                        location.href = '/login'
                    });
                }else {
                    layer.msg(d.msg);
                    return false;
                }

            }
            layer.msg(d.msg, function(){
                location.href = d.data.url;
            });
        });
    });
</script>