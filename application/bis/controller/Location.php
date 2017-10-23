<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/18
 * Time: 下午4:53
 */
namespace app\bis\controller;


class Location extends Base
{
    private $obj;
    public function _initialize()
    {
        $this->obj = model('BisLocation');
    }

    public function index()
    {
        $bis_id = $this->getLoginUser()->bis_id;
        $res = model('BisLocation')->getMsgById($bis_id);
        return $this->fetch('',
            [
                'locations' => $res
            ]);
    }
    public function add()
    {
        //判断是否post过来数据
        if (request()->isPost())
        {
            //入库操作
            $data = input('post.');

            //数据校验 门店添加
            $validate = validate('Branch');
            $res = $validate->scene('add')->check($data);
            if (!$res)
            {
                $this->error($validate->getError());
            }
            //获取当前用户的bis_id
            $bis_id = $this->getLoginUser()->bis_id;


            $locationResult = \Map::getLnglat($data['address']);
            //$locationResult['result']['precise'] = 0 时    为不精准   ==1时   精准定位
            if (!$locationResult || $locationResult['result']['precise'] == 0)
            {
                $this->error('地理信息位置不精确，请重新填写');
            }
            //准备分类信息 提供给category_path字段使用
            if (!empty($data['se_category_id']))
            {
                $array = $data['se_category_id'];
                $se_categories_string = ','.implode('|',$array);
            }
            else
            {
                $se_categories_string = '';
            }
            $locationData = [
                'name' => $data['name'],
                'logo' => $data['logo'],
                'address' => $data['address'],
                'tel' => $data['tel'],
                'contact' => $data['contact'],
                'xpoint' => empty($locationResult['result']['location']['lng']) ? '' : $locationResult['result']['location']['lng'],
                'ypoint' => empty($locationResult['result']['location']['lat']) ? '' : $locationResult['result']['location']['lat'],
                'bis_id' => $bis_id,
                'open_time' => $data['open_time'],
                'content' => $data['content'],
                'is_main' => 0,
                'api_address' => $data['address'],
                'city_id' => $data['city_id'],
                'city_path' => $data['city_id'] .','.$data['se_city_id'],
                'category_id' => $data['category_id'],
                'category_path' => $data['category_id']. $se_categories_string,
            ];

            $res = model('BisLocation')->add($locationData);
            if (!$res)
            {
                $this->error('门店信息添加失败');
            }
            else
            {
                $this->success('门店信息添加成功');
            }

        }
        else
        {
            $citys = model('City')->getNormalCitiesByParentId();
            $categories = model('Category')->getAllFirstNormalCategoried();
            return $this->fetch('',
                [
                    'Citys' => $citys,
                    'categories' => $categories

                ]);
        }

    }
    public function status()
    {
        $status = input('status',0,'intval');
        $id = input('id',0,'intval');
        $res = model('BisLocation')->save(['status'=>$status],['id'=>$id]);
        if (!$res)
        {
            $this->error('下架失败');
        }
        else
        {
            $this->success('下架成功');
        }
    }
    public function detail()
    {
        $id = input('id',0,'intval');
        //根据id获取bisLocation
        $res = $this->obj->get($id);
        $citys = model('City')->getNormalCitiesByParentId();
        $categories = model('Category')->getAllFirstNormalCategoried();

        //二级城市信息
        $idArray = explode(',',$res['city_path']);
        $city = model('City')->getNormalCitiesByParentId($res['city_id']);
        return $this->fetch('',[
            //这是一个店铺的完整信息  不是一组
            'locationData' => $res,
            'Citys' => $citys,
            'City' => $city,
            'seCityId' => $idArray[1],
            'categories' => $categories
        ]);

    }
}
