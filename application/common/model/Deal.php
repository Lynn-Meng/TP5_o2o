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

    //根据分类ID和数目查询首页的商品数据
    public function getNormalDealByCategoryId($category_id,$limit = 10,$city_id)
    {
        $data = [
            'category_id' => $category_id,
            'status' => 1,
            'se_city_id' => $city_id,
//            'start_time' => ['lt',time()],
            'end_time' => ['gt',time()]
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        $result = $this->where($data)->order($order);
        if ($limit > 0)
        {
            $result = $result->limit($limit);
        }
        return $result->select();
    }
}
