<?php
namespace app\index\controller;


class Index extends Base
{
    public function index()
    {
        return $this->fetch('',[
            'user' => session('o2o_user','','m')
        ]);
    }
}
