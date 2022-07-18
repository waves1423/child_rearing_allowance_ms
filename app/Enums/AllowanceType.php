<?php

namespace App\Enums;

enum AllowanceType: int
{
    case Payment_full = 1;
    case Payment_partial = 2;
    case Payment_suspended = 3;

    public function type(): string
    {
        return match($this)
        {
            self::Payment_full => '全部支給',
            self::Payment_partial => '一部支給',
            self::Payment_suspended => '支給停止',
        };
    }
}