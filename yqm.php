<?php
include('confing/common.php');

// 获取当前日期
$currentDate = date("Y-m-d");

// 重置所有用户的 daily_invites 字段为零
$DB->query("UPDATE qingka_wangke_user SET daily_invites = 0");

// 记录重置操作的日志
$logMessage = "Reset daily_invites for all users on {$currentDate}";
// 可以将$logMessage记录到日志文件中，或者发送给管理员

echo "Daily invites reset successfully.";
?>
