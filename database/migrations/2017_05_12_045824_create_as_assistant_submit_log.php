<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsAssistantSubmitLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('as_assistant_submit_log',function(Blueprint $table){
            $table->increments('id')->unsignedBigInteger();
            $table->string('uuid')->nullauto()->comment('未登录用的临时标识');
            $table->string('username')->nullauto()->comment('登录后的用户名');
            $table->text('content')->comment('短信内容');
            $table->text('phone')->comment('接受短信的手机号码');
            $table->unsignedBigInteger('category_id')->comment('短信分类ID');
            $table->unsignedBigInteger('template_id')->comment('短信模板ID');
            $table->tinyInteger('is_submit')->default('0')->comment('是否提交');
            $table->datetime('create_at')->comment('创建时间');
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
