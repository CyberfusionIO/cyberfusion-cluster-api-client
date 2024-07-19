<?php

namespace Cyberfusion\CoreApi\Tests;

use Cyberfusion\CoreApi\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testResponse()
    {
        $response = new Response(200, 'Test', ['data' => 'ok']);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertSame('Test', $response->getStatusMessage());
        $this->assertArrayHasKey('data', $response->getData());
        $this->assertSame('ok', $response->getData('data'));
        $this->assertNull($response->getData('foo'));
    }

    public function testMutatingResponseData()
    {
        $response = new Response(200, 'Test', ['data' => 'ok']);

        $this->assertArrayHasKey('data', $response->getData());
        $this->assertSame('ok', $response->getData('data'));

        $response->setData(['data' => 'fail']);

        $this->assertArrayHasKey('data', $response->getData());
        $this->assertSame('fail', $response->getData('data'));
    }
}
