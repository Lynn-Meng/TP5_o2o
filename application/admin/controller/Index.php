<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/11
 * Time: 下午4:00
 */
namespace app\admin\controller;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        // index/index.html
        return $this->fetch();
    }
    public function welcome()
    {
        return '欢迎';
    }
}