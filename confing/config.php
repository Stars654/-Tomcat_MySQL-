
<?php
define('config_path', dirname(__FILE__).'/');
require_once config_path.'../xm/config.php';
$host = $dbconfig['host']; 
$port = $dbconfig['port']; 
$user = $dbconfig['user']; //数据库名
$pwd = $dbconfig['pwd'];  //密码
$dbname = $dbconfig['dbname'];  //数据库名
$verification="888";//安全二次验证密码
?>
