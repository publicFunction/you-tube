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

}