<?php
namespace app\controllers;

use core\lib\log;
use core\lib\model;

class IndexController extends \core\init
{
    public function index()
    {
        $data = 'hello world';
        $this->assign('data',$data);
        $this->assign('vate','vate code');
        $this->display('index/index');
    }
}