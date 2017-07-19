<?php
namespace core\lib;

class config
{
    static public $conf = array();
    static public function get($name,$file='conf')
    {
        if(isset(self::$conf[$file][$name])) {
            return self::$conf[$file][$name];
        } else {
            $conf = CONFIG.$file.'.php';
            if(is_file($conf)) {
                self::$conf[$file] = include $conf;
                return isset(self::$conf[$file][$name])?self::$conf[$file][$name]:false;
            } else {
               throw new \Exception('找不到配置文件'.$file);
            }
        }

    }


    static public function all($file)
    {
        if(isset(self::$conf[$file])) {
            return self::$conf[$file];
        } else {
            $conf = CONFIG.$file.'.php';
            if(is_file($conf)) {
                self::$conf[$file] = include $conf;
                return self::$conf[$file];
            } else {
                return false;
            }
        }

    }

}