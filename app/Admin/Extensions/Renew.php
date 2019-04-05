<?php

namespace App\Admin\Extensions;

use App\Models\Cartoon;
use App\Models\User;
use Encore\Admin\Admin;

class Renew
{
    protected $id;
    public $cartoon;
    public $key;
    public $content;
    public function __construct($id)
    {
        $this->id = $id;
        $this->cartoon = Cartoon::find($this->id);
        $this->key = "<a class='btn btn-sm btn-default grid-check-row-$this->id'   style='width:80px;margin-left:-25px' data-id='.$this->id.'>设置免费</a>";
        $this->content = "将要将名称为【".$this->cartoon->name."】的漫画设置为免费，是否确认";
        if($this->cartoon->pay == 1){
            $this->key = "<a class='btn btn-sm btn-default grid-check-row-$this->id'   style='width:80px;color:red;margin-left:-25px' data-id='.$this->id.'>设置收费</a>";
            $this->content = "将要将名称为【".$this->cartoon->name."】的漫画设置为收费，是否确认";
        }
    }

    protected function script()
    {



        return <<<EOT

  
$('.grid-check-row-$this->id').on('click', function () {
  var cartoon_id = $this->id

 $("#cartoon_id").val(cartoon_id);
 
document.getElementById("content").innerHTML="{$this->content}";

  $("#delcfmOverhaul").modal({
        backdrop : 'static',
        keyboard : false
    });

});



EOT;
    }

    protected function render()
    {
        Admin::script($this->script());


        return "{$this->key}
<form action=\"/admin/setfreestatus\" method=\"post\">
<input type=\"hidden\"  name=\"_token\" value=".csrf_token().">
<input type=\"hidden\" id=\"cartoon_id\"  name=\"cartoon_id\" value='$this->cartoon->id'>
            <div class=\"modal fade\" id=\"delcfmOverhaul\">
                                <div class=\"modal-dialog\" >
                                    <div class=\"modal-content message_align\">
                                        <div class=\"modal-header\" style=\"background-color: #55ACEE\">
                                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\"
                                                aria-label=\"Close\">
                                                <span aria-hidden=\"true\">×</span>
                                            </button>
                                            <h4 class=\"modal-title\">提示</h4>
                                        </div>
                                        <div class=\"modal-body\">
                                            <!-- 隐藏需要删除的id -->
                                            <input type=\"hidden\" id=\"deleteHaulId\" />
                                            <p id='content'></p>
                                        </div>
                                        <div class=\"modal-footer\">
                                            <button type=\"button\" class=\"btn btn-default\"
                                                data-dismiss=\"modal\">取消</button>
                                            <button type=\"submit\" class=\"btn btn-primary\"
                                                id=\"renew\">确认</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                </div>
                                </form>

";

    }

    public function __toString()
    {
        return $this->render();
    }
}