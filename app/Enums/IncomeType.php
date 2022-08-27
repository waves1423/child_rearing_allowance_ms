<?php

namespace App\Enums;

enum IncomeType: int
{
    case Salary = 1;
    case Pention = 2;
    case Business = 3;
    case Other = 4;
    case SalaryAndPention = 5;

    public function type(): string
    {
        return match($this)
        {
            self::Salary => '給与所得',
            self::Pention => '年金所得',
            self::Business => '営業所得',
            self::Other => 'その他所得',
            self::SalaryAndPention => '給与所得及び年金所得'
        };
    }
}