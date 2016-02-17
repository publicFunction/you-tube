<?php

namespace PublicFunction\YouTube\Services\Repository;

use PublicFunction\YouTube\Lib\YouTubeError;
use PublicFunction\YouTube\Models\Playlists;
use PublicFunction\YouTube\Models\PlaylistThumbnails;

class PlaylistRepository {

    public function getPlaylists() {
        return Playlists::orderBy('published_at' , 'DESC')->get();
    }

    public function getPlaylistsById($id) {
        return Playlists::where('id', $id)->get()->first();
    }

    public function getPlaylistsByPlaylistId($playlist_id) {
        return Playlists::where('playlist_id', $playlist_id)->get()->first();
    }

    public function create($data) {
        $playlist = new Playlists();

        $input['playlist_id'] = $data->id;
        $input['title'] = $data->snippet->title;
        $input['description'] = $data->snippet->description;
        $input['published_at'] = $data->snippet->publishedAt;

        $playlist->fill($input);
        $playlist->save();

        //foreach($data->snippet->thumbnails as $thumbnail) {
        //    $new_thumb = new PlaylistThumbnails();
        //    $thumbnail = (array)$thumbnail;
        //    $thumbnail['playlists_id'] = $playlist->id;
        //    var_dump($thumbnail);
        //    //$new_thumb->create($thumbnail);
        //    //$new_thumb->save();
        //}
        return $playlist->fresh();
    }

    public function update($data) {
        $playlist = Playlists::where('playlist_id', $data->id)->get()->first();
        if(null === $playlist) {
            return YouTubeError::playlistNotFound();
        }
        var_dump($playlist->thumbnails);
    }

    public function delete() {

    }
}