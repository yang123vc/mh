<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Renew;
use App\Models\Cartoon;
use App\Http\Controllers\Controller;
use App\Models\Cartoon_list;
use App\Models\Cate;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class CartoonController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        $index ='分类';
        if(isset($_GET['cate_id']) && !empty($_GET['cate_id'])){
            $cate = Cate::find($_GET['cate_id']);
            $index = $cate->name;
        }

        return $content
            ->header($index)
            ->description('列表')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cartoon);
        if(isset($_GET['cate_id']) && !empty($_GET['cate_id'])){
            $grid->model()->where('cate_id',$_GET['cate_id']);
        }
        $grid->id('Id');
        $grid->cate_id('分类ID');
        $grid->category()->name('分类名称');
        $grid->name('名称');
        $grid->introduce('简介');
//        $grid->detail('详情');
        $grid->thumb('封面')->image(100,150);

        $grid->hit('点击量');
        $grid->sort('排序');
        $grid->recommend('推荐');
        $grid->end('End');

        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');
        $grid->actions(function ($actions) {
            $key = $actions->getKey();
            // append一个操作
            $actions->prepend('<a target="_blank"  href="/admin/cartoon_list?cartoon_id='.$key.'  ">漫画列表</a>');
            $actions->prepend(new Renew($key));



        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Cartoon::findOrFail($id));

        $show->id('Id');
        $show->cate_id('Cate id');
        $show->name('名称');
        $show->introduce('简介');
        $show->detail('详情');
        $show->thumb('封面');
        $show->hit('点击量');
        $show->sort('排序');
        $show->recommend('推荐');
        $show->end('End');
        $show->created_at('创建时间');
        $show->updated_at('更新时间');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Cartoon);

//        $form->number('cate_id', '分类ID');
        $option1 = Cate::pluck('name','id')->toArray();
        $form->select('cate_id','分类')->options($option1);
        $form->text('name', '名称');
        $form->text('introduce', '简介');
        $form->textarea('detail', '详情');
        $form->text('thumb', '封面');
        $form->number('hit', '点击量');
        $form->number('sort', '排序');
        $form->number('recommend', '推荐？')->default(1);
        $option = ['1'=>'已完结','2'=>'连载中'];
        $form->select('end','end')->options($option);

        return $form;
    }


    public function setFreeStatus(Request $request)
    {

        $cartoon = Cartoon::find($request->cartoon_id);

        if($cartoon->pay == 1)
        {
            $cartoon->update([
                'pay' => 2
            ]);
            Cartoon_list::where('cartoon_id',$cartoon->id)
                ->where('page','>',6)
                ->update([
                    'pay' => 48
                ]);
        }else{
            $cartoon->update([
                'pay' => 1
            ]);
            Cartoon_list::where('cartoon_id',$cartoon->id)
                ->update([
                    'pay' => 0
                ]);
        }

        admin_toastr('操作成功');

        return redirect()->back();

    }
}
