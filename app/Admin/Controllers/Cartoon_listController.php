<?php

namespace App\Admin\Controllers;

use App\Models\Cartoon;
use App\Models\Cartoon_list;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class Cartoon_listController extends Controller
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

        $index ='漫画';
        if(isset($_GET['cartoon_id']) && !empty($_GET['cartoon_id'])){
            $cartoon = Cartoon::find($_GET['cartoon_id']);
            $index = $cartoon->name;
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
        $grid = new Grid(new Cartoon_list);

        if(isset($_GET['cartoon_id']) && !empty($_GET['cartoon_id'])){
            session()->put(['cartoon_id'=>$_GET['cartoon_id']]);
            $grid->model()->where('cartoon_id',$_GET['cartoon_id']);
        }
        $grid->id('Id');
        $grid->cartoon()->name('漫画名称');
        $grid->name('Name');
        $grid->url('Url');
        $grid->page('Page');
        $grid->pay('Pay');

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
        $show = new Show(Cartoon_list::findOrFail($id));

        $show->id('Id');
        $show->cartoon_id('Cartoon id');
        $show->name('Name');
        $show->url('Url');
        $show->page('Page');
        $show->pay('Pay');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Cartoon_list);
        $cartoon_list =Cartoon_list::where('cartoon_id',session('cartoon_id'))->orderBy('page','desc')->select(['page','pay'])->first();
        $form->number('cartoon_id', 'Cartoon id')->default(session('cartoon_id'));
        $form->text('name', 'Name');
        $form->textarea('url', 'Url');
        if(session()->has('cartoon_id')){
            $form->number('page', 'Page')->default($cartoon_list->page+1);
            $form->number('pay', 'Pay')->default($cartoon_list->pay);
        }else{
            $form->number('page', 'Page');
            $form->number('pay', 'Pay');
        }


        return $form;
    }
}
