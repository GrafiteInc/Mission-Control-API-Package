<?php

namespace Tests;

use Grafite\MissionControlApi\NotificationService;
use PHPUnit\Framework\TestCase;
use Tests\MockNotificationRequest;

class NotificationServiceTest extends TestCase
{
    public $service;
    public $request;

    public function setUp()
    {
        parent::setUp();

        $this->service = new NotificationService('foo@foobar.foo', 'token');
        $this->request = new MockNotificationRequest;
        $this->service->setCurl($this->request);
    }

    public function testGet()
    {
        $result = $this->service->index();

        $this->assertTrue(is_object($result['data']));
        $this->assertTrue(empty($result['links']));
        $this->assertTrue(empty($result['meta']));
    }
}
