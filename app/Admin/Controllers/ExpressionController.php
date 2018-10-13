<?php

namespace App\Admin\Controllers;

use App\Models\MExpressionInfo;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Helper\Utils;
use App\Admin\Extensions\ExcelExpoter;

class ExpressionController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('表现型');
            $content->description('列表');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('表现型');
            $content->description('编辑');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('表现型');
            $content->description('新增');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(MExpressionInfo::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->type( '类型')->using(config('maizi.type'));
            $grid->steps( '步骤')->using( config('maizi.steps'));
            $grid->key_1( '一级描述');
            $grid->key_2( '二级描述');
            $grid->key_3( '三级描述');

            $grid->poster( '对比图')->image();
            $grid->admin_id('上传人')->display(function ($id) {
                $name = Utils::getAdminNameById($id);
                return $name;
            });

            $grid->created_at('创建时间');
            $grid->updated_at( '更新时间');


            $excel = new ExcelExpoter();
            $excel->setAttr([
                'id', '类型', '步骤', '一级描述', '二级描述', '三级描述', '对比图', '上传人', '创建时间'
            ], [
                'id', 'type', 'step', 'key_1', 'key_2', 'key_3', 'poster', 'admin_id', 'created_at'
            ]);
            $grid->exporter($excel);
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(MExpressionInfo::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->select('type', '类型')->options(config("maizi.type"))->rules('required')->default(4);
            $form->select('steps', '步骤')->options(config("maizi.steps"))->rules('required')->default('2.1');
            $form->text('key_1', '一级描述')->rules('required');
            $form->text('key_2', '二级描述');
            $form->text('key_3', '三级描述');

            $form->image('poster','上传对照图')->move('/posters');
            $form->hidden('admin_id')->value( Admin::user()->id );

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
