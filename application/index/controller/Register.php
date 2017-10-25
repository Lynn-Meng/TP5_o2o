<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/23
 * Time: 下午4:17
 */
namespace app\index\controller;

use phpmailer\Email;
use phpmailer\PHPMailer;
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
            //验证码判断
            if (!captcha_check($data['verifyCode']))
            {
                $this->error('验证码不正确');
            }


            if ($data['password'] !== $data['password2'])
            {
                $this->error('两次输入的密码必须一致');
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
                $res = model('User')->add($conData);
                if ($res)
                {
                    //发送邮件：
                    $to = $data['email'];
                    $title = 'o2o平台账号激活';
                    $content = "感谢你在俺们网站注册,请点击以下链接激活账号:<br><a href='http://o2o.local/index.php/index/register/waiting?id=".$res."' target='_blank'>点击此链接激活</a>";
                    \phpmailer\Email::send($to,$title,$content);

                    //准备邮箱地址
                    $emailHost = explode('@',$data['email'])[1];
                    $emailHost = 'http://mail.'.$emailHost;
                    $this->success('注册成功',$emailHost,'',5);
                }
                else
                {
                    $this->error('注册失败');
                }

            }
        }
        else
        {
            return $this->fetch();
        }

    }
    public function checkname()
    {
        if (request()->isPost())
        {
//            print_r(input('post.'));
            $username = input('username');
//            print_r($username);
            $res = model('User')->get(['username'=>$username]);
            if ($res)
            {
                 $this->result('',0,'');
            }
            else
            {
                $this->result('',1,'wwwww');
            }

        }
    }
    public function waiting($id)
    {
        if (empty($id))
        {
            return '';
        }
        //根据id激活某个账号
        model('User')->save(['status' => 1],['id' => $id]);
        return $this->fetch();
    }
    public function randname()
    {
        if (request()->isPost())
        {
            $num = input('number');
            $res = model('Adjective')->get(['id' => $num]);
            if ($res)
            {
                $this->result($res,'1','ssss');
            }
            else
            {
                $this->result('',0,'失败');
            }
        }
    }
}