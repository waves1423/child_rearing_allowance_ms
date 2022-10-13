<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

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

        //ユーザー用テスト（ログインあり）
    /** @test */
    public function 特別児童扶養手当受給者一覧画面が表示される()
    {
        $this->artisan('db:seed', ['--class' => 'UserSeeder']);

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/special_recipients');

        $response->assertStatus(200)
            ->assertViewIs('user.special_recipients.index')
            ->assertSee('特別児童扶養手当　受給者一覧');
    }
}
