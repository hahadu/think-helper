<?php

use Hahadu\ThinkHelper\PhpMailHelper;
use Hahadu\ThinkJumpPage\JumpPage;
use Hahadu\ThinkHelper\ImgHelper as Img;
use Hahadu\ThinkHelper\StrHelper as Str;
use think\facade\Request;
use think\facade\Session;
use Hahadu\ThinkHelper\FilesHelper as Files;
use think\File;
use Hahadu\ThinkHelper\ArrayHelper;

if (!function_exists('get_uid')) {
    /**
     * 返回用户id
     * @return integer 用户id
     */
    function get_uid()
    {
        return Session::get('user.id');
    }
}
if (!function_exists('check_login')) {
    /**
     * 检测是否登录
     * @return boolean 是否登录
     */
    function check_login()
    {
        if (!empty(get_uid())) {
            return true;
        } else {
            return false;
        }
    }
}
if (!function_exists('get_user')) {
    /**
     * 返回用户登录信息
     * @return integer 用户id
     */
    function get_user($filed = '')
    {
        if (null == $filed) {
            return Session::get('user');
        } else {
            return Session::get('user.' . $filed);
        }
    }
}

if (!function_exists('is_post')) {
    /****
     * 判断是否为POST提交
     */
    function is_post()
    {
        return Request::isPost();
    }
}
if (!function_exists('is_ajax')) {
    /*****
     * 判断是否ajax提交
     */
    function is_ajax()
    {
        return Request::isAjax();
    }
}
if (!function_exists('is_mobile')) {
    /****
     * 判断是否手机访问
     */
    function is_mobile()
    {

        return Request::isMobile();
    }
}


if (!function_exists('send_email')) {
    /**
     * 发送邮件
     * @param string $address 接收邮件的邮箱地址 发送给多个地址需要写成数组形式
     * @param string $subject 标题
     * @param string $content 内容
     * @param array $smtp smtp配置
     * @return boolean|mixed   是否成功
     */

    function send_email($address, $subject, $content, $smtp)
    {
        return PhpMailHelper::send_email($address, $subject, $content, $smtp);
    }
}
if (!function_exists('cookie_array')) {
    /****
     * 支持数组方式读写cookie
     * @param string $name cookie名称
     * @param string|array $value cookie值
     * @param null $option 参数
     */
    function cookie_array(string $name, $value = '', $option = null)
    {
        if (is_array($value)) {
            $value = json_encode($value);
        }
        $cookie = cookie($name, $value, $option);
        if (!is_null(json_decode($cookie))) {
            return json_decode($cookie, true);
        } else {
            return $cookie;
        }
    }

}
if (!function_exists('strip_html_tags')) {
    /**
     * 删除指定的标签和内容
     * @param array $tags 需要删除的标签数组
     * @param string $str 数据源
     * @param string $content 是否删除标签内的内容 0保留内容 1不保留内容
     * @return string
     */
    function strip_html_tags($tags, $str, $content = 0)
    {
        return Str::strip_html_tags($tags, $str, $content);
    }
}

if (!function_exists('add_water')) {
    /****
     * 添加水印 需要在config。water中配置水印信息
     * @param $image
     * @return string
     */
    function add_water($image)
    {
        return Img::add_water($image);
    }
}
if (!function_exists('base64_file_info')) {
    /****
     * 获取base64提交的文件信息， 方便文件上传方法处理
     * @param string $base64Data base64文件数据
     * @param string $format 缓存的文件格式
     * @return File
     */
    function base64_file_info($base64Data, $format = 'png')
    {
        return Files::base64_file_info($base64Data, $format);
    }
}
if (!function_exists('get_file_info')) {
    /****
     * 获取文件信息
     * @param string $filename 文件名
     * @return File
     */
    function get_file_info($filename)
    {
        return Files::get_file_info($filename);
    }
}
if (!function_exists('create_qrcode')) {
    /****
     * 创建二维码
     * @param string $qr 二维码内容
     * @param int $qr_size 二维码尺寸
     * @param string $path 保存图片路径 不保存则留空
     * @param string $logo_path logo路径，没有则为空
     * @param int $logo_size logo尺寸，设置logo路径后生效，
     * @return mixed|string
     */
    function create_qrcode($qr, $qr_size = 300, $path = '', $logo_path = '', $logo_size = 30)
    {
        return Img::create_qrcode($qr, $qr_size, $path, $logo_path, $logo_size);
    }
}
if (!function_exists('make_array')) {
    /******
     * 实例化数组对象
     * @param array $array
     * @return \think\Collection
     */
    function make_array($array)
    {
        return ArrayHelper::make($array);
    }

}
if (!function_exists('paginate')) {
    /*****
     * 数组分页
     * @param $array
     * @param int|array $listRows 每页数量 数组表示配置参数
     * @param int|bool $simple 是否简洁模式或者总记录数
     * @return Paginator|think\app
     */
    function paginate($array, $listRows, $simple = false)
    {
        return ArrayHelper::paginate($array, $listRows, $simple);
    }
}
