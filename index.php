<?php
session_start();
include 'identification.php';
include 'session.php';
$date = $_SESSION['date'];
$show = (empty($_GET['show'])) ? '0' : $_GET['show'];
$date_array=explode("-", $date);
$months = array("1"=>"������","2"=>"�������","3"=>"�����","4"=>"������","5"=>"���", "6"=>"����", "7"=>"����","8"=>"�������","9"=>"��������","10"=>"�������","11"=>"������","12"=>"�������");// ������ ������� ��� ������ � "�������"

echo "<br>";


if ($access<>2){
  include 'head.php';
  include 'body.php';
  include 'end.php';
}
?>