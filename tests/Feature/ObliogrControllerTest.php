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
}
