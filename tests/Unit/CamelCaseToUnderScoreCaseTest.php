<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CamelCaseToUnderScoreCaseTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(camelCaseToUnderScoreCase('MyClass') == '_my_class', 'camel case convert to under score case Failed!');
        $this->assertTrue(true);
    }
}
