<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('task_status_id');
            $table->string('titulo');
            $table->string('descricao');
            $table->dateTime('data_criacao')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
            $table->dateTime('data_edicao')->nullable();
            $table->dateTime('data_remocao')->nullable();
            $table->dateTime('data_conclusao')->nullable();
            $table->foreign('task_status_id')->references('id')->on('task_status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
