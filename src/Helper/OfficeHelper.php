<?php


namespace Hahadu\ThinkHelper;

use Hahadu\ThinkHelper\Traits\OfficeTraits\ExcelTrait;
use PhpOffice\PhpSpreadsheet\IOFactory;

class OfficeHelper
{
    use ExcelTrait;

    public function __construct(){

    }

    /*****
     * 读取文件
     * @param $inputFileName
     * @return \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    static public function load_files($inputFileName){
        $inputFileType = IOFactory::identify($inputFileName);
        $reader = IOFactory::createReader($inputFileType);
        $reader->setReadDataOnly(true);
        $data = $reader->load($inputFileName);
        return $data->getActiveSheet();
    }



}