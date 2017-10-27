<?php
namespace app\index\controller;


class Index extends Base
{
    public function index()
    {
        //获取首页轮播图推荐位的信息
        $featyredBig = model('Featured')->getAllNormalFeatured(0);
        return $this->fetch('',[
            'featuredBig' => $featyredBig
        ]);
    }
}
