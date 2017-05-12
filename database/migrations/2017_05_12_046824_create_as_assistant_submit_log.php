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
            $table->text('phone')->comment('接受短信的手机号码');
            $table->text('content')->comment('短信内容');
            $table->unsignedBigInteger('category_id')->comment('短信分类ID');
            $table->unsignedBigInteger('template_id')->comment('短信模板ID');
            $table->tinyInteger('is_submit')->default('0')->comment('是否提交');
            $table->unsignedBigInteger('task_id')->unique()->comment('任务ID');
            $table->string('token')->index()->nullauto()->comment('任务获取令牌');
            $table->tinyInteger('is_request')->default('0')->nullauto()->comment('任务是否获取过，获取为1，未获取为0');
            $table->datetime('create_at')->comment('创建时间');
            $table->datetime('update_at')->comment('修改时间')->nullauto();
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
