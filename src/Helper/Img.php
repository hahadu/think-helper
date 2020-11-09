<?php
/**
 *  +----------------------------------------------------------------------
 *  | Created by  hahadu (a low phper and coolephp)
 *  +----------------------------------------------------------------------
 *  | Copyright (c) 2020. [hahadu] All rights reserved.
 *  +----------------------------------------------------------------------
 *  | SiteUrl: https://github.com/hahadu/wechat
 *  +----------------------------------------------------------------------
 *  | Author: hahadu <582167246@qq.com>
 *  +----------------------------------------------------------------------
 *  | Date: 2020/11/7 上午9:44
 *  +----------------------------------------------------------------------
 *  | Description:   Helper
 *  +----------------------------------------------------------------------
 **/

namespace Hahadu\ThinkHelper;
use Hahadu\ImageFactory\Config\Config;
use Hahadu\ImageFactory\Kernel\Factory;

class Img
{
    static public function add_water($image){
        $type = config('water.add_water_type');

        $config = new Config();
        $config->savePath = config('water.add_water_config.save_path');
        $config->waterMarkText = config('water.add_water_config.water_mark_text'); //设置水印文字，支持\n换行符
        $config->TextStyle = config('water.add_water_config.text_style');
        $x = config('water.add_water_config.water_x');
        $y = config('water.add_water_config.water_y');
        if($type==1){
            Factory::setOptions($config);
            $image = Factory::text_to_image()->text_water_mark($image,$x,$y);
        }
        if($type==2){
            $config->waterMarkImage=config('water.add_water_config.water_mark_image'); //设置水印logo
            Factory::setOptions($config);

            $image_option=config('water.add_water_config.image_option');

            $image = Factory::image_to_image()->image_water_mark($image,$x,$y,$image_option);
        }
        return $image;

    }

}