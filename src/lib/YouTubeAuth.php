<?php

namespace PublicFunction\YouTube\Lib;


class YouTubeAuth {

    private $auth2_key;
    private $auth2_secret;
    private $auth2_token;

    public function __construct($key, $secret) {
        $this->setKey($key);
        $this->setSecret($secret);
        $this->connect();
    }

    private function setKey($key) {
        $this->auth2_key = $key;
    }

    private function setSecret($secret) {
        $this->auth2_secret = $secret;
    }

    private function setToken($token) {
        $this->auth2_token = $token;
    }

    public function getToken() {
        return $this->auth2_token;
    }

    public function connect() {
        $auth_client_id = $this->auth2_key;
        $auth_client_secret = $this->auth2_secret;

        var_dump($auth_client_id);
        var_dump($auth_client_secret);

    }

}