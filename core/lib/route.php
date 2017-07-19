<?php
namespace core\lib;

class route
{
    public $ctrl;
    public $action;
    public function __construct()
    {
        $path = $_SERVER['REQUEST_URI'];
        if($path && $path !='/'){
            $pathArr = explode('/',trim($path,'/'));
            if(isset($pathArr[0])){
                $this->ctrl = $pathArr[0];
            }
            unset($pathArr[0]);
            if(isset($pathArr[1])){
                $this->action = $pathArr[1];
                unset($pathArr[1]);
            }else{
                $this->action = 'index';
            }
            $count = count($pathArr) + 2;
            $i = 2;
            while ($i < $count){
                if(isset($pathArr[$i + 1])) {
                    $_GET[$pathArr[$i]] = $pathArr[$i + 1];
                }
                $i = $i + 2;
            }
        }else{
            $this->ctrl = 'index';
            $this->action = 'index';
        }
    }
}