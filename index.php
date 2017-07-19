<?php
//定义常量
//项目目录
define('VATE', realpath(' /'));
//核心文件
define('CORE',VATE.'core');
define('APP',VATE.'app');
define('MODULE','app');
//配置文件
define('CONFIG',VATE.'config/');
//debug模式
define('DEBUG',true);
//缓存目录
define('RUNTIME',VATE.'runtime/');
define('LOG',RUNTIME.'log/');
define('CACHE',RUNTIME.'cache/');
//设置系统时间
date_default_timezone_set("PRC");
//引用composer
include "vendor/autoload.php";
//错误输出
if(DEBUG){
    $whoops = new \Whoops\Run;
    $errorPage = new \Whoops\Handler\PrettyPageHandler;
    $errorPage->setPageTitle("框架出错");
    $whoops->pushHandler($errorPage);
    $whoops->register();
    ini_set('display_errors','On');
} else {
    ini_set('display_errors','Off');
}
//引入函数库
include VATE.'/common/function.php';
//引入核心文件
include CORE.'/init.php';
//自动加载
spl_autoload_register('\core\init::load');
//启动框架
\core\init::run();


