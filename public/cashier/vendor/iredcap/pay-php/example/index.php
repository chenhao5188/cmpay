<?php/** *  +---------------------------------------------------------------------- *  | 草帽支付系统 [ WE CAN DO IT JUST THINK ] *  +---------------------------------------------------------------------- *  | Copyright (c) 2018 http://www.iredcap.cn All rights reserved. *  +---------------------------------------------------------------------- *  | Licensed ( https://www.apache.org/licenses/LICENSE-2.0 ) *  +---------------------------------------------------------------------- *  | Author: Brian Waring <BrianWaring98@gmail.com> *  +---------------------------------------------------------------------- */include_once 'config.php';include_once 'Pay.php';$data = [    "order_no" => date('Ydmhis').rand(),    "body" =>'支付测试',    "sum" => '0.1',    "type" => 'wx.scan'];try{    $pay = new \IredCap\Pay\Tests\Pay($config);    $result = $pay->pay($data);  // ->pay(); ->callback();}catch (\Exception $e){   \IredCap\Pay\Util\LogUtil::ERROR($e->getMessage());}if($result['result_code'] == 'OK' && $result['result_msg'] == 'SUCCESS'){    //生成二维码    $url = 'https://www.kuaizhan.com/common/encode-png?large=true&data=' . $result['charge']['credential']['order_qr'];    echo "<img src='{$url}' style='width:300px;'><br>";    echo '二维码内容：' . $result['charge']['credential']['order_qr'];}else{    echo $result['error_msg'];}