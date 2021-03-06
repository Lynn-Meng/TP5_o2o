<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/16
 * Time: 下午4:43
 */
namespace app\common\model;

use think\Model;

class Bis extends Model
{
    public function add($data)
    {
        $data['status'] = 0;
        $this->save($data);
        //获取添加后的主键id
        return $this->id;
    }
    public function getBisByStatus($status)
    {
        $data = [
            'status' => $status
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->paginate(5);
    }

}