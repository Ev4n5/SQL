<?php
  require_once("dbtools.inc.php");
  $name = $_POST['account'];
  $pw   = $_POST['password'];

    switch ($_POST['mod']) {
      case 'login':
        login(no_sqli($name),no_sqli($pw));
        break;
      case 'register':
        $pw2 = @$_POST['password2'];
        if($pw !== $pw2)
          die('<label>密碼不一致，請重新確認</label>');
        register(no_sqli($name),no_sqli($pw));
        break;
      default:
        echo ('ERROR');
        break;
    }



  function login($name = null , $pw = null){
    $link = create_connection();
    $sql = "SELECT password FROM `account` WHERE name = '$name'";
    $result = execute_sql('shop',$sql,$link);
    $sql_pw = @mysql_fetch_row($result);
    mysql_close($link);

    if($pw == $sql_pw[0]){

      $_SESSION['user'] = $name;
      $_SESSION['login_time'] = strtotime("+1 hours");

      header("Location: index.php");
      exit;
    }else {die('<label>帳號密碼輸入錯誤</lable>');}

  }

  function register($name = null , $pw = null){
    $link=create_connection();
    $sql = "SELECT name FROM `account` WHERE name = '$name'";
    $result=execute_sql('shop',$sql,$link);
    $sql_name = @mysql_fetch_row($result);

    if(empty($sql_name)){
      $sql="INSERT INTO account (name,password) VALUES ('$name','$pw')";
      $result=execute_sql('shop',$sql,$link);
      mysql_close($link);
      echo "<script> {window.alert('註冊成功!! 請重新登入');location.href='login.php'} </script>";
      exit;
    }else {
      mysql_close($link);
      die('<label>帳號已經有人使用了</lable>');
    }

  }

  function no_sqli($sqli= null){
    if(preg_match('[\W]', $sqli)){die('您只能輸入英文以及數字');}
    return $sqli;
  }




 ?>
