<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Http;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // No test reaches the network. Pages ask GitHub, the hub and the public server's status for what they show,
        // with the keys in .env; a request no test has faked throws instead, and the page takes it the way it takes
        // an unreachable host.
        Http::preventStrayRequests();
    }
}
