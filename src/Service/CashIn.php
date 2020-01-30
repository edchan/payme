<?php

declare(strict_types=1);

namespace Payme\CommissionTask\Service;

class CashIn
{
    public function checkMax($amount, $maxCashIn)
    {
        return ($amount > $maxCashIn) ? $maxCashIn : $amount;
    }
}
