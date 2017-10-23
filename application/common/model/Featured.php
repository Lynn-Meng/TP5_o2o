<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/23
 * Time: 上午10:46
 */
namespace app\common\model;
use think\Model;

class Featured extends Model
{
    public function getAllFeatured()
    {

        $data = [
            'status' => ['in',[1,0,-1]],
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->paginate(5);
    }
    public function getFeaturedByType($type = 0)
    {
        $data = [
//            'status' => 1,
            'type' => $type,
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->paginate(5);
    }
}