<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/17
 * Time: 下午2:37
 */
namespace app\bis\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}