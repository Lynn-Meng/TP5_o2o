<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/25
 * Time: 上午10:15
 */
namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    //初始化方法
    protected function _initialize()
    {
        //获取城市信息:
        $cities = model('City')->getAllNotProvinceCities();
        $user = session('o2o_user','','m');
        if ($user)
        {
            $this->assign('user',$user);
        }
        else
        {
            $this->assign('user','');
        }
        //tp3
        $this->assign('cities',$cities);
    }
}