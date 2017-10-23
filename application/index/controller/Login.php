<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/23
 * Time: 下午4:13
 */
namespace app\index\controller;

use think\Controller;

class Login extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}