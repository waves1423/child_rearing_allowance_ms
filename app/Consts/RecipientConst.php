<?php

namespace App\Consts;

class RecipientConst
{
    const SEX_MALE = '1';
    const SEX_FEMALE = '2';

    const SEX_LIST = [
        'male' => self::SEX_MALE,
        'female' => self::SEX_FEMALE
    ];

    const PAYMENT_FULL = '1';
    const PAYMENT_PARTIAL = '2';
    const PAYMENT_SUSPENDED = '3';

    const PAYMENT_LIST = [
        'full' => self::PAYMENT_FULL,
        'partial' => self::PAYMENT_PARTIAL,
        'suspended' => self::PAYMENT_SUSPENDED
    ];
}