<?php

declare(strict_types=1);

namespace Payme\CommissionTask\Service;

class CommissionFeesByOperation
{
    public function calculate($operation, $amount)
    {
        return $amount * floatval($operation) / 100;
    }
}
