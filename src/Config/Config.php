<?php

declare(strict_types=1);

namespace Payme\CommissionTask\Config;

class Config
{
    public function load($file)
    {
        return require $file;
    }
}
