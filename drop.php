<?php
$result=mysql_query("SELECT * FROM  main WHERE id=".$_GET['main'].";");
  	while ($row = mysql_fetch_assoc($result)){
  	  $main_id=$row["id"];
  	  $client_id=$row["client"];
  	  $zamer_id=$row["zamer"];
  	  $export_id=$row["export"];
  	  $dostavka_id=$row["dostavka"];
  	  $montaj_id=$row["montaj"];
  	  $otkoses_id=$row["otkoses"];
};

mysql_query("DELETE FROM main WHERE id = ".$main_id.";");
mysql_query("DELETE FROM clients WHERE id = ".$client_id.";");
mysql_query("DELETE FROM zamer WHERE id = ".$zamer_id.";");
mysql_query("DELETE FROM export WHERE id = ".$export_id.";");
mysql_query("DELETE FROM dostavka WHERE id = ".$dostavka_id.";");
mysql_query("DELETE FROM montaj WHERE id = ".$montaj_id.";");
mysql_query("DELETE FROM otkoses WHERE id = ".$otkoses_id.";");


header("Location: ./");
?>