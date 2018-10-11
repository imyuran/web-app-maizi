<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMQrcodeInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("m_qrcode_info", function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index()->comment("二维码名称");
            $table->string('unique_id')->unique()->comment('唯一标示');
            $table->string('url')->comment("二维码储存地址");
            $table->integer('type')->comment("4/6倍体");
            $table->integer('admin_id');
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
