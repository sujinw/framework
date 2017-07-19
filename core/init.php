<?php

namespace core;

class init
{
    public static $classMap = array();
    public $assign;
    static public function run()
    {
        //开启日志
        \core\lib\log::init();
        $route = new \core\lib\route();
        $ctrlClass = $route->ctrl;
        $action = $route->action;
        $ctrlFlile = MODULE.'/controllers/'.$ctrlClass.'Controller.php';
        $ctrll = '\\' . MODULE . '\controllers\\' . $ctrlClass . 'Controller';
        if(is_file($ctrlFlile)){
            include $ctrlFlile;
            $ctrl = new  $ctrll;
            $ctrl->$action();
        }else{
            throw new  \Exception('找不到控制器'.$ctrlClass);
        }
    }
    static public function load($class)
    {
        //自动加载类库
        if(isset($classMap[$class])){
            return true;
        }else{
            $class = str_replace('\\','/',$class);
            $file = VATE.$class.'.php';
            if(is_file($file)){
                include $file;
                self:;$classMap[$class] = $class;
            }else{
                return false;
            }
        }
    }

    //模板变量分布
    public function assign($name,$value)
    {
        $this->assign[$name] = $value;
    }
    public function display($file)
    {
        $filepath = APP.'/view/'.$file.'.html';
        if(is_file($filepath)){
            //引入twig模板引擎
            \Twig_Autoloader::register();
            $loader= new \Twig_Loader_Filesystem(APP.'/view');
            $twig= new \Twig_Environment($loader,array(
                    'cache'=> CACHE.'/twig/',
                    'debug'=>DEBUG
                ));
            $template = $twig->loadTemplate($file.'.html');
            $template->display($this->assign ? $this->assign : []);
        }else{
            p("没有".$filepath."这个视图");
        }
    }
}