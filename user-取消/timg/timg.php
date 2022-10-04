<?php
ini_set ("memory_limit","-1");
error_reporting(0);
require 'phpqrcode.php';
$id = isset($_GET['id'])?intval($_GET['id']):exit();
$url = isset($_GET['url'])?trim($_GET['url']):exit();
if($id!=1)exit();

$backgrounds = array('adv1.jpg');

$imagesx = array(3999);

$imagesy = array(5555);

$imagesize = array(860);


//ͼƬһ
$path_1 = './img/'.$backgrounds[$id-1];


$QRcode = new QRcode();
ob_start();
$QRcode->png($url, false, 'L', 10, 2);
$qrcodedata = ob_get_contents();
ob_end_clean();


$image_1 = imagecreatefromjpeg($path_1);
$image_2 = imagecreatefromstring($qrcodedata);

$qrcodelength = $imagesize[$id-1];
$image_3 = imagecreate($qrcodelength, $qrcodelength);
imagecolorallocate($image_3,255,255,255);
imagecopyresampled($image_3, $image_2, 0, 0, 0, 0, $qrcodelength, $qrcodelength, imagesx($image_2), imagesy($image_2));

imagecopymerge($image_1, $image_3, $imagesx[$id-1], $imagesy[$id-1], 0, 0, $qrcodelength, $qrcodelength, 100);
$seconds_to_cache = 3600*24;
header("Pragma: cache");
header("Cache-Control: max-age=$seconds_to_cache");
header('Content-type: image/png');
header("Content-Disposition: filename=icon.png");
imagepng($image_1);