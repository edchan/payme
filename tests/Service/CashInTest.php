<?php

declare(strict_types=1);

namespace Payme\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;
use Payme\CommissionTask\Service\CashIn;

class CashInTest extends TestCase
{
    private $cashIn;

    public function setUp()
    {
        $this->cashIn = new CashIn();
    }

    /**
     * @dataProvider dataCollections
     */
    public function testCashIn($amount, $maxCashIn, $expectation)
    {
        $this->assertEquals(
            $expectation,
            $this->cashIn->checkMax($amount, $maxCashIn)
        );
    }

    public function dataCollections(): array
    {
        return [
            'max cash in' => [3.60, 5.00, 3.60],
            'max cash in' => [5.00, 5.00, 5.00],
            'max cash in' => [10.00, 5.00, 5.00],
        ];
    }
}
