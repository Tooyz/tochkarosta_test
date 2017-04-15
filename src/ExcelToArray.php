<?php

namespace ExcelToArray;

use PHPExcel_IOFactory;

class ExcelToArray{
    /**
     * @var \PHPExcel_Worksheet
     */
    private $activeSheet;

    /**
     * @param $filePath
     * @param int $sheetIndex
     * @return $this
     * @throws \Exception
     */
    public function read($filePath, $sheetIndex = 0){
        if ( !file_exists($filePath) ){
            throw new \Exception("File " . $filePath . " does not exist");
        }
        $reader = PHPExcel_IOFactory::createReader('Excel2007');
        $excel = $reader->load($filePath);
        $this->activeSheet = $excel->setActiveSheetIndex($sheetIndex);
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(){
        $result = [];
        $highestRow = $this->activeSheet->getHighestDataRow();
        $highestColumn = $this->activeSheet->getHighestDataColumn();
        /*
         * If max row with data is 1 and max column with data is 'A' and the cell is empty
         * it's safe to assume that given sheet is empty
         */
        if ( $highestRow === 1 && $highestColumn === 'A' && $this->activeSheet->getCell('A1')->getValue() == null ) return [];
        foreach ($this->activeSheet->getRowIterator(1, $highestRow) as $row){
            $rowIdx = $row->getRowIndex();
            $result[$rowIdx] = [];
            foreach ( $this->activeSheet->getColumnIterator('A', $highestColumn) as $column ){
                $colIndex = $column->getColumnIndex();
                $result[$rowIdx][$colIndex] = $this->activeSheet->getCell($colIndex . $rowIdx)->getValue();
            }
        }
        return $result;
    }

    /**
     * @return \PHPExcel_Worksheet
     */
    public function getActiveExcelSheet(){
        return $this->activeSheet;
    }
}