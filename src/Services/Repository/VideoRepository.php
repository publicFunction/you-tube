<?php

namespace PublicFunction\YouTube\Services\Repository;

use PublicFunction\YouTube\Lib\YouTubeError;
use PublicFunction\YouTube\Models\Playlists;
use PublicFunction\YouTube\Models\PlaylistThumbnails;
use PublicFunction\YouTube\Models\Videos;

class VideoRepository {

    public function getVideos() {
        return Videos::all();
    }

    public function getCountOfVideosInPlaylist($playlist_id) {
        return Videos::where('playlist_id', $playlist_id)->get()->count();
    }

    public function getVideosByPlaylistId($playlist_id) {
        return Videos::where('playlist_id', $playlist_id)
            ->with('thumbnails')
            ->orderBy('position')
            ->get();
    }

    public function getVideoByVideoId($id) {
        return Videos::where('video_hash_id', $id)->first();
    }

    public function create($data, $playlist_pk) {
        $video = new Videos();

        $input['playlist_id'] = $playlist_pk;
        $input['video_id'] = $data->snippet->resourceId->videoId;
        $input['video_hash_id'] = $data->id;
        $input['title'] = $data->snippet->title;
        $input['description'] = $data->snippet->description;
        $input['published_at'] = $data->snippet->publishedAt;
        $input['position'] = $data->snippet->position;

        $video->fill($input);
        $video->save();
        return $video->fresh();
    }

    public function update($data) {
        $playlist = Playlists::where('playlist_id', $data->id)->get()->first();
        if(null === $playlist) {
            return YouTubeError::playlistNotFound();
        }
        var_dump($playlist->thumbnails0);
    }

}
