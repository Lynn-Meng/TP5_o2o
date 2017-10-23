<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/19
 * Time: 下午2:17
 */
namespace app\common\model;

use think\Model;

class Deal extends Model
{
    protected $autoWriteTimestamp = true;
    public function getAllNormalsDeals($bis_id)
    {
        $data = [
            'status' => ['neq',-1],
            'bis_id' => $bis_id
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];


        $res =  $this->where($data)->order($order)->paginate(3);
//        print_r($this->getLastSql());exit();
        return $res;
    }
    public function getDealsByCondition($data = [])
    {
//        $data['status'] = 1;
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->paginate(3);
    }
}