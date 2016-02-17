<?php

namespace PublicFunction\YouTube\Lib;

class YouTubeError extends \Exception {

    const PLAYLIST_NOT_FOUND = "Playlist Not Found";

    public static function playlistNotFound() {
        return self::PLAYLIST_NOT_FOUND;
    }

}