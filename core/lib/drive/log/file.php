<?php
namespace core\lib\drive\log;

use core\lib\config;

class file
{
    public $path;
    function __construct()
    {
        $path = config::get('OPTION','log');
        $this->path = $path['PATH'];
    }

    public function log($message,$file = 'log')
    {
        if(!is_dir($this->path.date('YmdH')))
        {
            mkdir($this->path.date('YmdH'),'0777',true);
        }
        file_put_contents($this->path.date('YmdH').'/'.$file.'.php',date('Y-m-d H:i:s').json_encode($message).PHP_EOL,FILE_APPEND);
    }
}