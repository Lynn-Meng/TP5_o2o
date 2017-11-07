<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/19
 * Time: 下午2:10
 */
namespace app\bis\controller;

class Deal extends Base
{
    private $obj;
    public function _initialize()
    {
        $this->obj = model('Deal');
    }

    public function index()
    {
        $bis_id = $this->getLoginUser()->bis_id;
        $deals = $this->obj->getAllNormalsDeals($bis_id);
        return $this->fetch('',[
            'dealData' => $deals
        ]);
    }
    public function add()
    {
        if (request()->isPost())
        {
            $data = input('post.');
            $bis_id = $this->getLoginUser()->bis_id;
            $validate = validate('Deal');
            $res = $validate->scene('add')->check($data);
            if (!$res)
            {
                $this->error($validate->getError());
            }

            $se_single_categories_string = '';
            if (!empty($data['se_category_id']))
            {
                $array = $data['se_category_id'];
                $se_single_categories_string = implode(',' ,$array);
                $se_categories_string = ','. implode('|',$array);
            }
            else
            {
                $se_categories_string = '';
            }
            //准备勾选了那些分店信息的数据
            $locationIds_string = '';
            if (!empty($data['location_ids']))
            {
                $locationIds_string = implode(',',$data['location_ids']);
            }

            $dealData = [
                'name' => $data['name'],
                'city_id' => $data['city_id'],
                'se_city_id' => $data['se_city_id'],
                'city_path' => $data['city_id'].','.$data['se_city_id'],
                'category_id' => $data['category_id'],
                'se_category_id' => $se_single_categories_string,
                'category_path' => $data['category_id'].$se_categories_string,
                'bis_id' => $bis_id,
                'location_ids' => $locationIds_string,
                'image' => $data['image'],
                'description' => $data['description'],
                'start_time' => strtotime($data['start_time']),
                'end_time' => strtotime($data['end_time']),
                'origin_price' => $data['origin_price'],
                'current_price' => $data['current_price'],
                'total_count' => $data['total_count'],
                'coupons_begin_time' => strtotime($data['coupons_begin_time']),
                'coupons_end_time' => strtotime($data['coupons_end_time']),
                'bis_account_id' => $this->getLoginUser()->id,
                'notes' => $data['notes'],
            ];
            //入库操作
            $res = model('Deal')->save($dealData);
            if (!$res)
            {
                $this->error('添加失败');
            }
            else
            {
                $this->success('添加成功');
            }
        }
        else
        {

            //当前登录用户信息
            $bis_id = $this->getLoginUser()->bis_id;
            $id = input('id',0,'intval');
            //根据id获取bisLocation
            $res = $this->obj->get($id);
            $citys = model('City')->getNormalCitiesByParentId();
            $categories = model('Category')->getAllFirstNormalCategoried();

            //二级城市信息
            $idArray = explode(',',$res['city_path']);
            $city = model('City')->getNormalCitiesByParentId($res['city_id']);

            //获取当前登录的商户所有的店铺信息
            $locations = model('BisLocation')->where(['bis_id' => $bis_id])->select();

            return $this->fetch('',[
                //这是一个店铺的完整信息  不是一组
                'locationData' => $res,
                'Citys' => $citys,
                'City' => $city,
//            'seCityId' => $idArray[1],
                'categories' => $categories,
                'locations' => $locations
            ]);
        }
    }
    public function detail()
    {

        //Look at here  这里是所有信息的准备
        //当前登录用户信息
        $bis_id = $this->getLoginUser()->bis_id;
        $id = input('id',0,'intval');

        //根据id获取bisLocation
        $res = $this->obj->get($id);
        $citys = model('City')->getNormalCitiesByParentId();
        $categories = model('Category')->getAllFirstNormalCategoried();

        //二级城市信息
        $idArray = explode(',',$res['city_path']);
        $city = model('City')->getNormalCitiesByParentId($res['city_id']);

        //获取当前登录的商户所有的店铺信息
        $locations = model('BisLocation')->where(['bis_id' => $bis_id])->select();

        //Look at here   获取信息结束



        return $this->fetch('',[
            //这是一个店铺的完整信息  不是一组
            'dealData' => $res,
            'Citys' => $citys,
            'City' => $city,
            'seCityId' => $idArray[1],
            'categories' => $categories,
            'locations' => $locations
        ]);
    }
}