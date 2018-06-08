<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TaskTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 56);
            $table->boolean('disabled')->default(0);
            $table->timestamps();
        });
        Schema::create('task_to_tag', function (Blueprint $table) {
            $table->integer('task_id');
            $table->integer('task_tag_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('task_to_tag');

    }
}
