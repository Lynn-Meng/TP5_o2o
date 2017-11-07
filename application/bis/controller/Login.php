<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/13
 * Time: 下午2:50
 */

namespace app\bis\controller;
use think\Controller;
use think\Session;

class Login extends Controller
{
    public function index()
    {
        //判断Session:
        if(session('loginUser','','bis'))
        {
            //直接跳转到index
            $this->redirect('bis/index/index');
        }
        //判断请求来自form，post请求
        if (request()->isPost())
        {
            $data = input('post.');
            //数据校验
            $validate = validate('BisAccount');
            $res = $validate->scene('login')->check($data);
            if (!$res)
            {
                $this->error($validate->getError());
            }
            //根据用户名获取信息
            $res = model('BisAccount')->get(['username' => $data['username']]);
            if (!$res)
            {
                $this->error('该用户不存在,或未知错误');
            }
            else
            {
                //匹配密码
                if ($res->password != md5($data['password'].$res->code))
                {
                    $this->error('登录失败');
                }
                else
                {
                    //存入密码
                    session('loginUser',$res,'bis');
                    $this->success('登录成功',url('bis/index/index'));
                }
            }
        }
        else
        {

        }
        return $this->fetch();
    }
    public function logout()
    {
        //session置空
        Session::delete('loginUser','bis');
        $this->redirect('bis/login/index');
    }

}