<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/20
 * Time: 上午10:52
 */
namespace app\admin\controller;

use think\Controller;

class Deal extends Controller
{
    private $obj ;
    protected function _initialize()
    {
        $this->obj = model('Deal');
    }

    public function index()
    {
        $data = input('post.');
        //判断是否存在条件
        //分类
        $con_data = [];
        if (!empty($data['category_id']))
        {
            $con_data['category_id'] = $data['category_id'];
        }
        //城市
        if (!empty($data['city_id']))
        {
            $con_data['se_city_id'] = $data['city_id'];
        }
        //时间范围
        if (!empty($data['start_time']))
        {
            $con_data['start_time'] = [
                'gt',strtotime($data['start_time'])
            ];
        }
        if (!empty($data['end_time']))
        {
            $con_data['end_time'] = [
                'lt',strtotime($data['end_time'])
            ];
        }
        if (!empty($data['end_time']) && !empty($data['start_time']))
        {
            if ($data['end_time'] <= $data['start_time'])
            {
                $con_data['start_time'] = [
                    'gt',strtotime($data['end_time'])
                ];
                $con_data['end_time'] = [
                    'lt',strtotime($data['start_time'])
                ];
            }
        }

        //名称
        if (!empty($data['name']))
        {
            $con_data['name'] = [
                'like' ,'%'.$data['name'].'%'
            ];
        }
        $con_data['status'] = [
              'in' ,[1]
        ];

            //查询deal信息
        $res = $this->obj->getDealsByCondition($con_data);
        //分类信息  数据准备
        $categories = model('Category')->getAllFirstNormalCategoried();
        //获取所有二级城市
        $cities = model('City')->getAllNotProvinceCities();

        if (empty($data))
        {
            $data = [
                'category_id' => 0,
                'city_id' => '',
                'start_time' => '',
                'end_time' => '',
                'name' => '',
            ];
        }
        return $this->fetch('',[
            'deals' => $res,
            'cities' => $cities,
            'categories' => $categories,
            'data' => $data
        ]);
    }
    public function status()
    {
        $id = input('id',0,'intval');
        $status = input('status',0,'intval');
        //修改状态
        $res = $this->obj->save(['status' => $status],['id' => $id]);
        if (!$res)
        {
            $this->error('状态更新失败');
        }
        else
        {
            $this->success('状态更新成功');
        }
    }

    //商户团购商品审核方法
    public function audit()
    {
        $data = input('post.');
        //判断是否存在条件
        //分类
        $con_data = [];
        if (!empty($data['category_id']))
        {
            $con_data['category_id'] = $data['category_id'];
        }
        //城市
        if (!empty($data['city_id']))
        {
            $con_data['se_city_id'] = $data['city_id'];
        }
        //时间范围
        if (!empty($data['start_time']))
        {
            $con_data['start_time'] = [
                'gt',strtotime($data['start_time'])
            ];
        }
        if (!empty($data['end_time']))
        {
            $con_data['end_time'] = [
                'lt',strtotime($data['end_time'])
            ];
        }
        if (!empty($data['end_time']) && !empty($data['start_time']))
        {
            if ($data['end_time'] <= $data['start_time'])
            {
                $con_data['start_time'] = [
                    'gt',strtotime($data['end_time'])
                ];
                $con_data['end_time'] = [
                    'lt',strtotime($data['start_time'])
                ];
            }
        }

        //名称
        if (!empty($data['name']))
        {
            $con_data['name'] = [
                'like' ,'%'.$data['name'].'%'
            ];
        }

        $con_data['status'] = [
            'in' , [0]
        ];
        //查询deal信息
        $res = $this->obj->getDealsByCondition($con_data);
        //分类信息  数据准备
        $categories = model('Category')->getAllFirstNormalCategoried();
        //获取所有二级城市
        $cities = model('City')->getAllNotProvinceCities();

        if (empty($data))
        {
            $data = [
                'category_id' => 0,
                'city_id' => '',
                'start_time' => '',
                'end_time' => '',
                'name' => '',
            ];
        }
        return $this->fetch('',[
            'deals' => $res,
            'cities' => $cities,
            'categories' => $categories,
            'data' => $data
        ]);
    }

}
