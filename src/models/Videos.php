<?php

namespace PublicFunction\YouTube\Models;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model {

    protected $guarded = array();
    protected $hidden = array();
    protected $with = array('thumbnails');
    protected $table = 'videos';

    public function thumbnails() {
        return $this->hasMany('PublicFunction\YouTube\Models\VideoThumbnails');
    }

    public function getThumbnail($size) {
        return $this->thumbnails()->where('size', $size)->first();
    }

    public function getThumbnailUrl($size) {
        return $this->getThumbnail($size)->url;
    }

}