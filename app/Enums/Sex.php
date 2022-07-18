<?php

namespace App\Enums;

enum Sex: int
{
    case Male = 1;
    case Female = 2;

    public function type(): string
    {
        return match($this)
        {
            self::Male => '男',
            self::Female => '女',
        };
    }
}