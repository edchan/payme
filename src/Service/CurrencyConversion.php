<?php

declare(strict_types=1);

namespace Payme\CommissionTask\Service;

class CurrencyConversion
{
    public function convert($currency, $amount, $forex, $revert = false)
    {
        return $revert ? $amount / $forex : $amount * $forex;
    }
}
