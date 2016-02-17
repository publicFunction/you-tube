<?php

namespace PublicFunction\YouTube\Services\Repository;

use PublicFunction\YouTube\Models\VideoThumbnails;

class VideoThumbnailsRepository {

    public function create($data) {
        $thumb = new VideoThumbnails();
        $thumb->fill($data);
        $thumb->save();
    }

}