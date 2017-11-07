<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/23
 * Time: 上午10:03
 */
namespace app\admin\controller;

use think\Controller;

class Featured extends Controller
{
    private $obj;
    protected function _initialize()
    {
        $this->obj = model('Featured');
    }
    public function index()
    {
        $types = config('featured.featured_type');

        if (request()->isPost())
        {
            $data = input('post.');
            $type = $data['type'];
            //条件数据判断
            $res = $this->obj->getFeaturedByType($data['type']);
        }
        else
        {
            $res = $this->obj->getAllFeatured();
            $type = 0;
        }
        return $this->fetch('',[
            'type' => $type,
            'data' => $res,
            'types' => $types
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

    public function add()
    {
        if (request()->isPost())
        {
            $data = input('post.');
            //校验完毕...
            $res = $this->obj->save($data);
            if ($res)
            {
                $this->success('数据添加成功');
            }
            else
            {
                $this->error('数据添加失败');
            }
            //加到数据库
        }
        else
        {
            //获取推荐位
            $types = config('featured.featured_type');
//            $categories = \model('Category')->getAllFirstNormalCategoried();
            return $this->fetch('',[
                'types' => $types
            ]);
        }

    }
}