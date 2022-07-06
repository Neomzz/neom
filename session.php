<?php

if (!isset($_SESSION['id'])) {
  $result = mysql_query("SELECT * FROM `works` order by `priority` LIMIT 1;");
  while ($row = mysql_fetch_assoc($result)) {
      $_SESSION['id'] = $row["id"];
      $_SESSION['Logic'] = $row["logic"];
      $_SESSION['LogicAdd'] = $row["LogicAdd"];
      $_SESSION['fizika'] = $row["fizika"];
      $_SESSION['ShowCalend'] = $row["ShowCalend"];
      $_SESSION['NextID'] = '';
  }
}

if (isset($_GET['id'])) {
  $result = mysql_query("SELECT * FROM `works` WHERE `id`=".$_GET['id']." order by `priority` LIMIT 1;");
  while ($row = mysql_fetch_assoc($result)) {
      $_SESSION['id'] = $row["id"];
      $_SESSION['Logic'] = $row["logic"];
      $_SESSION['LogicAdd'] = $row["LogicAdd"];
      $_SESSION['fizika'] = $row["fizika"];
      $_SESSION['ShowCalend'] = $row["ShowCalend"];
  }
  if (isset($_GET["next"])){
    header("Location: ./add.php?main=".$_GET["main"]);
  }else{
    header("Location: ./");
  }
}

if (isset($_GET["next"]) and !isset($_GET['id'])) {
  $old_work = $_SESSION['fizika'];
  $result = mysql_query("SELECT * FROM `works` WHERE `id`=". $_SESSION["NextID"]." order by `priority` LIMIT 1;");
  while ($row = mysql_fetch_assoc($result)) {
      $_SESSION['id'] = $row["id"];
      $_SESSION['Logic'] = $row["logic"];
      $_SESSION['LogicAdd'] = $row["LogicAdd"];
      $_SESSION['fizika'] = $row["fizika"];
      $_SESSION['ShowCalend'] = $row["ShowCalend"];
  }
  if (($old_work == 'zamer' && $_SESSION['fizika']!='offer') || ($old_work == 'zamer' && $_SESSION['fizika']!='order')){
    header("Location: ./select.php?main=".$_GET["main"]);
  }else{
    header("Location: ./add.php?main=".$_GET["main"]);
  }
}


  $oga = '';
  $ÑountModul = '';
  $result = mysql_query("SELECT * FROM `works` order by `priority`;");
  while ($row = mysql_fetch_assoc($result)) {
    if ($oga==='1') $_SESSION["NextID"] = $row["id"];
    $oga = ($row["id"]===$_SESSION["id"]) ? '1' : '0';
    $ÑountModul++;
  }
  unset($oga);

if (!isset($_SESSION['date'])) {
      $_SESSION['date'] = date("Y-m-d");
}

if (isset($_GET['date'])) {
  $_SESSION['date'] = $_GET['date'];
  header("Location: ./");
}

?>
