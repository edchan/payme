<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Payme\CommissionTask\Config\Config;
use Payme\CommissionTask\Service\InputData;
use Payme\CommissionTask\Service\CurrencyConversion;
use Payme\CommissionTask\Service\CommissionFeesByOperation;
use Payme\CommissionTask\Service\CashIn;
use Payme\CommissionTask\Service\CashOut;
use Payme\CommissionTask\Service\RoundAmount;
use Payme\CommissionTask\Service\OutputData;

$config = new Config();
$config_data = $config->load('config/config.php');
$default_currency = $config_data['forex']['default_currency'];

$file = $argv[1];
$input = new InputData($file);
$data_collections = $input->collectData();

$currency_conversion = new CurrencyConversion();
$commission_fees_by_operation = new CommissionFeesByOperation();

$cash_in = new CashIn();
$cash_out = new CashOut();
$round_amount = new RoundAmount();

foreach ($data_collections as $data) {
    list($date, $id, $type, $operation, $amount, $currency) = $data;

    // Convert if currency is not EUR.
    if ($currency !== $default_currency) {
        $amount = $currency_conversion->convert($currency, $amount, $config_data['forex'][$default_currency][$currency]);
    }

    // Calculate the commission fees by operation.
    $operation_value = $config_data['commission']['commission_fees_percentage'][$operation];
    $amount = $commission_fees_by_operation->calculate($operation_value, $amount);

    // Check cash in / cash out condition.
    switch ($operation) {
        case 'cash_in':
            $amount = $cash_in->checkMax($amount, $config_data['commission']['max_cash_in']);
            break;
        case 'cash_out':
            $amount = $cash_out->checkMin($type, $amount, $config_data['commission']['minimum_cash_out_legal_person']);
            break;
    }

    // Convert back to original if currency is not EUR.
    if ($currency !== $default_currency) {
        $amount = $currency_conversion->convert($currency, $amount, $config_data['forex'][$default_currency][$currency], true);
    }

    // Round the amount.
    $amount = $round_amount->roundAmount($amount);
    $commission_fees[] = $amount;
}

$output = new OutputData($commission_fees);
$output->output();
