<?php
/**
 *  +----------------------------------------------------------------------
 *  | Created by  hahadu (a low phper and coolephp)
 *  +----------------------------------------------------------------------
 *  | Copyright (c) 2020. [hahadu] All rights reserved.
 *  +----------------------------------------------------------------------
 *  | SiteUrl: https://github.com/hahadu/think-helper
 *  +----------------------------------------------------------------------
 *  | Author: hahadu <582167246@qq.com>
 *  +----------------------------------------------------------------------
 *  | Date: 2020/11/9 上午11:11
 *  +----------------------------------------------------------------------
 *  | Description:   think-helper
 *  +----------------------------------------------------------------------
 **/

namespace Hahadu\ThinkHelper;


use think\facade\Filesystem;
use think\File;

class Files
{
    /****
     * 获取base64提交的文件信息， 方便文件上传方法处理
     * @param string $base64Data base64文件数据
     * @param string $format 缓存的文件格式
     * @return File
     */
    static public function base64_file_info($base64Data,$format='png'){
        $img = base64_decode($base64Data);
        $cache_name = time().rand_number().'.'.$format;

        $cache_path = Filesystem::path($cache_name);
        file_put_contents($cache_path,$img);
        return self::get_file_info($cache_path);
    }

    /****
     * 获取文件信息
     * @param string $filename 文件名
     * @return File
     */
    static public function get_file_info($filename){
        return new File($filename);
    }

}