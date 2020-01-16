<?php

declare(strict_types=1);

namespace Payme\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;
use Payme\CommissionTask\Service\CommissionFees;

class CommissionFeesTest extends TestCase
{
    private $commissionFees;

    public function setUp()
    {
        $this->commissionFees = new CommissionFees();
    }

    /**
     * @dataProvider dataCollections
     */
    public function testCollectCommissionFees($date, $id, $type, $operation, $amount, $currency, $expectation)
    {
        $this->assertEquals(
            $expectation,
            $this->commissionFees->collectCommissionFees($date, $id, $type, $operation, $amount, $currency)
        );
    }

    public function dataCollections(): array
    {
        return [
            'natural cash out' => ['2014-12-31', 4, 'natural', 'cash_out', 1200.00, 'EUR', 3.60],
            'natural cash in' => ['2016-01-05', 1, 'natural', 'cash_in', 200.00, 'EUR', 0.06],
            'natural cash in max' => ['2016-01-05', 1, 'natural', 'cash_in', 20000.00, 'EUR', 5.00],
            'natural cash in non-euro max' => ['2016-02-19', 1, 'natural', 'cash_in', 9000000, 'JPY', 647.65],
            'legal cash out' => ['2016-01-06', 2, 'legal', 'cash_out', 300.00, 'EUR', 0.90],
            'legal cash in max' => ['2016-01-10', 2, 'legal', 'cash_in', 1000000.00, 'EUR', 5.00],
            'legal cash out min' => ['2016-01-10', 2, 'legal', 'cash_out', 100.00, 'EUR', 0.50],

        ];
    }
}
