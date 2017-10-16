<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/16
 * Time: 上午9:12
 */
function show($code,$message,$data)
{
    //改造成json字符串类型  还不是json对象  还不能json.  调用
    return json([
        'code' => $code,
        'message' => $message,
        'data' => $data
    ]);
}