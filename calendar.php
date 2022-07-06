  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    <meta http-equiv="Expires" content="<?=gmdate("D, d M Y H:i:s", time()+date("Z"))?> +6GMT">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
  </head>

<script language="JavaScript">
// months as they appear in the calendar's title
var ARR_MONTHS = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",
		"Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
// week day titles as they appear on the calendar
var ARR_WEEKDAYS = ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"];
// day week starts from (normally 0-Su or 1-Mo)
var NUM_WEEKSTART = 1;
// path to the directory where calendar images are stored. trailing slash req.
var STR_ICONPATH = './img/';

var re_url = new RegExp('datetime=(\\-?\\d+)');
var dt_current = (re_url.exec(String(window.location))
	? new Date(new Number(RegExp.$1)) : new Date());
var re_id = new RegExp('id=(\\d+)');
var num_id = (re_id.exec(String(window.location))
	? new Number(RegExp.$1) : 0);
var obj_caller = (window.opener ? window.opener.calendars[num_id] : null);

if (obj_caller && obj_caller.year_scroll) {
	// get same date in the previous year
	var dt_prev_year = new Date(dt_current);
	dt_prev_year.setFullYear(dt_prev_year.getFullYear() - 1);
	if (dt_prev_year.getDate() != dt_current.getDate())
		dt_prev_year.setDate(0);

	// get same date in the next year
	var dt_next_year = new Date(dt_current);
	dt_next_year.setFullYear(dt_next_year.getFullYear() + 1);
	if (dt_next_year.getDate() != dt_current.getDate())
		dt_next_year.setDate(0);
}

// get same date in the previous month
var dt_prev_month = new Date(dt_current);
dt_prev_month.setMonth(dt_prev_month.getMonth() - 1);
if (dt_prev_month.getDate() != dt_current.getDate())
	dt_prev_month.setDate(0);

// get same date in the next month
var dt_next_month = new Date(dt_current);
dt_next_month.setMonth(dt_next_month.getMonth() + 1);
if (dt_next_month.getDate() != dt_current.getDate())
	dt_next_month.setDate(0);

// get first day to display in the grid for current month
var dt_firstday = new Date(dt_current);
dt_firstday.setDate(1);
dt_firstday.setDate(1 - (7 + dt_firstday.getDay() - NUM_WEEKSTART) % 7);
function set_datetime(n_datetime, b_close) {
	if (!obj_caller) return;

	var dt_datetime = obj_caller.prs_time(
		(document.cal ? document.cal.time.value : ''),
		new Date(n_datetime)
	);

	if (!dt_datetime) return;
	if (b_close) {
		window.close();
		obj_caller.target.value = (document.cal
			? obj_caller.gen_tsmp(dt_datetime)
			: obj_caller.gen_date(dt_datetime)
		);
	}
	else obj_caller.popup(dt_datetime.valueOf());
}

</script>


<?
  include 'sconnect.php';
  include 'config.php';
  if ($_GET['works']=='montaj') $max_date = $max_mont;
  if ($_GET['works']=='otkoses') $max_date = $max_otcoses;
  $max_date = (empty($max_date)) ? 1000 : $max_date;

  $tmpd = getdate(substr($_GET['datetime'], 0, strlen($_GET['datetime'])-3));
  $nextmon=mktime(0, 0, 0, $tmpd["mon"]+1, 1, $tmpd["year"]);
  $nextmon=$nextmon."000";
  $monthdays=date("t",mktime(0, 0, 0, date($tmpd["mon"]), date($tmpd["mday"]), date($tmpd["year"]))); // Колличество дней в выбраном месяце
  $numberfirstday = date("w",mktime(0, 0, 0, date($tmpd["mon"]), "1", date($tmpd["year"]))); // Вычисляем каким будет первый день месяца по счету в неделе.
  $daysarray=array("","Пн","Вт","Ср","Чт","Пт","Сб","Вс");//Массив дней недели
  $month = array("1"=>"Январь","2"=>"Февраль","3"=>"Март","4"=>"Апрель","5"=>"Май", "6"=>"Июнь", "7"=>"Июль","8"=>"Август","9"=>"Сентябрь","10"=>"Октябрь","11"=>"Ноябрь","12"=>"Декабрь");// Массив месяцев для вывода в заголовке календаря
  if ($tmpd["mon"]==date("n")){
  	for ($i = 1; $i <= date("j"); $i++){
      $arr[$i]="close";
    }
  }
  $result = mysql_query("SELECT date, count(`date`) as date_count, time
    FROM ".$_GET['works']."
    WHERE `date` BETWEEN '".$tmpd["year"]."-".$tmpd["mon"]."-".$tmpd["mday"]."' and '".$tmpd["year"]."-".$tmpd["mon"]."-".$monthdays."'
    GROUP BY date, time
    ORDER BY date, time;");
  $j=0;
  while ($row = mysql_fetch_assoc($result)) {
  	$date=$row["date"];
  	$date_count=$row["date_count"];
  	$time=$row["time"];
  	$j++;
  	if (($date_count==$max_date) and ($time==0)){
      $arr[substr($date, 8)]="to";
    }
  	if (($date_count==$max_date) and ($time==1)){
      $arr[substr($date, 8)]="from";
      if ($olddate==$date) $arr[substr($date, 8)]="close";
    }
    $olddate=$date;
  }
  for ($i = 1; $i <= $monthdays; $i++){
  	if (!isset($arr[$i]))$arr[$i]="free";
  }
?>
<table width="200" border="1" cellspacing="0" cellpadding="0">
  <tr align="center">
    <td colspan="5">
      <?=$month[$tmpd["mon"]]?>
    </td>
    <td colspan="2">
      <a href="<?=$_SERVER["SCRIPT_NAME"]?>?datetime=<?=$nextmon?>&id=<?=$_GET['id']?>&works=<?=$_GET['works']?>">&gt;&gt;</a>
    </td>
  </tr>
  <tr align="center">
    <?
            for ($i = 1; $i <= 7; $i++) {

?>
    <td background="./img/02.gif">
      <b><?=$daysarray[$i]?></b>
    </td>
<?
            }
?>
<?
  $j = 1;
  $calc = 1;
  while ($calc<$numberfirstday+$monthdays){
  	if ($j==8) $j=1;
  	if ($j==1){
?>
  </tr>
  <tr align="center">
<?
  	}
  	if ($calc<$numberfirstday){
?>
    <td background="./img/01.gif">
      &nbsp;
    </td>
<?
  	}else{
      $showday=$calc-$numberfirstday+1;
      if ($arr[$showday]=="close") {
      	$background="./img/01.gif";
      	$text = $showday;
      }
      if ($arr[$showday]=="free") {
      	$background="./img/02.gif";
      	$text = "<a href=\"javascript:set_datetime(".mktime(0, 0, 0, $tmpd["mon"], $showday, $tmpd["year"])."000, true);\"> ".$showday."</a>";
      }
      if ($arr[$showday]=="to") {
      	$background="./img/04.gif";
      	$text = "<a href=\"javascript:set_datetime(".mktime(0, 0, 0, $tmpd["mon"], $showday, $tmpd["year"])."000, true);\"> ".$showday."</a>";
      }
      if ($arr[$showday]=="from") {
      	$background="./img/03.gif";
      	$text = "<a href=\"javascript:set_datetime(".mktime(0, 0, 0, $tmpd["mon"], $showday, $tmpd["year"])."000, true);\"> ".$showday."</a>";
      }
?>
    <td background="<?=$background?>">
      <?=$text?>
    </td>
<?
    }
  	$calc++;
  	$j++;
  }
?>
  </tr>
