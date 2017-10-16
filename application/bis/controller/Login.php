<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/13
 * Time: 下午2:50
 */

namespace app\bis\controller;
use think\Controller;

class Login extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}