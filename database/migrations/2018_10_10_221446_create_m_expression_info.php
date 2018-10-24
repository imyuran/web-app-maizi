<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMExpressionInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //
        Schema::create("m_expression_info", function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->comment("4/6倍体");
            $table->integer('admin_id')->comment("上传人id")->index();
            $table->string('poster')->comment("对比图片");
            $table->integer('steps')->comment("步骤")->index();

            $table->string('key_1')->comment("一级描述");
            $table->string('key_2')->comment("二级描述")->nullable();
            $table->string('key_3')->comment("三级描述")->nullable();
            $table->string('key_4')->comment("是否需要数值")->defalult(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
