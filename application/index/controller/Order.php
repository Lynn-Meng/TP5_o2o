<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/30
 * Time: 上午10:13
 */
namespace app\index\controller;
class Order extends Base
{
    public function index()
    {
        $id = input('id',0,'intval');
        $deal = model('Deal')->get($id);

        return $this->fetch('',[
            'title' => '订单确认页',
            'controller' => 'pay',
            'deal' => $deal
        ]);
    }
    //确认订单并去支付
    public function orderconfirm()
    {
        $data = input('post.');
        $id = input('id',0,'intval');
        $deal = model('Deal')->get(intval($data['id']));
        //订单号规则:10位的时间戳+用户id+4位随机数
        //添加订单信息
        $order_data = [
            'trade_id' => time().$this->account->id.mt_rand(1000,10000),
            'user_id' => $this->account->id,
            'deal_id' => $id,
            'description' => $deal->description,
            'last_id' => get_client_ip(),
            'bis_id' => $deal->bis_id,
            'buy_count' => $data['buy_count'],
            'total_price' => $data['total_price'],
        ];
        //存入数据库
        $res =  model('Order')->save($order_data);
        if (!$res)
        {
            $this->error('订单生成失败');
        }
        else
        {
            //前往支付页面 引入支付宝接口...
            //构造支付参数
            $payData = [
                'out_trade_no' => $order_data['trade_id'],
                'subject' => '阿迪烤老鼠',
                'total_amount' => $order_data['total_price']
            ];
            \alipay\Pagepay::pay($payData);
        }

    }
    //return_url 提供给支付宝的用来支付后页面跳转的地址  不能100%保证显示出来
    public function finish()
    {
        if (!empty($_GET))
        {
            $trade_id = $_GET['out_trade_no'];
            //更新状态
            $res = model('Order')->save(['status' => 1],['trade_id' => $trade_id]);
            if (!$res)
            {
                $this->error('订单更新失败');
            }
            else
            {
                $this->success('订单更新成功',url('index/index'),'',1);
            }
        }
    }
    //notify_url 提供给支付宝用来做服务器通知的接口 信息送达率99。99%
//    public function  finish_notify()
//    {
//        if (!empty($_POST))
//        {
//            $res = \alipay\Notify::checkParams();
//        }
//    }
}