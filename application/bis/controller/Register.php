<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/13
 * Time: 下午2:50
 */

namespace app\bis\controller;
use think\Controller;

class Register extends Controller
{

    public function index()
    {
        $data = input('post.');

        //获取城市信息
        $cities = model('City')->getNormalCitiesByParentId();
        $categories = model('Category')->getAllFirstNormalCategoried();

//            $citiesss = model('City')->getNormalCitiesByParentId($data['parent_id']);


        return $this->fetch(
            '',
            [
                'cities' => $cities,
                'categories' => $categories
//                'citiesss' => $citiesss
            ]
        );
    }
    public function secondCity()
    {
        $data = input('post.');
        $cities = model('City')->getNormalCitiesByParentId($data['parent_id']);
        if (!$cities)
        {
            return $this->result('',0,'失败');
        }
        else
        {
            return $cities;
        }
    }
    public function getcategories()
    {
        $parent_id = input('post.id',0,'intval');
        $res = model('Category')->getAllFirstNormalCategoried($parent_id);
        if (!$res)
        {
            return $this->result('',0,'获取失败');
        }
        else
        {
            return $this->result($res,1,'获取成功');
        }
    }
    //申请按钮触发的方法
    public function regist()
    {
        $data = input('post.');

        //校验商户数据
        $validateAccount = validate('BisAccount');
        //没有的字段不验证
        $res = $validateAccount->scene('add')->check($data);
        if (!$res)
        {
            $this->error($validateAccount->getError());
        }

        //检测该商户是否已经存在

        if (model('BisAccount')->getAccountByUsername($data['username']))
        {
            $this->error('该商户已存在');
        }

        //数据校验
        //创建单独对象
        $validate = validate('Bis');
        //使用对象里面的方法
        $res = $validate->scene('add')->check($data);
        if (!$res)
        {
            $this->error($validate->getError());
        }
        //数据校验BisLocation
        $validateLocation = validate('BisLocation');
        $res2 = $validateLocation->scene('add')->check($data);
        if (!$res2)
        {
            $this->error($validateLocation->getError());
        }
        //判断地理信息位置是否准确
        $locationResult = \Map::getLnglat($data['address']);
        //$locationResult['result']['precise'] = 0 时    为不精准   ==1时   精准定位
        if (!$locationResult || $locationResult['result']['precise'] == 0)
        {
            $this->error('地理信息位置不精确，请重新填写');
        }
        //准备提交数据
        $bisData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'logo' => $data['logo'],
            'licence_logo' => $data['licence_logo'],
            'description' => $data['description'],
            'city_id' => $data['city_id'],
            'city_path' => $data['city_id'].','.$data['se_city_id'],
            'bank_info' => $data['bank_info'],
            'bank_name' => $data['bank_name'],
            'bank_user' => $data['bank_user'],
            'faren' => $data['faren'],
            'faren_tel' => $data['faren_tel'],
        ];
        //提交
        $bisId = model('Bis')->add($bisData);

        //准备分类信息 提供给category_path字段使用
        $array = $data['se_category_id'];
        if ($array)
        {
            $se_categories_string = implode('|',$array);
        }



        $locationData = [
            'name' => $data['name'],
            'logo' => $data['logo'],
            'address' => $data['address'],
            'tel' => $data['tel'],
            'contact' => $data['contact'],
            'xpoint' => empty($locationResult['result']['location']['lng']) ? '' : $locationResult['result']['location']['lng'],
            'ypoint' => empty($locationResult['result']['location']['lat']) ? '' : $locationResult['result']['location']['lat'],
            'bis_id' => $bisId,
            'open_time' => $data['open_time'],
            'content' => $data['content'],
            'is_main' => 1,
            'api_address' => $data['address'],
            'city_id' => $data['city_id'],
            'city_path' => $data['city_id'] .','.$data['se_city_id'],
            'category_id' => $data['category_id'],
            'category_path' => $data['category_id'].','. $se_categories_string,
            'bank_info' => $data['bank_info'],
        ];

        $res = model('BisLocation')->add($locationData);



        //随机生成Code ： 四位整数 mt_rand随机生成
        $data['code'] = mt_rand(1000,10000);
        //准备商户信息
        $accountData = [
            'username' => $data['username'],
            'password' => md5($data['password'].$data['code']),
            'code' => $data['code'],
            'bis_id' => $bisId,
            'is_main' => 1,
        ];
        //商户信息存入

        $res = model('BisAccount')->add($accountData);
        if (!$res)
        {
            $this->error('申请失败');
        }
        else
        {
            $this->success('申请加入审核队列');
        }




    }
}