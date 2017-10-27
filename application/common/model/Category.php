<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/11
 * Time: 下午4:53
 */
namespace app\common\model;
use think\Model;

class Category extends Model
{

    //自动写入时间戳
    protected $autoWriteTimestamp = true;
    //获取所有以及分类
    public function getFirstNormalCategoried($parent_id = 0)
    {
        //条件
        $data = [
            'status' => ['neq', -1],
            'parent_id' => $parent_id,
        ];
        //排序属性
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->paginate();
    }
    //不带分页的获取一级二级分类的方法
    public function getAllFirstNormalCategoried($parent_id = 0)
    {
        //条件
        $data = [
            'status' => ['neq', -1],
            'parent_id' => $parent_id,
        ];
        //排序属性
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->select();
    }
    public function getAllFirstNormalCategoriedLimit($parent_id = 0,$limit)
    {
        //条件
        $data = [
            'status' => ['neq', -1],
            'parent_id' => $parent_id,
        ];
        //排序属性
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        $result =  $this->where($data)->order($order);
        if ($limit)
        {
            $result->limit($limit);
        }
        return $result->select();
    }
    //根据parent_id数组获取所有二级分类
    public function getSeCatsByParentIds($parent_ids = [])
    {
        $data = [
            'status' => 1  ,
            'parent_id' => ['in',implode(',',$parent_ids)]
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->select();
    }

}