<?php
session_start();

header('Content-type: image/png');
$image = imagecreatetruecolor(100, 30);
$background_color = imagecolorallocate($image, 220, 220, 220);  // 更亮的背景色
imagefilledrectangle($image, 0, 0, 100, 30, $background_color);

$font_color = imagecolorallocate($image, 0, 0, 0);  // 黑色字体

$letters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';  // 排除一些容易混淆的字符
$len = strlen($letters);
$word = '';

for ($i = 0; $i < 5; $i++) {  // 减少字符数量到5个，以便更容易阅读
    $letter = $letters[rand(0, $len-1)];
    imagestring($image, 5, 5 + ($i * 18), 8, $letter, $font_color);
    $word .= $letter;
}

$_SESSION['captcha'] = $word;
imagepng($image);
imagedestroy($image);
?>