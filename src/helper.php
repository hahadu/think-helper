<?php
/**
 * 返回用户id
 * @return integer 用户id
 */
if(!function_exists('get_uid')){
    function get_uid(){
        return \think\facade\Session::get('user.id');
    }
}
/**
 * 检测是否登录
 * @return boolean 是否登录
 */
if(!function_exists('check_login')){
    function check_login(){
        if (!empty(get_uid())){
            return true;
        }else{
            return false;
        }
    }
}
/**
 * 返回用户登录信息
 * @return integer 用户id
 */
if(!function_exists('get_user')){
    function get_user($filed=''){
        if(null==$filed){
            return \think\facade\Session::get('user');
        }else{
            return \think\facade\Session::get('user.'.$filed);
        }
    }
}

/****
 * 判断是否为POST提交
 */
if(!function_exists('is_post')){
    function is_post(){
        return \think\facade\Request::isPost();
    }
}

if(!function_exists('send_email')){
    /**
     * 发送邮件
     * @param  string $address 接收邮件的邮箱地址 发送给多个地址需要写成数组形式
     * @param  string $subject 标题
     * @param  string $content 内容
     * @param  array  $smtp    smtp配置
     * @return boolean|mixed   是否成功
     */

    function send_email($address,$subject,$content,$smtp)
    {
        return \Hahadu\ThinkHelper\PhpMailHelper::send_email($address,$subject,$content,$smtp);
    }
}
