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
//根据category_path处理二级分类信息
//function getCategoryDetailByPath($category_path)
//{
//    if (empty($category_path))
//    {
//        return '';
//    }
//    if (preg_match('/,/',$category_path))
//    {
//        //先按照，号切开字符串
//        $tempArray = explode(',',$category_path);
//        $categoryId = $tempArray[0];
//        $tempSeString = $tempArray[1];
//        //按照|分割数组
//        $temp_se_arr = explode('|',$tempSeString);
//        $allCategories = model('Category')->getAllFirstNormalCategoried(intval($categoryId));
//        //循环组合形成input标签字符串
//        $htmlString = '';
//        for ($i = 0;$i < count($allCategories); $i++)
//        {
//            $current = $allCategories[$i];
//            $htmlString .= "<input type='checkbox' value='".$current['id']."'>";
//            $htmlString .= "<lable>".$current['name']."</lable>";
//        }
//        return $htmlString;
//    }
//    else
//    {
//        $categoryId = intval($category_path);
//        return '';
//    }
//
//}