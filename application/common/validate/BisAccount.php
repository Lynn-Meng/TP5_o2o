<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/16
 * Time: 下午3:14
 */
namespace app\common\validate;

use think\Validate;

class BisAccount extends Validate
{
    protected $rule = [
        'username' => 'require',
        'password' => 'require',

    ];
    protected $message = [
        'username.require' => '用户名不能为空',
        'password.require' => '密码不能为空',
    ];
    protected $scene = [
        'add' => ['username','password'],
        'login' => ['username','password'],
    ];
}