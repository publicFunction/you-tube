<?php


return array(
    'api' => array(
        'url' => 'https://www.googleapis.com/youtube/v3/',
        'key' => array(
            'browser' => "KEY1",
            'server' => "KEY2",
        ),
        'args' => array(
            'channelId' => "UCRMokxzufyesqkXCL8IQxMA",
            'part' => 'snippet',
            'maxResults' => 50,
        ),
        //?part=snippet&channelId=UCRMokxzufyesqkXCL8IQxMA&key={YOUR_API_KEY}
    ),
    'api_key' => array(

    ),
    'oauth2' => array(
        'client_id' => "",
        'client_secret' => "",
    ),
    "permissions" => array(
        'url' => 'https://www.googleapis.com/auth/',
        'scope' => array(
            'youtube',
            'youtube.force-ssl',
            'youtube.readonly',
            //'youtube.upload',
            //'youtubepartner',
            //'youtubepartner-channel-audit',
        ),
    ),
);
