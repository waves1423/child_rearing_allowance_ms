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
            'number' => 24543000,
            'name' => '児扶　一子',
            'kana' => 'じふ　かずこ',
            'sex' => 2,
            'birth_date' => '1999/09/09',
            'adress' => '児童市1001-1',
            'allowance_type' => 1,
            'is_submitted' => true,
            'additional_document' => '養育費申告書、一部適用除外届',
            'is_public_pentioner' => false,
            'multiple_recipient' => 1,
            'note' => ''
        ];
    }
}
