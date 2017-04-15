<?php

namespace Tests;

require_once "cases/TestCase.php";

class ArrayConversionTest extends TestCase{
    public function testFileWithData(){
        $file = "assets/testdoc.xlsx";
        $expected = [
            1 => ["A" => 1, "B" => 2, "C" => 3],
            2 => ["A" => 4, "B" => 5, "C" => 6],
            3 => ["A" => 7, "B" => 8, "C" => 9]
        ];
        $result = $this->excelToArray->read($file)
            ->toArray();
        $this->assertEquals($expected, $result);
    }

    public function testEmptyFile(){
        $file = "assets/testdoc_empty.xlsx";
        $expected = [];
        $result = $this->excelToArray->read($file)
            ->toArray();
        $this->assertEquals($expected, $result);
    }
}