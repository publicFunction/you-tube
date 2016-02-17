<?php

namespace PublicFunction\YouTube\Models;

use Illuminate\Database\Eloquent\Model;

class PlaylistThumbnails extends Model {

    protected $guarded = array();
    protected $hidden = array();
    protected $with = array();
    protected $table = 'playlist_thumbnails';

    public function playlist() {
        return $this->belongsTo('PublicFunction\YouTube\Models\Playlists');
    }

    public function getThumbnail($size) {
        return $this->where('size', $size)->first();
    }

    public function getThumbnailURL($size) {
        return $this->getThumbnail($size)->url;
    }
}