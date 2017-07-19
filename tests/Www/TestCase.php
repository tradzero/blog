<?php

namespace Tests\Www;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestCase extends \Tests\TestCase
{
    use DatabaseMigrations;
}
