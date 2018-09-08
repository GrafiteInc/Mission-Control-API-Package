<?php

namespace Grafite\MissionControlApi;

use Unirest\Request;

class BaseService
{
    public $curl;

    public function __construct()
    {
        $this->curl = new Request();
    }

    public function setCurl($instance)
    {
        $this->curl = $instance;
    }

    public function missionControlDomain($url)
    {
        return 'http://missioncontrol.test/api/'.$url;
        // return 'https://getmissioncontrol.io/api/'.$url;
    }

    public function error($message)
    {
        if (!is_null($message)) {
            error_log($message);
        }
    }
}
