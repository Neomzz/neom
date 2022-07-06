<html lang="ru" xmlns="">
<head>
    <meta charset="utf-8">
	</head>
	<body>
<?php
$link = mysqli_connect('name.loc', 'login', 'pass', 'asterisk');
mysqli_query($link,"SET NAMES utf8");
$query="SELECT calldate, clid, src, dst FROM `cdr` WHERE `dst` like '%1234%' or `dst` like '%123456%' order by calldate DESC limit 20";
$result=mysqli_query($link,$query);
?>
<table border=1>
<?php
while ($sql = mysqli_fetch_array($result)) {
$name= iconv('MACCYRILLIC', 'UTF-8', $sql[clid]);
$name = preg_replace('/[^ a-zа-яё\d]/ui', '',$name );
$number = str_replace("123456", "********", $sql[dst]);
$data=substr($sql[calldate],8,8);
	printf ('<tr><td>'.$data.'</td><td>'.$name.'</td><td>'.$sql[src].'</td><td>'.$number.'</td></tr>');
	} 

?>
</table>
</body>
</html>