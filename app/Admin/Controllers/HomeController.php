<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('小麦组后台');
            $content->description('服务器详情');

            $content->row(Dashboard::title());

            $content->row(function (Row $row) {

                /**
                 * 环境信息
                 */
                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });
                /**
                 * 扩展
                 */

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                /**
                 * 依赖
                 */
                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });
        });
    }
}
