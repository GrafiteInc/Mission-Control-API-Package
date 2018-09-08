<?php

namespace Tests;

class MockProjectRequest
{
    public $url;
    public $headers;
    public $query;
    public $code;

    public static function post($url, $headers, $query)
    {
        return (object) [
            'code' => 200,
            'body' => (object) [
                'status' => 'success',
                'data' => [
                    'url' => 'testing.com',
                    'uuid' => '111-222-333-444',
                ]
            ],
        ];
    }

    public static function put($url, $headers, $query)
    {
        return (object) [
            'code' => 200,
            'body' => (object) [
                'status' => 'success',
                'data' => (object) [
                    'url' => 'testing.com',
                    'uuid' => '111-222-333-444',
                ]
            ],
        ];
    }

    public static function get($url, $headers)
    {
        return (object) [
            'code' => 200,
            'body' => (object) [
                'status' => 'success',
                'data' => null
            ],
        ];
    }

    public static function delete($url, $headers)
    {
        return (object) [
            'code' => 200,
            'body' => (object) [
                'status' => 'success',
                'message' => 'successfully deleted'
            ],
        ];
    }
}
