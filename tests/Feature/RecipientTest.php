<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function 児童扶養手当受給者一覧画面が表示される_ログインなし()
    {
        $response = $this->get('/recipients');

        $response->assertStatus(200)
            ->assertViewIs('user.recipients.index')
            ->assertSee('児童扶養手当　受給者一覧');
    }

    /** @test */    
    public function 特別児童扶養手当受給者一覧画面が表示される_ログインなし()
    {
        $response = $this->get('/special_recipients');

        $response->assertStatus(200)
            ->assertViewIs('user.special_recipients.index')
            ->assertSee('特別児童扶養手当　受給者一覧');
    }

    /** @test */    
    public function 受給者情報詳細画面が表示される_ログインなし()
    {
        $this->artisan('db:seed', ['--class' => 'RecipientSeeder']);
        
        $response = $this->get('/recipients/1');

        $response->assertStatus(200)
            ->assertSee('島原　一子');
    }
}
