<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/23
 * Time: 下午7:23
 */
namespace app\common\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'userName' => 'require|max:30',
        'email' => 'require|email',
        'password' => 'require',
        'verifyCode' => 'require',
    ];
    protected $message = [
        'userName.require' => '用户名不能为空',
        'userName.max' => '用户名长度不能超过30',
        'email.require' => '邮箱不能为空',
        'email.email' => '邮箱的格式不正确',
        'password.require' => '密码不能为空',
        'verifyCode.require' => '验证码不能为空',
    ];
    protected $scene = [
        'add' => [
            'userName','email','password'
        ]
    ];
}