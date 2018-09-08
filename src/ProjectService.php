<?php

namespace Grafite\MissionControlApi;

use Exception;
use Grafite\MissionControlApi\BaseService;
use Unirest\Request\Body;

class ProjectService extends BaseService
{
    public $token;
    public $email;
    public $curl;

    public function __construct($token = null, $email = null)
    {
        parent::__construct();

        $this->token = $token;
        $this->email = $email;

        $this->missionControlUrl = $this->missionControlDomain('projects');
    }

    /**
     * Get projects from Mission Control
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

    /**
     * Get a project from Mission Control
     *
     * @return Object
     */
    public function show($uuid)
    {
        $headers = [
            'X-Auth-Token' => $this->token,
            'X-Auth-Email' => $this->email,
        ];

        if (is_null($this->token)) {
            throw new Exception("Missing token", 1);
        }

        $response = $this->curl::get($this->missionControlUrl.'/'.$uuid, $headers);

        if ($response->code != 200) {
            $this->error('Unable to message Mission Control, please confirm your token');
        }

        if ($response->body->status != 'success') {
            $this->error($response->body->message);
        }

        return $response->body->data;
    }

    /**
     * Create a project on Mission Control
     *
     * @return Object
     */
    public function create($payload)
    {
        $headers = [
            'X-Auth-Token' => $this->token,
            'X-Auth-Email' => $this->email,
            'Accept' => 'application/json',
        ];

        if (is_null($this->token)) {
            throw new Exception("Missing token", 1);
        }

        $body = Body::json($payload);
        $response = $this->curl::post($this->missionControlUrl, $headers, $body);

        if ($response->code != 200) {
            $this->error('Unable to message Mission Control, please confirm your token');
        }

        if ($response->body->status != 'success') {
            $this->error($response->body->message);
        }

        return $response->body->data;
    }

    /**
     * Update a project on Mission Control
     *
     * @return Object
     */
    public function update($uuid, $payload)
    {
        $headers = [
            'X-Auth-Token' => $this->token,
            'X-Auth-Email' => $this->email,
            'Accept' => 'application/json',
        ];

        if (is_null($this->token)) {
            throw new Exception("Missing token", 1);
        }

        $body = Body::json($payload);
        $response = $this->curl::put($this->missionControlUrl.'/'.$uuid, $headers, $body);

        if ($response->code != 200) {
            $this->error('Unable to message Mission Control, please confirm your token');
        }

        if ($response->body->status != 'success') {
            $this->error($response->body->message);
        }

        return $response->body->data;
    }

    /**
     * Delete a project on Mission Control
     *
     * @return bool
     */
    public function delete($uuid)
    {
        $headers = [
            'X-Auth-Token' => $this->token,
            'X-Auth-Email' => $this->email,
        ];

        if (is_null($this->token)) {
            throw new Exception("Missing token", 1);
        }

        $response = $this->curl::delete($this->missionControlUrl.'/'.$uuid, $headers);

        if ($response->code != 200) {
            $this->error('Unable to message Mission Control, please confirm your token');
        }

        if ($response->body->status != 'success') {
            $this->error($response->body->message);
        }

        return ($response->body->status === 'success');
    }
}
