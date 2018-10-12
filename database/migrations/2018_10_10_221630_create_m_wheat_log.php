<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMWheatLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("m_wheat_log", function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qrcode_id')->comment("二维码id")->index();
            $table->integer('admin_id')->comment("上传人id")->index();
            $table->string('poster')->comment("上传图片");

            $table->integer('steps')->comment("步骤");
            $table->string('key_1')->comment("一级描述");
            $table->string('key_2')->comment("二级描述");
            $table->string('key_3')->comment("三级描述");
            $table->string('key_4')->comment("四级描述");

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
