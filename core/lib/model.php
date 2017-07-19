<?php
namespace core\lib;

use Medoo\Medoo;

class model extends \Medoo\Medoo
{
    public function __construct()
    {
        parent::__construct(config::all('database'));
    }
}