<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function status($status)
{
    if ($status == 1)
    {
        return "<label class='label label-success radius'>正常</label>";
    }
    else if ($status == 0)
    {
        return "<label class='label label-danger radius'>待审</label>";
    }
    else
    {
        return "<label class='label label-danger radius'>删除</label>";
    }
}


//设置分页样式的方法
function pagination($pageObj)
{
    if (!$pageObj)
    {
        return '';
    }
    $result = "<div class='cl pd-5 bg-1 bk-gray mt-20 tp5-o2o'>".$pageObj->render()."</div>";
    return $result;
}