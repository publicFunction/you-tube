<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistThumbnailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_thumbnails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('playlists_id')->unsigned();
            $table->foreign('playlists_id')->references('id')->on('playlists');
            $table->string('size');
            $table->string('url');
            $table->integer('width');
            $table->integer('height');
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
