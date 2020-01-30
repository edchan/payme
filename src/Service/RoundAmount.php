<?php

declare(strict_types=1);

namespace Payme\CommissionTask\Service;

class RoundAmount
{
    public function roundAmount($amount)
    {
        return number_format(ceil(round($amount, 3) * 100) / 100, 2, '.', '');
    }
}
