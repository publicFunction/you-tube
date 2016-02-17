<?php

namespace PublicFunction\YouTube\Services\Repository;

use PublicFunction\YouTube\Models\PlaylistThumbnails;

class PlaylistThumbnailsRepository {

    public function create($data) {
        $thumb = new PlaylistThumbnails();
        $thumb->fill($data);
        $thumb->save();
    }

}