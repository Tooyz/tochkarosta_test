<?php

namespace Tests;

require_once "cases/TestCase.php";

class FileReadTest extends TestCase{
    public function testLocalFileRead(){
        $file = "assets/testdoc.xlsx";
        $notAFile = "assets/nofile.xlsx";

        $this->excelToArray->read($file);
        $this->assertNotNull($this->excelToArray->getActiveExcelSheet());

        $this->expectException('\Exception');
        $this->excelToArray->read($notAFile);
    }
}