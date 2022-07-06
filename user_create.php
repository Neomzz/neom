<?php
    session_start();
    // константы
    define("HOST", "localhost");
    define("USER", "root");
    define("PASSWORD", "*****");
    define("DB_NAME", "mydb");
    //подключение к бд
    $db_connect = mysql_connect(HOST, USER, PASSWORD, TRUE); 
    mysql_selectdb(DB_NAME,$db_connect);
    mysql_set_charset('utf8');
     
    //проверяем, авторизовался ли пользователь,
    // если нет, то редиректим его на авторизацию
   //if(isset($_SESSION['login'])){
     
        /*
        * Если был сабмит формы, 
        * то проверяем данные и если все хорошо, 
        * то записываем данные в базу данных
        */
        // ===>>>
        if($_POST["user_create"])
            // тут по хорошему нужно сделать проверку данных
            // я ее делать не буду чтобы не усложнять скрипт
            // а сразу сделаю запись в базе данных
            $sql = mysql_query("
                INSERT INTO `user` 
                    (`first_name`, 
                    `last_name`, 
                    `login`, 
                    `password`) 
                    VALUES 
                    ('".$_POST['first_name']."', 
                    '".$_POST['last_name']."', 
                    '".$_POST['login']."', 
                    '".MD5($_POST['password'])."');
            ") or die(mysql_error());
            if($sql) 
                echo "User created!"; // если все прошло хорошо и пользователь создан
        
        // <<<===      
?>
<form name="user_frm" method="POST" action="/info/2/1/show/user_create.php">
    <table>
        <tr>
            <td>id</td>
            <td>first_name</td>
            <td>last_name</td>
            <td>login</td>
            <td>password</td>
        </tr>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><input type="text" value="" name="first_name"></td>
            <td><input type="text" value="" name="last_name"></td>
            <td><input type="text" value="" name="login"></td>
            <td><input type="text" value="" name="password"></td>
        </tr>
    </table>
    <input type="submit" value="create" name="user_create">
</form>
<?php
    }else{
        //header("Location: /info/login.php");exit;
    }
?>
