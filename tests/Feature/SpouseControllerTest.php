<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Spouse;
use App\Models\User;

class SpouseControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() :void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RecipientSeeder']);
        $this->artisan('db:seed', ['--class' => 'SpouseSeeder']);

        $this->user = User::factory()->create();
        $this->spouse = Spouse::factory()->create();

        $this->requestData = (
            [
                'recipient_id' => $this->spouse->recipient_id,
                'name' => $this->spouse->name,
                'family_relationship' => $this->spouse->family_relationship
            ]
        );
    }

    //ゲスト用テスト（ログインなし）
    /** @test */
    public function 受給者情報詳細画面に配偶者情報が表示される_ログインなし()
    {
        $response = $this->get('/recipients/1');

        $response->assertStatus(200)
            ->assertViewIs('user.recipients.show')
            ->assertSee('島原　一夫');
    }

    /** @test */
    public function 配偶者情報編集画面が表示される_ログインなし()
    {
        $response = $this->get('recipients/1/spouses/1/edit');

        $response->assertStatus(200)
            ->assertViewIs('user.spouses.edit')
            ->assertSee('配偶者情報編集：島原　一夫');
    }

    /** @test */
    public function 配偶者情報を更新しようとしたときログイン画面に遷移する_ログインなし()
    {
        $response = $this->put('recipients/1/spouses/1',
            [
                'recipient_id' => 1,
                'name' => '島原　一雄',
                'family_relationship' => '夫'
            ]
        );

        $response->assertRedirect('/login');
    }

    /** @test */
    public function 配偶者を新規登録しようとしたときログイン画面に遷移する_ログインなし()
    {
        $response = $this->post('/recipients/2/spouses', $this->requestData);

        $response->assertRedirect('/login');
    }

    /** @test */
    public function 配偶者の所得計算画面が表示される_ログインなし()
    {
        $response = $this->get('/recipients/1/spouses/1/calculations/create');

        $response->assertStatus(200)
            ->assertViewIs('user.spouses.calculations.create')
            ->assertSee('所得計算：島原　一夫');
    }

    //ユーザー用テスト（ログインあり）
    /** @test */
    public function 受給者情報詳細画面に配偶者情報が表示される()
    {
        $response = $this->actingAs($this->user)
            ->get('/recipients/1');

        $response->assertStatus(200)
            ->assertViewIs('user.recipients.show')
            ->assertSee('島原　一夫');
    }
    
    /** @test */
    public function 配偶者情報編集画面が表示される()
    {
        $response = $this->actingAs($this->user)
            ->get('recipients/1/spouses/1/edit');

        $response->assertStatus(200)
            ->assertViewIs('user.spouses.edit')
            ->assertSee('配偶者情報編集：島原　一夫');
    }

    /** @test */
    public function 配偶者情報を更新する()
    {
        $response = $this->actingAs($this->user)
            ->put('recipients/1/spouses/1',
                [
                    'recipient_id' => 1,
                    'name' => '島原　一雄',
                    'family_relationship' => '夫'
                ]
            );

        $response->assertRedirect('/recipients/1');
        $this->assertDatabaseHas('spouses',
            [
                'name' => '島原　一雄'
            ]
        );
    }

    /** @test */
    public function 配偶者が登録されていない場合は新規登録ボタンが表示される()
    {
        $response = $this->actingAs($this->user)
            ->get('/recipients/2');

        $response->assertStatus(200)
            ->assertViewIs('user.recipients.show')
            ->assertSee('配偶者新規登録');
    }
}
