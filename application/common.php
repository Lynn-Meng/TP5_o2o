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


//状态
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

//网络请求的方法: cURL

/**
 * @param $url  请求的url
 * @param int $type   请求方式0是get 1是post
 * @param array $data   请求时的数据（post时使用）
 */
function doCurl($url, $type = 0, $data=[])
{
    //初始化curl
    $ch = curl_init();
    //设置相关参数
    //CURLOPT_URL 请求的url地址
    curl_setopt($ch,CURLOPT_URL,$url);
    //CURLOPT_RETURNTRANSFER  请求结果以文本流形式返回
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    //CURLOPT_HEADER 是否返回http头部信息
    curl_setopt($ch,CURLOPT_HEADER,0);

    //判断请求方式
    if ($type == 1)
    {
        //post请求
        curl_setopt($ch,CURLOPT_PORT,$url);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    }
    //执行curl请求
    $result = curl_exec($ch);
    //关闭curl请求
    curl_close($ch);
    return $result;
}
function bisRegister($status)
{
    if ($status == 1)
    {
        $str = '审核通过';
    }
    else if($status == 0)
    {
        $str = '正在审核中,稍后平台方会向您发送邮件,请关注邮件';
    }
    else if($status == 2)
    {
        $str = '审核未通过,您提交的材料不符合要求,请重新提交';
    }
    else
    {
        $str = '该申请已经被删除';
    }
    return $str;
}

//通过以及分类获取二级分类   并且以input的形式显示在页面上
function getCategoryDetailByPath($category_path)
{
    if (empty($category_path))
    {
        return '';
    }
    if (preg_match('/,/',$category_path))
    {
        //先按照，号切开字符串
        $tempArray = explode(',',$category_path);
        $categoryId = $tempArray[0];
        $tempSeString = $tempArray[1];
        //按照|分割数组
        $temp_se_arr = explode('|',$tempSeString);
        $allCategories = model('Category')->getAllFirstNormalCategoried(intval($categoryId));
        //循环组合形成input标签字符串
        $htmlString = '';

        for ($i = 0;$i < count($allCategories); $i++)
        {
            $current = $allCategories[$i];
            //判断当前current的id是否存在temp_se_arr中
            if (in_array($current['id'],$temp_se_arr))
            {
                $htmlString .= "<input type='checkbox' value='".$current['id']."' checked>";
                $htmlString .= "<lable>".$current['name']."</lable>";
            }
            else
            {
                $htmlString .= "<input type='checkbox' value='".$current['id']."'>";
                $htmlString .= "<lable>".$current['name']."</lable>";
            }

        }
        return $htmlString;
    }
    else
    {
        $categoryId = intval($category_path);
        return '';
    }
}
function isMain($is_main)
{
    if ($is_main == 1)
    {
        return "<lable>是</lable>";
    }
    else
    {
        return "<lable>否</lable>";
    }
}

function getCityNameByCityId($city_id)
{
    if (empty($city_id))
    {
        return '';
    }
    $city = model('City')->get($city_id);
    return $city->name;
}
function getCategoryNameByCategoryId($category_id)
{
    if (empty($category_id))
    {
        return '';
    }
    $category = model('Category')->get($category_id);
    return $category->name;
}

//获取当前客户端的IP
function get_client_ip($type = 0) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if(isset($_SERVER['HTTP_X_REAL_IP'])){//nginx 代理模式下，获取客户端真实IP
        $ip=$_SERVER['HTTP_X_REAL_IP'];
    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {//客户端的ip
        $ip     =   $_SERVER['HTTP_CLIENT_IP'];
    }elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {//浏览当前页面的用户计算机的网关
        $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos    =   array_search('unknown',$arr);
        if(false !== $pos) unset($arr[$pos]);
        $ip     =   trim($arr[0]);
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];//浏览当前页面的用户计算机的ip地址
    }else{
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}