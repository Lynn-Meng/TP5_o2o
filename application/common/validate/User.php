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
        'userName' => 'require',
        'email' => 'require|email',
        'password' => 'require'
    ];
    protected $message = [
        'userName.require' => '用户名不能为空',
        'email.require' => '邮箱不能为空',
        'email.email' => '邮箱的格式不正确',
        'password' => '密码不能为空',
    ];
    protected $scene = [
        'add' => [
            'userName','email','password'
        ]
    ];
}