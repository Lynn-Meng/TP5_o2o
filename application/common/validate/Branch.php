<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/16
 * Time: 下午3:14
 */
namespace app\common\validate;

use think\Validate;

class Branch extends Validate
{
    protected $rule = [
        'name' => 'require',
        'city_id' => 'require',
        'logo' => 'require',
        'address' => 'require',
        'tel' => 'require',
        'contact' => 'require',
        'open_time' => 'require',
        'content' => 'require',
        'category_id' => 'require',
    ];
    protected $message = [
        'name.require' => '店铺名称不能为空',
        'city_id.require' => '请选择城市',
        'logo.require' => '请上传图片',
        'address.require' => '请填写地址',
        'tel.require' => '联系人电话不能为空',
        'contact.require' => '联系人姓名不能为空',
        'open_time.require' => '营业时间不能为空',
        'content.require' => '内容不为空',
        'category_id.require' => '请选择分类信息'
    ];
    protected $scene = [
        'add' => ['name','city_id','logo','address','tel','contact','open_time','content','category_id']
    ];
}