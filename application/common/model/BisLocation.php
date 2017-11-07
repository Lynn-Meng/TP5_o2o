<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/16
 * Time: 下午4:43
 */
namespace app\common\model;

use think\Model;

class BisLocation extends Model
{
    public function add($data)
    {
        $data['status'] = 0;
        $this->save($data);
        //获取添加后的主键id
        return $this->id;
    }
    public function getMsgById($id)
    {
        $data = [
            'bis_id' => $id
        ];
        return $this->where($data)->select();
    }
    public function getAllLocation()
    {
        $data = [

        ];
        return $this->where($data)->paginate(5);
    }

}