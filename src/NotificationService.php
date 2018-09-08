<?php

namespace Grafite\MissionControlApi;

use Exception;
use Grafite\MissionControlApi\BaseService;

class NotificationService extends BaseService
{
    public $token;
    public $email;
    public $curl;

    public function __construct($token = null, $email = null)
    {
        parent::__construct();

        $this->token = $token;
        $this->email = $email;

        $this->missionControlUrl = $this->missionControlDomain('notifications');
    }

    /**
     * Get notifications from Mission Control
     *
     * @return array
     */
    public function index()
    {
        $headers = [
            'X-Auth-Token' => $this->token,
            'X-Auth-Email' => $this->email,
        ];

        if (is_null($this->token)) {
            throw new Exception("Missing token", 1);
        }

        $response = $this->curl::get($this->missionControlUrl, $headers);

        if ($response->code != 200) {
            $this->error('Unable to message Mission Control, please confirm your token');
        }

        if ($response->body->status != 'success') {
            $this->error($response->body->message);
        }

        return [
            'data' => collect($response->body->data),
            'links' => $response->body->links,
            'meta' => $response->body->meta,
        ];
    }
}
