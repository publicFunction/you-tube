<?php

namespace PublicFunction\YouTube;


use Illuminate\Routing\Controller as Controller;
use PublicFunction\YouTube\Lib\YouTubeClient;
use PublicFunction\YouTube\Services\Repository\PlaylistRepository;
use PublicFunction\YouTube\Services\Repository\PlaylistThumbnailsRepository;
use PublicFunction\YouTube\Services\Repository\VideoRepository;
use PublicFunction\YouTube\Services\Repository\VideoThumbnailsRepository;

class YouTubeController extends Controller {

    private $app;
    private $client;

    public function __construct(PlaylistRepository $playlistRepository,
                                PlaylistThumbnailsRepository $playlistThumbnailsRepsoitory,
                                VideoRepository $videoRepository,
                                VideoThumbnailsRepository $videoThumbnailsRepository
                                ) {
        $this->app = app();
        $config = $this->app['config'];
        $config_yt = $config['youtube'];
        $api = $config_yt['api'];

        $yt = new YouTube($api);
        $this->client = $yt->client();
        $this->_playlist_repository = $playlistRepository;
        $this->_playlist_thumb_repository = $playlistThumbnailsRepsoitory;
        $this->_video_repository = $videoRepository;
        $this->_video_thumb_repository = $videoThumbnailsRepository;
    }

    public function index() {
        $playlists = $this->_playlist_repository->getPlaylists();

        return \View::make('playlist')->with('playlists',$playlists);
    }

    public function playlists() {
        $playlists = $this->client->get('playlists');
        foreach($playlists->items as $index => $playlist) {
            $new_playlist = $this->_playlist_repository->getPlaylistsByPlaylistId($playlist->id);
            if($new_playlist !== null) {
                if($new_playlist->thumbnails->count()) {
                    foreach($new_playlist->thumbnails as $key => $thumbnail) {
                        $thumbnail->delete();
                    }
                }
                $this->createThumbnails($playlist->snippet, $new_playlist->id, 'playlist');
                continue;
            }
            $new_playlist = $this->_playlist_repository->create($playlist);
            $this->createThumbnails($playlist->snippet, $new_playlist->id, 'playlist');
        }
    }

    public function videos() {
        $playlists = $this->_playlist_repository->getPlaylists();
        $args = array();
        $args['part'] = "snippet";
        foreach($playlists as $playlist) {
            $args['playlistId'] = $playlist->playlist_id;
            $videos = $this->client->get('playlistItems', $args);
            foreach($videos->items as $video){
                $new_video = $this->_video_repository->getVideoByVideoId($video->id);
                if($new_video === null) {
                    $new_video = $this->_video_repository->create($video, $playlist->id);
                }
                if($new_video->thumbnails->count()) {
                    foreach($new_video->thumbnails as $key => $thumbnail) {
                        $thumbnail->delete();
                    }
                }
                $this->createThumbnails($video->snippet, $new_video->id, 'video');
                continue;

            }
        }
    }

    private function createThumbnails($model, $model_id, $type='playlist') {
        try {
            if ($model->thumbnails) {
                foreach($model->thumbnails as $size => $thumbnail) {
                    $thumb_data = (array)$thumbnail;
                    $thumb_data['size'] = $size;
                    $fk = $type."s_id";
                    $thumb_data[$fk] = $model_id;
                    $repos = "_".$type."_thumb_repository";
                    $this->$repos->create($thumb_data);
                }
            }
        } catch (\Exception $e) {

        }
    }
}
