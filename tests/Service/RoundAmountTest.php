<?php

declare(strict_types=1);

namespace Payme\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;
use Payme\CommissionTask\Service\RoundAmount;

class RoundAmountTest extends TestCase
{
    private $roundAmount;

    public function setUp()
    {
        $this->roundAmount = new RoundAmount();
    }

    /**
     * @dataProvider dataCollections
     */
    public function testRoundAmount($amount, $expectation)
    {
        $this->assertEquals(
            $expectation,
            $this->roundAmount->roundAmount($amount)
        );
    }

    public function dataCollections(): array
    {
        return [
            'round' => [0.1, 0.1],
            'round' => [0.01, 0.01],
            'round' => [0.001, 0.01],
            'round' => [0.0001, 0.00],
            'round' => [1.10, 1.10],
            'round' => [3.06, 3.06],
            'round' => [3.07, 3.07],
            'round' => [0.023, 0.03],
        ];
    }
}
