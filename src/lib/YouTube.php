<?php

namespace PublicFunction\YouTube\Lib;

class YouTube {

    private $key;
    private $secret;
    private $token;
    private $client;

    public function __construct($api) {
        $this->key = $api['key']['server'];
        //TODO: For OAuth2 Implimentation, but for now just the AI Key is good enough.
        //$connect = new YouTubeAuth($this->key, $this->secret);
        //$connect->connect();

        $this->client = new YouTubeClient($api);
    }

    public function client() {
        return $this->client;
    }

    public function getApiKey() {
        return $this->key;
    }


}