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
    //不带分页的获取一级分类的方法
    public function getAllFirstNormalCategoried()
    {
        //条件
        $data = [
            'status' => ['neq', -1],
            'parent_id' => 0,
        ];
        //排序属性
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->select();
    }

}