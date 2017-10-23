<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/19
 * Time: 下午3:45
 */
namespace app\common\validate;

use think\Validate;

class Deal extends Validate
{
    protected $rule = [
        'name' => 'require',
        'city_id' => 'require',
        'image' => 'require',
        'start_time' => 'require',
        'end_time' => 'require',
        'total_count' => 'require|number',
        'origin_price' => 'require|number',
        'current_price' => 'require',
        'coupons_begin_time' => 'require',
        'coupons_end_time' => 'require',
        'description' => 'require',
        'notes' => 'require',
    ];
    protected $message = [
        'name.require' => '用户名不能为空',
        'city_id.require' => '请选择城市',
        'image.require' => '请添加图片',
        'start_time.require' => '请填写开始时间',
        'end_time.require' => '请填写结束时间',
        'total_count.require' => '请填写总量',
        'total_count.number' => '总量信息必须是数字',
        'origin_price.require' => '请填写原价',
        'origin_price.number' => '原价信息必须是数字',
        'current_price.require' => '请填写现价',
        'coupons_begin_time.require' => '请填写优惠券生效时间',
        'coupons_end_time.require' => '请填写优惠券失效时间',
        'description.require' =>'请填写团购描述',
        'notes.require' => '请填写购买须知',
    ];
    protected $scene = [
        'add' => ['name','city_id','image','start_time','end_time','total_count','origin_price','current_price','coupons_begin_time','coupons_end_time','description','notes']
    ];
}