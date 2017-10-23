<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/17
 * Time: 下午2:37
 */
namespace app\bis\controller;


class Index extends Base
{
    public function index()
    {
        return $this->fetch();
    }
}