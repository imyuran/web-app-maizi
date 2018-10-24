<?php

namespace App\Admin\Controllers;

use App\Models\MWheatLog;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Admin\Extensions\ExcelExpoter;

class WheatController extends Controller
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

            $content->header('小麦日志');
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

            $content->header('小麦日志');
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

            $content->header('小麦日志');
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
        return Admin::grid(MWheatLog::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->qrcode()->name('名称');
            $grid->steps( '步骤')->display(function ($steps) {
                return config('maizi.steps.'.$steps);
            });
            $grid->weather( '天气');
            $grid->key_1( '一级描述');
            $grid->key_2( '二级描述');
            $grid->key_3( '三级描述');
            $grid->key_4( '数值/等级');

            $grid->poster( '图片')->image();
            $grid->adminUser()->name('上传人');


            $grid->created_at('上传时间');
//            $grid->updated_at( '更新时间');

            $excel = new ExcelExpoter();
            $excel->setAttr([
                'id', '名称', '步骤', '天气', '一级描述', '二级描述', '三级描述', '数值/等级', '对比图', '上传人', '上传时间'
            ], [
                'id', 'qrcode.name', 'steps', 'weather', 'key_1', 'key_2', 'key_3', 'key_4', 'poster', 'admin_user.name', 'created_at'
            ]);
            $grid->exporter($excel);
            //禁用操作
            $grid->disableActions();
            //禁用添加
            $grid->disableCreateButton();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(MWheatLog::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->display('qrcode_id', 'QID')->value(3);
//            $form->select('type', '类型')->options(config("maizi.type"))->rules('required')->default(4);
            $form->select('steps', '步骤')->options(config("maizi.steps"))->rules('required')->default('2.1');
            $form->text('weather', '天气')->rules('required');
            $form->text('key_1', '一级描述')->rules('required');
            $form->text('key_2', '二级描述');
            $form->text('key_3', '三级描述');
            $form->text('key_4', '数值/等级');

            $form->image('poster','上传照片')->move('/photos');
            $form->hidden('admin_id')->value( Admin::user()->id );

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
