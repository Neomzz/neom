<?php
  function authenticate() {
    header('WWW-Authenticate: Basic realm=""');
    header('HTTP/1.0 401 Unauthorized');
    echo " \n";
    exit;
  }
if( isset( $_GET['logout'] ) ) {
  session_destroy();
  unset($_SERVER['PHP_AUTH_USER']);
  unset($_SERVER['PHP_AUTH_PW']);
  header("Location: ./");
//  exit;
}

  if (!isset($_SERVER['PHP_AUTH_USER'])) {
   authenticate();
  }
  else
  {
    include 'sconnect.php';
    $result = mysql_query("SELECT * FROM users where login='".$_SERVER['PHP_AUTH_USER']."';");
	while ($row = mysql_fetch_assoc($result)) {
      $user_id=$row["id"];
      $login=$row["login"];
      $user_name=$row["name"];
      $access=$row["status"];
      $pass=$row["passemp"];
    }
    if (empty($pass) || $pass != md5($_SERVER['PHP_AUTH_PW']) || $_SERVER['PHP_AUTH_USER'] != $login) authenticate();
    $sql = "UPDATE `users` SET `logon` = '".date("Y-m-d")."' WHERE `id` =".$user_id." LIMIT 1 ;";
    $result = mysql_query($sql) or die("Query failed : " . mysql_error());
    $DateLogon10 = date("Y-m-d", mktime(0, 0, 0, date("n"), date("j") - 10, date("Y")));
    $result = mysql_query("SELECT * FROM `users` WHERE `logon` < '".$DateLogon10."';");
    while ($row = mysql_fetch_assoc($result)) {
      $id_lock=$row["id"];
      $login_lock=$row["login"];
      $name_lock=$row["name"];
      $send=$row["send_mail"];
    }
  }
?>