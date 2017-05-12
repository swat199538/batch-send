<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsAssistantTemple extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('as_assistant_temple',function(Blueprint $table){
            $table->increments('id')->unsignedBigInteger();
            $table->unsignedBigInteger('category_id')->comment('助手ID');
            $table->text('content')->comment('短信内容');
            $table->string('seo_word')->nullable()->comment('SEO关键词');
            $table->integer('click_count')->default('0')->comment('用户点击数');
            $table->datetime('update_at')->nullable()->comment('更新时间');
            $table->dateTime('create_at')->comment('创建时间');
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
