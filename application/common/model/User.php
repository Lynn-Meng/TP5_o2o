<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/23
 * Time: 下午7:11
 */
namespace app\common\model;
use think\Model;

class User extends Model
{
    public function getUserByUsername($username)
    {
        $data = [
            'username' => $username
        ];
        $res = $this->where($data)->find();
        return $res;
    }
}