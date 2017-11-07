<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/27
 * Time: 下午3:27
 */
namespace app\index\controller;
class Detail extends Base
{
    public function index()
    {
        $id = input('id');
        if (!$id)
        {
            $this->error('ID不合法');
        }
        $detail = model('Deal')->get(['id' => $id]);
        return $this->fetch('',[
            'title' => $detail->name,
            'detail' => $detail
        ]);
    }
}