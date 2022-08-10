<?php

namespace App\Enums;

enum MultipleRecipient: int
{
    case Normal_recipient = 1;
    case Special_recipient = 2;
    case Dual_recipient = 3;

    public function type(): string
    {
        return match($this)
        {
            self::Normal_recipient => '児童扶養手当受給',
            self::Special_recipient => '特別児童扶養手当受給',
            self::Dual_recipient => '両方の手当を受給'
        };
    }
}