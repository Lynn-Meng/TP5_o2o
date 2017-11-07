<?php
namespace app\index\controller;


class Index extends Base
{
    public function index()
    {
        //准备各个推荐位的信息
        $bigArray = array();
        $firstCategories = model('Category')->getAllFirstNormalCategoriedLimit(0,5);
        for ($i = 0; $i < count($firstCategories); $i++)
        {
            //最外面一层数组
            $bigArray[$firstCategories[$i]->id] = array();
            $bigArray[$firstCategories[$i]->id][0] = $firstCategories[$i]->name;

            //根据分类信息查询的团购商品
            $deals = model('Deal')->getNormalDealByCategoryId($firstCategories[$i]->id,10,$this->city->id);


            //二级分类的查询
            $seArray = model('Category')->getAllFirstNormalCategoried($firstCategories[$i]->id);
            for ($j = 0; $j < count($seArray);$j++)
            {
                $bigArray[$firstCategories[$i]->id][1][] = $seArray[$j]->name;
            }

            for ($l = 0; $l < count($deals); $l++)
            {
                if ($deals[$l] !== '')
                {
                    $bigArray[$firstCategories[$i]->id][2][$deals[$l]->id] = $deals[$l];
                }
            }


        }
//        print_r($bigArray);


        //获取首页轮播图推荐位的信息
        $featyredBig = model('Featured')->getAllNormalFeatured(0);
        //获取首页商品列表数据  美食栏目
        $foodData = model('Deal')->getNormalDealByCategoryId(1,10,$this->city->id);
        //查询美食栏目下的四个子分类
        $food_seData = model('Category')->getSeCategoryByParentId(1,4);
        return $this->fetch('',[
            'featuredBig' => $featyredBig,
            'foodData' => $foodData,
            'food_seData' => $food_seData,
            'bigArray' => $bigArray
        ]);
    }
}
