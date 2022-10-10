<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpecialRecipientControllerTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */    
    public function 特別児童扶養手当受給者一覧画面が表示される_ログインなし()
    {
        $response = $this->get('/special_recipients');

        $response->assertStatus(200)
            ->assertViewIs('user.special_recipients.index')
            ->assertSee('特別児童扶養手当　受給者一覧');
    }
}
