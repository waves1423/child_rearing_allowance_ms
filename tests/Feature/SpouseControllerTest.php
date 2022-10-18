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

        $this->requestData = ([
            'recipient_id' => $this->spouse->recipient_id,
            'name' => $this->spouse->name,
            'family_relationship' => $this->spouse->family_relationship
        ]);
    }
}
