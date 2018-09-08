<?php

namespace Tests;

class MockNotificationRequest
{
    public $url;
    public $headers;
    public $query;
    public $code;

    public static function get($url, $headers)
    {
        return (object) [
            'code' => 200,
            'body' => (object) [
                'body' => collect([]),
                'links' => '',
                'meta' => '',
            ],
        ];
    }
}
