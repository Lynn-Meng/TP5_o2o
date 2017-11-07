<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/18
 * Time: 下午3:57
 */
namespace app\bis\controller;

use think\Controller;

class Base extends Controller{

    public $account;

    public function _initialize()
    {
        //检测登录情况
        if(!$this->isLogin()){
            $this->redirect('login/index');
        }
    }

    public function isLogin(){
        $login_user = $this->getLoginUser();
        if(!$login_user){
            return false;
        }
        return true;
    }
    public function getLoginUser(){

        //懒加载
        if(!$this->account) {
            $this->account = session('loginUser', '', 'bis');
        }
        return $this->account;
    }
}