<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/23
 * Time: 下午4:17
 */
namespace app\index\controller;

use think\Controller;
use think\captcha\Captcha;

class Register extends Controller
{
    public function index()
    {
        if (request()->isPost())
        {
            $data = input('post.');
            print_r($data);
            //数据校验
            $validate = validate('User');
            $res = $validate->scene('add')->check($data);
            if (!$res)
            {
                $this->error($validate->getError());
            }
            if ($data['password'] !== $data['password2'])
            {
                $this->error('两次输入的密码必须一致');
            }
            $res = model('User')->getUserByUsername($data['userName']);
            if ($res)
            {
                $this->error('用户名已存在');
            }
            else
            {

                //数据准备

                //密码
                $data['code'] = mt_rand(1000,10000);
                $conData = [
                    'username' => $data['userName'],
                    'password' => md5($data['password'].$data['code']),
                    'code' => $data['code'],
                    'email' => $data['email']
                ];
                //数据插入
                $res = model('User')->save($conData);
                if ($res)
                {
                    $this->success('数据插入成功');
                }
                else
                {
                    $this->error('数据插入失败');
                }

            }
        }
        else
        {
            return $this->fetch();

        }

    }
}