<?
  $months = array("1"=>"������","2"=>"�������","3"=>"�����","4"=>"������","5"=>"���", "6"=>"����", "7"=>"����","8"=>"�������","9"=>"��������","10"=>"�������","11"=>"������","12"=>"�������");// ������ ������� ��� ������ � "�������"   

  $result_main = mysql_query("SELECT name as client_name, phone as client_phone, address as client_address from main inner join clients on main.client = clients.id WHERE main.id = '".$_POST['main']."';");

  while ($row_main = mysql_fetch_assoc($result_main)){
  	$client_name=$row_main["client_name"];
  	$client_phone=$row_main["client_phone"];
  	$client_address=$row_main["client_address"];  	
  }
  $client_address=explode("@",$client_address);
  $client_phone=explode(",",$client_phone);
  /*
<table width="80%">
 <tr>
  <td>
  <form action="select.php" method="GET">
  <input type="hidden" name="date" value="<?=date("Y-m-d")?>">
  <input type="hidden" name="id" value="<?=$_POST['main']?>">
  <input type="hidden" name="end" value="<?=$_POST['end']?>">
  <input type="submit" value="�����">
</form>
   <a href="select.php"><img align = "left" src="img/back.png" alt="�����" border="0">�����</a>
  </td>
 </tr>
</table>
*/
?>
<form name="edmo" action="send.php" method="post" enctype="multipart/form-data">
  <table width="80%" border="1" cellpadding="0" cellspacing="0">
    <?php
    include ".\\forms\\output\\fio.php";
    include ".\\forms\\output\\address.php";
    include ".\\forms\\output\\phone.php";    
    ?>
    <tr>
      <td align="center" width="30%">
        ����
      </td>
      <td align="center">
        <input type="text" size="26" name="send_date" onChange="ChangeDate(date)">
        <a href="javascript:cal1.popup();"><img height="16" alt="�������� ��� �������� ���������" src="./img/cal.gif" width="16" border="0"></a>
      </td>
    </tr>
    <tr>
      <td align="center" width="30%">
        �����
      </td>
      <td align="center">
        <select name="time">
          <option value="0">�� �����</option>
          <option value="1">����� �����</option>
        </select>
      </td>
    </tr>
    <tr>
      <td align="center">
        ����������
      </td>
      <td align="center">
        <textarea name="note" rows="3" cols="45"></textarea>
      </td>
    </tr>
  </table>
  <table width="80%" border="0">
  <tr>
  <input type="hidden" name="id" value="<?=$_GET['id']?>">
  <input type="hidden" name="main" value="<?=$_POST['main']?>">
  <input type="hidden" name="end" value="<?=$_POST['end']?>">
  <td align = "left">
  <input type="reset" value="������ �����">
  </td>
  <td align = "right">
  <input type="submit" value="��������� ������">
  </td>
  <td align = "right"></td>  
  </tr>
  </table>
</form>

<script language="JavaScript">
var cal1 = new calendar1(document.forms["edmo"].elements["send_date"]);
cal1.works = "<?=$work[$_GET['id']]?>";
cal1.year_scroll = false;
cal1.time_comp = false;
//-->
</script>
