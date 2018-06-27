<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NoteTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 56);
            $table->boolean('disabled')->default(0);
            $table->timestamps();
        });
        Schema::create('note_to_tag', function (Blueprint $table) {
            $table->integer('note_id');
            $table->integer('note_tag_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note_tags');
        Schema::dropIfExists('note_to_tag');
    }
}
