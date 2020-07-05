<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Api extends TestCase
{

    
    /**
     * When the endpoint:
     * GET http://localhost:8080/api/external-books?name=:nameOfABook
     * is requested, your application should query the Ice And Fire API 
     * and use the data received to respond with a JSON result
     *
     * @return void
     */
    public function testRequirementOne()
    {
        $response = $this->get('');

        $response->assertStatus(200);
    }
}
