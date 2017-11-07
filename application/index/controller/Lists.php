<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/27
 * Time: 下午2:33
 */
namespace app\index\controller;
use think\Controller;

class Lists extends Base
{
    public function index()
    {
        $categoriesss = model('Category')->getAllFirstNormalCategoried(0);
        //把所有一级分类的id存放到数组中


        //获取前一个页面传过来的id
        $id = input('id','','intval');
        $category = model('Category')->get(['id' => $id]);

        if ($category)
        {
            if ($category->parent_id != 0)
            {
                //二级分类
                //去获取他所在的一级分类Id
                $firId = $category->parent_id;
                $secId = $category->id;
            }
            else
            {
                //一级分类
                //去获取他的二级分类
                $firId = $category->id;
                $secId = '';
            }
        }
        else
        {
            $firId = 0;
            $secId = 0;
        }
        print_r($firId);
        //获取二级分类
        $seeCategories = model('Category')->getAllFirstNormalCategoried( $firId);
        return $this->fetch('',[
            'title' => '😯️'.$this->city->name.'🤔️'.'团购',
            'categoriesss' => $categoriesss,
            'firId' => $firId,
            'secId' => $secId,
            'seeCategories' => $seeCategories,
            'id' => $id
        ]);
    }
}