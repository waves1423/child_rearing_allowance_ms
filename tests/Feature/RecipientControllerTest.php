<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Recipient;
use App\Models\User;

class RecipientControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() :void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RecipientSeeder']);
        
        $this->admin = Admin::factory()->create();
        $this->user = User::factory()->create();
        $this->recipient = Recipient::factory()->create();

        $this->requestData = ([
            'number' => $this->recipient->number,
            'name' => $this->recipient->name,
            'kana' => $this->recipient->kana,
            'sex' => $this->recipient->sex,
            'birth_date' => $this->recipient->birth_date,
            'adress' => $this->recipient->adress,
            'allowance_type' => $this->recipient->allowance_type,
            'is_submitted' => $this->recipient->is_submitted,
            'additional_document' => $this->recipient->additional_document,
            'is_public_pentioner' => $this->recipient->is_public_pentioner,
            'multiple_recipient' => $this->recipient->multiple_recipient,
            'note' => $this->recipient->note
        ]);
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
    public function 受給者新規登録画面が表示される_ログインなし()
    {
        $response = $this->get('/recipients/create');

        $response->assertStatus(200)
            ->assertViewIs('user.recipients.create')
            ->assertSee('受給者新規登録');
    }

    /** @test */
    public function 受給者を新規登録しようとしたときログイン画面に遷移する_ログインなし()
    {
        $response = $this->post('/recipients', $this->requestData);

        $response->assertRedirect('/login');
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
    public function 受給者の基本情報を更新しようとしたときログイン画面に遷移する_ログインなし()
    {
        $response = $this->put('/recipients/1',
        [
            'number' => 24543001,
            'name' => '島原　一子',
            'kana' => 'しまばら　かずこ',
            'sex' => 2,
            'birth_date' => '1990/09/01',
            'adress' => '児童市4001番地1',
            'allowance_type' => 1,
            'is_submitted' => false,
            'additional_document' => '養育費申告書、別居監護申立書',
            'is_public_pentioner' => false,
            'multiple_recipient' => 1,
            'note' => ''
        ]);

        $response->assertRedirect('/login');
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
    public function 受給者新規登録画面が表示される()
    {
        $response = $this->actingAs($this->user)
            ->get('/recipients/create');

        $response->assertStatus(200)
            ->assertViewIs('user.recipients.create')
            ->assertSee('受給者新規登録');
    }

    /** @test */
    public function 受給者を新規登録する()
    {
        $response = $this->actingAs($this->user)
            ->post('/recipients', $this->requestData);

        $response->assertRedirect('/recipients');
        $this->assertDatabaseHas('recipients', [
            'number' => $this->recipient->number,
            'name' => $this->recipient->name,
            'kana' => $this->recipient->kana,
            'sex' => $this->recipient->sex,
            'birth_date' => $this->recipient->birth_date,
            'adress' => $this->recipient->adress,
            'allowance_type' => $this->recipient->allowance_type,
            'is_submitted' => $this->recipient->is_submitted,
            'additional_document' => $this->recipient->additional_document,
            'is_public_pentioner' => $this->recipient->is_public_pentioner,
            'multiple_recipient' => $this->recipient->multiple_recipient,
            'note' => $this->recipient->note
        ]);
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
    public function 受給者の基本情報を更新する()
    {
        $response = $this->actingAs($this->user)
            ->put('/recipients/1', [
                'number' => 24543001,
                'name' => '島原　一子',
                'kana' => 'しまばら　かずこ',
                'sex' => 2,
                'birth_date' => '1990/09/01',
                'adress' => '児童市4001番地1',
                'allowance_type' => 1,
                'is_submitted' => false,
                'additional_document' => '養育費申告書、別居監護申立書',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ]);

        $response->assertRedirect('/recipients/1');
        $this->assertDatabaseHas('recipients', [
            'is_submitted' => false,
            'additional_document' => '養育費申告書、別居監護申立書',
        ]);
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
}
