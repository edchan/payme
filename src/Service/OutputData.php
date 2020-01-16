<?php

declare(strict_types=1);

namespace Payme\CommissionTask\Service;

class OutputData
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function output()
    {
        foreach ($this->data as $data) {
            echo $data."\n";
        }
    }
}
