<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AsCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('as_category',function(Blueprint $table){
            $table->increments('id')->unsignedBigInteger();
            $table->string('name')->comment('分类名称');
            $table->decimal('price',10,2)->comment('单个助手价格');
            $table->string('picture',255)->comment('助手图片');
            $table->string('seo_word')->nullable()->comment('SEO关键词');
            $table->tinyInteger('is_hot')->default(0)->comment('是否热门商品1代表热门，0代表普通');
            $table->tinyInteger('order')->default(0)->comment('排序,从0-9排序');
            $table->integer('click_count')->default(0)->coment('用户点击数');
            $table->dateTime('update_at')->nullable()->comment('更新时间');
            $table->dateTime('create_at')->nullable()->comment('创建时间');
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
