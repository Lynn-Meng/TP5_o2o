<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/25
 * Time: 上午10:15
 */
namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    //初始化方法
    protected function _initialize()
    {
        //获取城市信息:
        $cities = model('City')->getAllNotProvinceCities();
        $user = session('o2o_user','','m');

        //获取所有的分类信息
        $categories = $this->getrecommendCategory();
//        $categories = $this->getCategories();
        $this->assign('categories',$categories);
        //获取head部分应该显示的当前城市
        $city = $this->getCity($cities);
        $this->assign('city',$city);

        if ($user)
        {
            $this->assign('user',$user);
        }
        else
        {
            $this->assign('user','');
        }
        //tp3
        $this->assign('cities',$cities);
    }
    //获取用户在首页点击的城市
    public function getCity($cities)
    {
        $defaultName = '';
        //遍历数组
        foreach ($cities as  $city)
        {
            $city = $city->toArray();
            if ($city['is_default'] == 1)
            {
                $defaultName = $city['uname'];
                break;
            }
        }
        $defaultName = $defaultName ? $defaultName : 'dalian';
        //根据定位获取城市....

        if (!input('city') &&  session('o2o_city','','o2o'))
        {
            $current_city = session('o2o_city','','o2o');

        }
        else
        {
            $cityName = input('city',$defaultName,'trim');
            $current_city =  model('City')->get(['uname'=>$cityName]);
            session('o2o',$current_city,'o2o');
        }

        return $current_city;
    }
    public function getrecommendCategory()
    {
        //存放所有一级分类的id
        $parentIds = [];
        //存放二级分类信息的数组
        $seCatArray = [];
        //存放最终结果的大数组
        $recommendArray = [];
        //只要五个
        $cats = model('Category')->getAllFirstNormalCategoriedLimit(0,5);
        foreach ($cats as $cat)
        {
            $parentIds[] = $cat->id;
        }
        //根据ids获取所有二级分类
        $seCats = model('Category')->getSeCatsByParentIds($parentIds);
        foreach ($seCats as $seCat)
        {
            $seCatArray[$seCat->parent_id][] = [
                'id' => $seCat->id  ,
                'name' => $seCat->name
            ];
        }
        foreach ($cats as $cat)
        {
            $recommendArray[$cat->id] = [$cat->name,empty($seCatArray[$cat->id]) ? [] : $seCatArray[$cat->id]];
        }
        return $recommendArray;
    }

//    public function getCategories()
//    {
//        //准备 分类
//        $categories = array();
//        $firstCate = model('Category')->getAllFirstNormalCategoriedLimit(0,5);
//
//        for ($i = 0; $i < count($firstCate);$i++)
//        {
//            $categories[$firstCate[$i]['id']] = array();
//            $categories[$firstCate[$i]['id']][0] = $firstCate[$i]['name'];
//            $categories[$firstCate[$i]['id']][1] = array();
//            $secondCity = model('Category')->getAllFirstNormalCategoriedLimit($firstCate[$i]['id'],0);
//            for ($j = 0; $j < count($secondCity); $j++)
//            {
//                $categories[$firstCate[$i]['id']][1][$j] = array();
//                $categories[$firstCate[$i]['id']][1][$j]['id'] =$secondCity[$j]['id'];
//                $categories[$firstCate[$i]['id']][1][$j]['name'] = $secondCity[$j]['name'];
//            }
//
//        }
//        print_r($categories);
//        return $categories;
//    }

}