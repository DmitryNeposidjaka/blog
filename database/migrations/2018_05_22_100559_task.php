<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Task extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->enum('important', ['MAX', 'MIDDLE', 'MIN'])->comment('Градация по важности');
            $table->integer('creator');
            $table->integer('executor');
            $table->timestamp('assigned_at');
            $table->boolean('disabled')->default(0);
            $table->boolean('close')->default(0);
            $table->timestamps();
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
