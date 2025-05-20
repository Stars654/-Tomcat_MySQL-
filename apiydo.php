<?php
include ('confing/common.php'); //这俩是自己数据库的连接位置 自己弄好
include ('ayconfig.php');

$benzurl = "https://45.benzamg.top/";
$token = "";//此处是Benz的token 填写即可
$youdj = 0.2;//此处是你平台的顶级费率，如果是0.1就填0.1 如果是0.2就填0.2
$pricetype = 1;//此处是加价的方式，0=直接加价，1=倍率加价
$pricelx = 1.0;//直接输入需要的多少即可，最后的定价，如果pricetype=0那么加价0.1就是在benz原来的价格上+0.1,例如价格是1就是1+0.1=1.1的价格。如果pricetype=1那么加价1.1就是在benz原来的价格上×1.1,例如价格是1就是1×1.1=1.1的价格。