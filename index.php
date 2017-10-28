<?php
/**
 * @copyright 	Copyright (c) 2014-2014 renrenbang.com All rights reserved.
 * @license 	http://www.renrenbang.com/helpcms/4.html 
 * @link        http://www.renrenbang.com
 * @author 		gosea <gosea199@gmail.com> 
 */  
//大厦大厦
define('APP_DEBUG',true);//是否调试
define('APP_NAME', "App");//项目名称
define('APP_PATH', "./App/");//项目路径
define('THINK_PATH', "./Include/");

/**/
//判断是否安装
if(!file_exists(APP_PATH.'Conf/config.db.php'))
{
    header('Location:Install/index.php');
    exit();
}

require THINK_PATH.'ThinkPHP.php';//加载ThinkPHP框架


?>