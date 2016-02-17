<?php

namespace PublicFunction\YouTube\Models;

use Illuminate\Database\Eloquent\Model;

class VideoThumbnails extends Model {

    protected $guarded = array();
    protected $hidden = array();
    protected $with = array();
    protected $table = 'video_thumbnails';

    public function video() {
        return $this->belongsTo('PublicFunction\YouTube\Models\Video');
    }

}