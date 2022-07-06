<?php
session_start();
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    <meta http-equiv="Expires" content="<?=gmdate("D, d M Y H:i:s", time()+date("Z"))?> +6GMT">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="refresh" content="1;URL=./">
  </head>
<body onLoad="javascript:window.print(); return false">
<?php
  include 'sconnect.php';
  $date_array=explode("-", $_SESSION['date']);
  echo $_SESSION["Logic"]." на ".$date_array[2].".".$date_array[1].".".$date_array[0];
  if (($_SESSION["fizika"] == 'export') or ($_SESSION["fizika"] == 'dostavka') or ($_SESSION["fizika"] == 'montaj') or ($_SESSION["fizika"] == 'otkoses')) {
  	include ".//print//edmo.php";
  }else{
    include ".//print//".$_SESSION["fizika"].".php";
  }
?>
</body>
