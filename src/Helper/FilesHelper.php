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

class FilesHelper extends File
{
    private $test = false;
    private $originalName;
    private $mimeType;
    private $error;

    /*****
     * FilesHelper constructor.
     * @param File $fileInfo
     */
    public function __construct($fileInfo){

        $this->originalName = $fileInfo->getFilename();
        $this->mimeType = $fileInfo->getMime();
        $this->error = 0;
        parent::__construct($fileInfo->getPathname(),true);
    }

    /****
     * 获取base64提交的文件信息， 方便文件上传方法处理
     * @param string $base64Data base64文件数据
     * @param string $format 缓存的文件格式
     * @return static
     */
    static public function base64_file_info($base64Data,$format=''){
        $fileData = base64_decode($base64Data);

        if(null!=$format){
            if(mb_strstr($format,'.')){
                $cache_name = time().rand_number().$format;
            }else{
                $cache_name = time().rand_number().'.'.$format;
            }
        }

        $cache_path = Filesystem::path($cache_name);
        file_put_contents($cache_path,$fileData);

        return self::get_file_info($cache_path);
    }

    /****
     * 获取文件信息
     * @param string $filename 文件名
     * @return static
     */
    static public function get_file_info($filename){

        $file_info = new File($filename,0);

        return new static($file_info);
    }
    /**
     * 获取上传文件类型信息
     * @return string
     */
    public function getOriginalMime(): string
    {
        return $this->mimeType;
    }

    /**
     * 上传文件名
     * @return string
     */
    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    /**
     * 获取上传文件扩展名
     * @return string
     */
    public function getOriginalExtension(): string
    {
        return pathinfo($this->originalName, PATHINFO_EXTENSION);
    }

    /**
     * 获取文件扩展名
     * @return string
     */
    public function extension(): string
    {
        return $this->getOriginalExtension();
    }


}