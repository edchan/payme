<?php

declare(strict_types=1);

namespace Payme\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;
use Payme\CommissionTask\Service\CommissionFeesByOperation;

class CommissionFeesByOperationTest extends TestCase
{
    private $commissionFeesByOperation;

    public function setUp()
    {
        $this->commissionFeesByOperation = new CommissionFeesByOperation();
    }

    /**
     * @dataProvider dataCollections
     */
    public function testCommissionFeesByOperation($operation, $amount, $expectation)
    {
        $this->assertEquals(
            $expectation,
            $this->commissionFeesByOperation->calculate($operation, $amount)
        );
    }

    public function dataCollections(): array
    {
        return [
            'natural cash out' => [0.3, 1200, 3.6],
            'natural cash in' => [0.03, 200, 0.06],
            'legal cash out' => [0.3, 300, 0.9],
        ];
    }
}
