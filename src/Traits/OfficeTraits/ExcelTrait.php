<?php
namespace Hahadu\ThinkHelper\Traits\OfficeTraits;
use Adbar\Dot;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

trait ExcelTrait
{
    static protected $spreadsheet;
    static protected $sheet;
    static protected function init(){
        static::$spreadsheet = new Spreadsheet();
    }

    static public function load_excel($filename){

    }

    /*****
     * 创建电子表格
     *
     * 支持的格式xls xlsx csv ods
     * @param array $excel_data 数据
     * @param string $file_name 文件名/路径
     * @param string $format 表格格式
     * @return string [file_path] 文件路径 [message]：状态消息 [code]：状态码，0成功，1失败
     */
    static public function create_excel($excel_data,$file_name,$format="Xlsx"){
        static::init();
        $set = self::sheet_excel($excel_data);
        foreach ($set as $item) {
            $excel_data = $item;
        }
        $check = self::check_excel_format($format);
        if(!$check){
            return ['code'=>0,'message'=>'不支持的表格格式'];
        }

        $writer = self::{parse_name($format,1)}();
        $save_path = $file_name.'.'.$format;
        $writer->save($file_name.'.'.$format);
        return ['code'=>1,'message'=>'创建成功','file_path'=>$save_path];
    }

    /*****
     * @return Xlsx
     */
    private static function Xlsx(){
        return new Xlsx(static::$spreadsheet);
    }
    /*****
     * @return Xls
     */
    private static function Xls(){
        return new Xls(static::$spreadsheet);
    }
    /*****
     * @return Csv
     */
    private static function Csv(){
        return new Csv(static::$spreadsheet);
    }

    /*****
     * 设置excel表格数据
     * @param array $data
     * @return \Generator
     */
    private static function sheet_excel($data){
        $sheet = static::$spreadsheet->getActiveSheet();
        $excel_data = [];
        foreach ($data as $key=>$value){
            $k_num = $key+1;
            $line = [];
            foreach ($value as $k=>$v){
                $line[strtoupper($k).$k_num]= $v;
                $sheet->setCellValue(strtoupper($k).$k_num, $v);
            }
            $excel_data[$key]=$line;
        }
        yield $excel_data;
    }

    /****
     * 检查文件格式
     * @param $format
     * @return bool
     */
    static private function check_excel_format($format){
        $format = parse_name($format);
        $formats = ['xls','xlsx','csv','ods'];
        return in_array($format,$formats);
    }

}