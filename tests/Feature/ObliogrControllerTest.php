<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Obligor;
use App\Models\User;

class ObliogrControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() :void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RecipientSeeder']);
        $this->artisan('db:seed', ['--class' => 'ObligorSeeder']);

        $this->user = User::factory()->create();
        $this->obligor = Obligor::factory()->create();

        $this->requestData = ([
            'recipient_id' => $this->obligor->recipient_id,
            'name' => $this->obligor->name,
            'family_relationship' => $this->obligor->family_relationship
        ]);
    }

    //ゲスト用テスト（ログインなし）
    /** @test */
    public function 受給者情報詳細画面に扶養義務者情報が表示される_ログインなし()
    {
        $response = $this->get('/recipients/1');

        $response->assertStatus(200)
            ->assertViewIs('user.recipients.show')
            ->assertSee('島原　和男');
    }

    /** @test */
    public function 扶養義務者情報編集画面が表示される()
    {
        $response = $this->get('recipients/1/obligors/1/edit');

        $response->assertStatus(200)
            ->assertViewIs('user.obligors.edit')
            ->assertSee('扶養義務者情報編集：島原　和男');
    }

    /** @test */
    public function 扶養義務者情報を更新しようとしたときログイン画面に遷移する_ログインなし()
    {
        $response = $this->put('recipients/1/obligors/1',
        [
            'recipient_id' => 1,
            'name' => '島原　一雄',
            'family_relationship' => '父'
        ]);

        $response->assertRedirect('/login');
    }

    /** @test */
    public function 扶養義務者を新規登録しようとしたときログイン画面に繊維する_ログインなし()
    {
        $response = $this->post('/recipients/2/obligors', $this->requestData);

        $response->assertRedirect('/login');
    }

    /** @test */
    public function 扶養義務者の所得計算画面が表示される_ログインなし()
    {
        $response = $this->get('/recipients/1/obligors/1/calculations/create');

        $response->assertStatus(200)
            ->assertViewIs('user.obligors.calculations.create')
            ->assertSee('所得計算：島原　和男');
    }
}
