<?php

declare(strict_types=1);

namespace Payme\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;
use Payme\CommissionTask\Service\InputData;

class InputDataTest extends TestCase
{
    private $file = 'input.csv';
    private $input;

    public function setUp()
    {
        $this->input = new InputData($this->file);
    }

    public function testFileExists()
    {
        $this->assertTrue(
            $this->input->fileExists()
        );
    }

    public function testValidFile()
    {
        $this->assertTrue(
            $this->input->validFile()
        );
    }

    public function testCollectData()
    {
        $this->assertTrue(
            is_array($this->input->CollectData())
        );
    }
}
