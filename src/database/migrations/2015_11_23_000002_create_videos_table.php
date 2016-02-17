<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('playlist_id');
            $table->string('video_id');
            $table->string('video_hash_id');
            $table->string('title');
            $table->string('description');
            $table->dateTime('published_at');
            $table->integer('position');
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
        Schema::drop('playlists');
    }
}
