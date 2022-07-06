<?php
session_start();
include 'identification.php';
include 'session.php';
$date = $_SESSION['date'];
$show = (empty($_GET['show'])) ? '0' : $_GET['show'];
$date_array=explode("-", $date);
$months = array("1"=>"Января","2"=>"Февраля","3"=>"Марта","4"=>"Апреля","5"=>"Мая", "6"=>"Июня", "7"=>"Июля","8"=>"Августа","9"=>"Сентября","10"=>"Октября","11"=>"Ноября","12"=>"Декабря");// Массив месяцев для вывода в "Сегодня"

echo "<br>";


if ($access<>2){
  include 'head.php';
  include 'body.php';
  include 'end.php';
}
?>