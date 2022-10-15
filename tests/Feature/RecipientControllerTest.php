<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RecipientControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() :void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->artisan('db:seed', ['--class' => 'RecipientSeeder']);
    }

    //ゲスト用テスト（ログインなし）
    /** @test */
    public function 児童扶養手当受給者一覧画面が表示される_ログインなし()
    {
        $response = $this->get('/recipients');

        $response->assertStatus(200)
            ->assertViewIs('user.recipients.index')
            ->assertSee('児童扶養手当　受給者一覧');
    }

    /** @test */    
    public function 受給者情報詳細画面が表示される_ログインなし()
    {
        $response = $this->get('/recipients/1');

        $response->assertStatus(200)
            ->assertViewIs('user.recipients.show')
            ->assertSee('受給者詳細：島原　一子');
    }

    /** @test */
    public function 受給者の基本情報編集画面が表示される_ログインなし()
    {
        $response = $this->get('/recipients/1/edit');

        $response->assertStatus(200)
            ->assertViewIs('user.recipients.edit')
            ->assertSee('受給者情報編集：島原　一子');
    }

    /** @test */
    public function 受給者の所得計算画面が表示される_ログインなし()
    {
        $response = $this->get('/recipients/1/calculations/create');

        $response->assertStatus(200)
            ->assertViewIs('user.recipients.calculations.create')
            ->assertSee('所得計算：島原　一子');
    }

    //ユーザー用テスト（ログインあり）
    /** @test */
    public function 児童扶養手当受給者一覧画面が表示される()
    {
        $response = $this->actingAs($this->user)
            ->get('/recipients');

        $response->assertStatus(200)
            ->assertViewIs('user.recipients.index')
            ->assertSee('児童扶養手当　受給者一覧');
    }

    /** @test */    
    public function 受給者情報詳細画面が表示される()
    {
        $response = $this->actingAs($this->user)
            ->get('/recipients/1');

        $response->assertStatus(200)
            ->assertViewIs('user.recipients.show')
            ->assertSee('受給者詳細：島原　一子');
    }    

    /** @test */
    public function 受給者の基本情報編集画面が表示される()
    {
        $response = $this->actingAs($this->user)
            ->get('/recipients/1/edit');

        $response->assertStatus(200)
            ->assertViewIs('user.recipients.edit')
            ->assertSee('受給者情報編集：島原　一子');
    }

    /** @test */
    public function 受給者の所得計算画面が表示される()
    {
        $response = $this->actingAs($this->user)
            ->get('/recipients/1/calculations/create');

        $response->assertStatus(200)
            ->assertViewIs('user.recipients.calculations.create')
            ->assertSee('所得計算：島原　一子');
    }

    /** @test */
    public function 受給者新規登録画面が表示される()
    {
        $response = $this->actingAs($this->user)
            ->get('/recipients/create');

        $response->assertStatus(200)
            ->assertViewIs('user.recipients.create')
            ->assertSee('受給者新規登録');
    }
}
