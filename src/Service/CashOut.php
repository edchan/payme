<?php

declare(strict_types=1);

namespace Payme\CommissionTask\Service;

class CashOut
{
    public function checkMin($type, $amount, $minimumCashOutLegalPersons)
    {
        if ($type === 'legal' && $amount < $minimumCashOutLegalPersons) {
            $amount = $minimumCashOutLegalPersons;
        }
        return $amount;
    }
}
