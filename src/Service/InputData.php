<?php

declare(strict_types=1);

namespace Payme\CommissionTask\Service;

class InputData
{
    private $file;
    private $validExtension = 'csv';

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function fileExists()
    {
        return file_exists($this->file) ? true : "No file found.\n";
    }

    public function validFile()
    {
        return pathinfo($this->file)['extension'] === $this->validExtension ? true : 'The file is not valid.';
    }

    public function collectData(): array
    {
        return array_map('str_getcsv', file($this->file));
    }
}
/*
$file = $argv[1];

if (file_exists($file)) {
    $file = fopen($file, 'r');
    while(! feof($file)) {
        $results .= fgets($file);
    }
    fclose($file);
    fwrite(STDOUT, $results);
} else {
    fwrite(STDOUT, 'File does not exist.\n');
}
*/
