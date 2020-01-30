<?php

declare(strict_types=1);

namespace Payme\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;
use Payme\CommissionTask\Service\CurrencyConversion;

class CurrencyConversionTest extends TestCase
{
    private $currencyConversion;

    public function setUp()
    {
        $this->currencyConversion = new CurrencyConversion();
    }

    /**
     * @dataProvider dataCollections
     */
    public function testCurrencyConversion($currency, $amount, $forex, $revert, $expectation)
    {
        $this->assertEquals(
            $expectation,
            $this->currencyConversion->convert($currency, $amount, $forex, $revert)
        );
    }

    public function dataCollections(): array
    {
        return [
            'EUR to USD' => ['USD', 1000, 1.1497, true, 869.7921196833958],
            'EUR to JPY' => ['JPY', 1000000, 129.53, true, 7720.21925422682],
            'JPY to EUR' => ['JPY', 7720.21925422682, 129.53, false, 1000000],
            'USD to EUR' => ['USD', 869.7921196833958, 1.1497, false, 1000],
        ];
    }
}
