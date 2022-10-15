<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipient>
 */
class RecipientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number' => 24543001,
            'name' => '島原　一子',
            'kana' => 'しまばら　かずこ',
            'sex' => 2,
            'birth_date' => '1990/09/01',
            'adress' => '児童市4001番地1',
            'allowance_type' => 1,
            'is_submitted' => true,
            'additional_document' => '養育費申告書、一部適用除外届',
            'is_public_pentioner' => false,
            'multiple_recipient' => 1,
            'note' => ''
        ];
    }
}
