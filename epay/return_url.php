<?php

@header('Content-Type: text/html; charset=UTF-8');
include("../confing/common.php");
require_once("epay/notify.class.php");
//得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
//查询
if($verify_result) {
	$out_trade_no = $_GET['out_trade_no'];//商户订单号
	$trade_no = $_GET['trade_no'];//支付宝交易号
	$trade_status = $_GET['trade_status'];//交易状态
	$type = $_GET['type'];
	$money=$_GET['money'];//金额;
	$money3=0;
	if ($money<50) {
	    $money3=0;
	}
// 	if ($money>=50) {
// 	    $money3=$money*0.02;
// 	}
// 	if ($money>=100) {
// 	    $money3=$money*0.04;
// 	}
// 	if ($money>=300) {
// 	    $money3=$money*0.06;
// 	}
// 	if ($money>=500) {
// 	    $money3=$money*0.08;
// 	}
// 	if ($money>=1000) {
// 	    $money3=$money*0.08;
// 	}
	$srow=$DB->get_row("SELECT * FROM qingka_wangke_pay WHERE out_trade_no='{$out_trade_no}' limit 1 for update");
	$userrow=$DB->get_row("SELECT * FROM qingka_wangke_user WHERE uid='{$srow['uid']}'");

    $money1= $userrow['money'];
	$money2 = $money1+$money+$money3;
	if ($money3!=0) {
	    $cg="用户[{$userrow['user']}]成功充值".$money."豆；本次赠送".$money3."豆! ";
	}else {
	    $cg="用户[{$userrow['user']}]成功充值".$money."豆! ";
	}
    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
		if($srow['status']==0 && $srow['money']==$money){
			$DB->query("update `qingka_wangke_pay` set `status` ='1',`endtime` ='$date',`trade_no`='{$trade_no}' where `out_trade_no`='{$out_trade_no}'");
            $DB->query("update `qingka_wangke_user` set `money`='{$money2}',`zcz`=zcz+'$money2' where uid='{$userrow['uid']}'");   	
			wlog($userrow['uid'],"在线充值","用户[{$userrow['user']}]在线充值了{$money}豆",$money);
			if ($money3!=0) {
           	    wlog($userrow['uid'],"在线充值","用户[{$userrow['user']}]充值金额达标赠送{$money3}豆",$money3);
           	}
			exit("<script language='javascript'>alert('$cg');window.location.href='../index/pay';</script>");
		}else{
			$DB->query("update `qingka_wangke_pay` set `status` ='1',`endtime` ='$date',`trade_no`='{$trade_no}' where `out_trade_no`='{$out_trade_no}'"); 
           	wlog($userrow['uid'],"在线充值","重复刷新--用户[{$userrow['user']}]在线充值了{$money}豆",$money);
			exit("<script language='javascript'>alert('已充值，请勿重复刷新');window.location.href='../index/pay';</script>");
		}
    }
    else {
      echo "trade_status=".$_GET['trade_status'];
    }
}
 else {
	   exit("<script language='javascript'>alert('充值失败!');window.location.href='../index/index';</script>");
}

?>