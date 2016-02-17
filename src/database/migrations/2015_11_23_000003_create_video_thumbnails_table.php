<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoThumbnailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_thumbnails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('videos_id')->unsigned();
            $table->foreign('videos_id')->references('id')->on('videos');
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
        Schema::drop('video_thumbnails');
    }
}
