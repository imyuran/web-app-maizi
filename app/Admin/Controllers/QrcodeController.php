<?php

namespace App\Admin\Controllers;

use App\Models\MQrcodeInfo;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Helper\Utils;

class QrcodeController extends Controller
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

            $content->header('二维码');
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

            $content->header('二维码');
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

            $content->header('二维码');
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
        return Admin::grid(MQrcodeInfo::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->name( '名称');
            $grid->url( '二维码')->image();
//            dd(config("maizi.type"));
            $grid->type( '类型')->using(config('maizi.type'));

//            $grid->admin_id( '二维码');
            $grid->admin_id('上传人')->display(function ($id) {
                $name = Utils::getAdminNameById($id);
                return $name;
            });

            $grid->created_at('创建时间');
            $grid->updated_at( '更新时间');

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        return Admin::form(MQrcodeInfo::class, function (Form $form) {


            $form->display('id', 'ID');
            $form->text('name', '名称')->rules('required|min:2;max:12');
//            $form->text('type', '类型');
            $form->select('type', '类型')->options(config("maizi.type"))->rules('required')->default(4);

            if (request('qrcode')) {
                $form->hidden('unique_id');
                $form->hidden('url');
            } else {
                $unique_id = uniqid();
                $qr_url = Utils::createQrcode($unique_id, config("maizi.url.getQrcodeInfo"));
                $url = config('app.url') . '/' . $qr_url;
                $form->hidden('unique_id')->value($unique_id);
                $form->hidden('url')->value($url);

            }

            $form->hidden('admin_id')->value( Admin::user()->id );

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
