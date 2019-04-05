<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .fileinput-upload-button {
        display: none;
    }
</style>
<section class="content">

    <div class="row">
        <div class="box box-info">

            <form method="POST" action="{{url('admin/listscript')}}" class="form-horizontal"
                  accept-charset="UTF-8">
                <div class="box-body" style="display: block;">

                    <input type="hidden" value="{{csrf_token()}}" name="_token">
                    <div class="box-body fields-group">


                        <div class="form-group" style="width: 50%">
                            <label for="name" class="col-sm-2 control-label">漫画ID</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="cartoon_id" name="cartoon_id" value="" class="form-control name"
                                           placeholder="输入 漫画ID">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="width: 50%">
                            <label for="name" class="col-sm-2 control-label">每章图片数量</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="average" name="average" value="15" class="form-control name"
                                           placeholder="输入 平均每页图片数量">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="width: 50%">
                            <label for="name" class="col-sm-2 control-label">图片总数</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="num" name="num" value="" class="form-control name"
                                           placeholder="输入 图片总数">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="width: 50%">
                            <label for="name" class="col-sm-2 control-label">路径名称</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="name" name="name" value="" class="form-control name"
                                           placeholder="输入 路径名称">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="width: 50%">
                            <label for="name" class="col-sm-2 control-label">前几章免费</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="free_page" name="free_page" value="6" class="form-control name"
                                           placeholder="输入 路径名称">
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="box-footer">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                    </div>

                    <div style="margin-left: 15%">

                        <button type="button" class="btn btn-default" style="width: 110px">取消</button>
                        <button type="submit" class="btn btn-primary" style="width: 110px;margin-left: 10px">提交</button>

                    </div>
                </div>
            </form>
        </div>
    </div>

</section>


<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

</script>
