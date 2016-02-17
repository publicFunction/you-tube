<?php

Route::get('you-tube/', '\PublicFunction\YouTube\YouTubeController@index');
Route::get('you-tube/playlists', '\PublicFunction\YouTube\YouTubeController@playlists');
Route::get('you-tube/videos', '\PublicFunction\YouTube\YouTubeController@videos');