<?php

namespace Tests;

require_once "./vendor/autoload.php";
require_once "../vendor/autoload.php";

use ExcelToArray\ExcelToArray;

class TestCase extends \PHPUnit\Framework\TestCase{
    /**
     * @var ExcelToArray
     */
    protected $excelToArray;

    protected function setUp()
    {
        parent::setUp();
        $this->excelToArray = new ExcelToArray();
    }

    public function testStub(){}
}