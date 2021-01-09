<?php


namespace Hahadu\ThinkHelper;

use think\App;
use think\Collection;
use think\Paginator;

/*****
 * Class ArrayHelper
 * @package Hahadu\ThinkHelper
 */
class ArrayHelper
{
    /*****
     * 数组分页
     * @param array $array 传入分页的数组
     * @param int|array $listRows 每页数量 数组表示配置参数
     * @param int|bool  $simple   是否简洁模式或者总记录数
     * @return Paginator|App
     */
    static function arrayPaginate($array, $listRows, $simple = false){

        $array = Collection::make($array);
        $total = $array->count();

        if (is_int($simple)) {
            $total  = $simple;
            $simple = false;
        }

        $defaultConfig = [
            'query'     => [], //url额外参数
            'fragment'  => '', //url锚点
            'var_page'  => 'page', //分页变量
            'list_rows' => 15, //每页数量
        ];

        if (is_array($listRows)) {
            $config   = array_merge($defaultConfig, $listRows);
            $listRows = intval($config['list_rows']);
        } else {
            $config   = $defaultConfig;
            $listRows = intval($listRows ?: $config['list_rows']);
        }
        $page = isset($config['page']) ? (int) $config['page'] : Paginator::getCurrentPage($config['var_page']);

        $page = $page < 1 ? 1 : $page;

        $config['path'] = $config['path'] ?? Paginator::getCurrentPath();

        $items = $array->slice(($page-1)*$listRows,$listRows);

        return app('think\Paginator',[
            $items,
            $listRows,
            $page,
            $total,
            $simple,
            $config,
        ],true);
    }


}