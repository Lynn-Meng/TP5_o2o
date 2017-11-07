<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/13
 * Time: 下午3:29
 */
namespace app\common\model;

use think\Model;

class City extends Model
{
    //获取分类的城市
    public function getNormalCitiesByParentId($parent_id = 0)
    {
        $data = [
            'status' => ['neq', -1],
            'parent_id' => $parent_id
        ];
        $order = [
            'id' => 'asc',
        ];
        return $this->where($data)->order($order)->select();
    }
    public function getOneCitiesByParentId($parent_id = 0)
    {
        $data = [
            'status' => ['neq', -1],
            'parent_id' => $parent_id
        ];
        $order = [
            'id' => 'asc',
        ];
        return $this->where($data)->order($order)->find();
    }

    //获取所有非省份的城市
    public function getAllNotProvinceCities()
    {
        $data = [
            'status' => ['neq',-1],
            'parent_id' => ['gt', 0]
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->select();
    }

}