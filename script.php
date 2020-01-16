<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Payme\CommissionTask\Service\InputData;
use Payme\CommissionTask\Service\CommissionFees;
use Payme\CommissionTask\Service\OutputData;

$file = $argv[1];
$input = new InputData($file);
$data_collections = $input->collectData();
$commission = new CommissionFees();
foreach($data_collections as $data) {
  list($date, $id, $type, $operation, $amount, $currency) = $data;
  $commission_fees[] = $commission->collectCommissionFees($date, $id, $type, $operation, $amount, $currency);
}
$output = new OutputData($commission_fees);
$output->output();
