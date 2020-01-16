<?php

declare(strict_types=1);

namespace Payme\CommissionTask\Service;

class CommissionFees
{
    private $minimumCashOutLegalPersons = 0.50;
    private $maxCashIn = 5.00;
    private $defaultCurrency = 'EUR';
    private $forex = [
        'USD' => 1.1497,
        'JPY' => 129.53,
    ];
    private $commissionFeesPercentage = [
        'cash_in' => 0.03,
        'cash_out' => 0.30,
    ];

    public function calculateCommissionFeesByOperation($operation, $amount)
    {
        return $amount * floatval($this->commissionFeesPercentage[$operation]) / 100;
    }

    public function checkCashOutCondition($type, $amount)
    {
        if ($type === 'legal' && $amount < $this->minimumCashOutLegalPersons) {
            $amount = $this->minimumCashOutLegalPersons;
        }

        return $amount;
    }

    public function checkCashInCondition($currency, $amount)
    {
        return ($amount > $this->maxCashIn) ? $this->maxCashIn : $amount;
    }

    public function convertToEUR($currency, $amount)
    {
        return $amount / $this->forex[$currency];
    }

    public function convertToNonEUR($currency, $amount)
    {
        return $amount * $this->forex[$currency];
    }

    public function roundAmount($amount)
    {
        return number_format(ceil(round($amount, 3) * 100) / 100, 2, '.', '');
    }

    public function collectCommissionFees($date, $id, $type, $operation, $amount, $currency)
    {
        // Convert if currency is not EUR.
        if ($currency !== 'EUR') {
            $amount = $this->convertToEUR($currency, $amount);
        }

        // Calculate the commission fees by operation.
        $amount = $this->calculateCommissionFeesByOperation($operation, $amount);
        switch ($operation) {
            case 'cash_in':
                $amount = $this->checkCashInCondition($currency, $amount);
                break;
            case 'cash_out':
                $amount = $this->checkCashOutCondition($type, $amount);
                break;
        }

        // Convert back to original if currency is not EUR.
        if ($currency !== 'EUR') {
            $amount = $this->convertToNonEUR($currency, $amount);
        }

        return $this->roundAmount($amount);
    }
}
