<?
session_start();
include './identification.php';
$result=mysql_query("SELECT * FROM  main WHERE id=".$_GET['main'].";");
while ($row = mysql_fetch_assoc($result)){
	$elem_id=$row[$_SESSION["fizika"]];
}
$sql = "UPDATE `".$_SESSION["fizika"]."` 
  set `finished` = '".str_replace("'", "", $_GET['finished'])."'
  WHERE `id` = ".$elem_id.";";
$result = mysql_query($sql) or die("Query failed : " . mysql_error());
header("Location: ./");
?>