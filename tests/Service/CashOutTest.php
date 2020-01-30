<?php

declare(strict_types=1);

namespace Payme\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;
use Payme\CommissionTask\Service\CashOut;

class CashOutTest extends TestCase
{
    private $cashOut;

    public function setUp()
    {
        $this->cashOut = new CashOut();
    }

    /**
     * @dataProvider dataCollections
     */
    public function testCashOut($type, $amount, $minimumCashOutLegalPersons, $expectation)
    {
        $this->assertEquals(
            $expectation,
            $this->cashOut->checkMin($type, $amount, $minimumCashOutLegalPersons)
        );
    }

    public function dataCollections(): array
    {
        return [
            'legal cash out' => ['legal', 0.6, 0.5, 0.6],
            'legal cash out' => ['legal', 0.4, 0.5, 0.5],
            'natural cash out' => ['natural', 0.4, 0.5, 0.45],
            'natural cash out' => ['natural', 3.6, 0.5, 3.60],
        ];
    }
}
