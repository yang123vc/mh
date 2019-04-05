<?php

namespace App\Admin\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UserController extends Controller
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
        return $content
            ->header('Index')
            ->description('description')
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
        $grid = new Grid(new User);

        $grid->id('Id');
        $grid->username('账号')->display(function ($name) {

            switch ($this->status){
                case 1:
                    return $name;

                case 2:
                    return $name.'<a style="color: red">(封禁)</a>';

                    break;
            }

        });

        $grid->level('等级');



        $grid->gold('金币');
        $grid->created_at('创建时间');
        $grid->status('状态')->editable('select', [1 => '正常', 2 => '封禁']);
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
        $show = new Show(User::findOrFail($id));

        $show->id('Id');
        $show->username('账号');
        $show->password('密码')->as(function ($password) {
            return decrypt($password);
        });
        $show->level('等级');
        $show->status('状态')->unescape()->as(function ($status) {

            switch ($status){
                case 1:
                    return '正常';
                case 2:
                    return '<a style="color: red">(封禁)</a>';
                    break;
            }

        });


        $show->gold('金币');
        $show->created_at('创建时间');
        $show->updated_at('最后操作');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User);

        $form->text('username', '用户名');
        $form->number('level', '等级')->default(1);
        $form->number('status', '状态')->default(1);
        $form->number('gold', '金币');

        return $form;
    }
}
