<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipientTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function index_recipients()
    {
        $response = $this->get('/recipients');

        $response->assertStatus(200)->assertViewIs('user.recipients.index');
    }

    public function index_special_recipients()
    {
        
    }
}
