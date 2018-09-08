<?php

namespace Tests;

use Grafite\MissionControlApi\ProjectService;
use PHPUnit\Framework\TestCase;
use Tests\MockProjectRequest;

class ProjectServiceTest extends TestCase
{
    public $service;
    public $request;

    public function setUp()
    {
        parent::setUp();

        $this->service = new ProjectService('foo@foo.bar', 'token');
        $this->request = new MockProjectRequest;
        $this->service->setCurl($this->request);

        $this->project = null;
    }

    public function testIndex()
    {
        $result = $this->service->index();

        $this->assertTrue(is_object($result['data']));
        $this->assertTrue(empty($result['links']));
        $this->assertTrue(empty($result['meta']));
    }

    public function testCreate()
    {
        $result = $this->service->create([
            'url' => 'testing.com'
        ]);

        $this->assertEquals($result['url'], 'testing.com');
    }

    public function testShow()
    {
        $result = $this->service->index('uuid');

        $this->assertTrue(is_object($result['data']));
    }

    public function testUpdate()
    {
        $result = $this->service->update('111-222-333-444', [
            'name' => 'foo',
        ]);

        $this->assertTrue(is_object($result));
    }

    public function testDelete()
    {
        $result = $this->service->delete('111-222-333-444');

        $this->assertTrue($result);
    }
}
