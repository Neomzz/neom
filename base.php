<script
	  src="https://code.jquery.com/jquery-1.12.4.min.js"
	  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
	  crossorigin="anonymous"></script>
<table width="80%">
 <tr>
  <td>
	<a href="./">
	   <img align = "left" src="img/back.png" alt="Назад" border="0">Назад
	</a>
  </td>
 </tr>
</table>
<form action="move.php" method="POST">
  <table width="80%" border="1" cellpadding="8" cellspacing="0">
	<tr>
		<td>Выберите новую дату:</td>
		<td><select id="new-date" name="new-date"></select></td>
	</tr>
	<tr>
		<td>Выберите новое время:</td>
		<td><select id="new-time" name="new-time"></select></td>
	</tr>
  </table>
  <script type="text/javascript">
	var times = [];
<?
	$startTime = time() - (86400 * 20);
	$endTime = time() + (86400 * 20);
	for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
		$thisDateDisplay = date( 'd.m.Y', $i );
		$thisDate = date( 'Y-m-d', $i );
		$array = array(
			0 => 0,
			1 => 0,
		);
		$times = mysql_query("
			select time, count(*) as cnt
			from ".$_SESSION["fizika"]."
			where date='".$thisDate."' and saved=1
			group by time;");
		while ($time = mysql_fetch_assoc($times)){
			$array[intval($time["time"])] = $time["cnt"];
		}
?>
		$('#new-date').append('<option value="<?=$thisDate?>" <?=($i === time() ? 'selected' : '')?>><?=$thisDateDisplay?></option>');
		times['<?=$thisDate?>'] = [
<?
		$firstValue = true;
		for ( $j = 0; $j <= 1; $j = $j + 1 ) {
			if ($array[$j] < 5) {
				if (!$firstValue) { ?>,<? }
				$firstValue = false;
				?>[<?=$j?>, "<?=($j === 0 ? 'До обеда' : 'После обеда')?>"]<?
			}
		}
?>
		];
<?
	}
?>
	function sync() {
		$('#new-time').empty();
		times[$('#new-date').val()].forEach(function (el) {
			$('#new-time').append('<option value="' + el[0] + '">' + el[1] + '</option>');
		});
	}
	$('#new-date').change(sync);
	sync();
  </script>
  <table width="80%" border="0">
    <tr>
	  <td align = "left">
		<input type="reset" value="Отмена ввода">
	  </td>
	  <td align = "right">
		<input type="submit"  value="Сохранить данные">
	  </td> 
	</tr>
  </table>
  <input type="hidden" name="main" value="<?=$_GET['main']?>"> 
</form>

