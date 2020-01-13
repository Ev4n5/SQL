<?php
  require_once("dbtools.inc.php");
  session_start();

  if(!isset($_SESSION["user"])){
    header('Location: login.php');
  }

  if($_SESSION['login_time'] < strtotime('now')) {
    session_destroy();
    echo "<script> {window.alert('登入超時');location.href='login.php'} </script>";
  }

?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>皮卡丘購物網</title>
<link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Noto+Sans+TC' rel='stylesheet' type='text/css'>
<link rel="icon" type="image/png" href="https://inews.gtimg.com/newsapp_bt/0/8994688035/640" />
<link rel="stylesheet" type="text/css" href="css/login.css">
<script src="js/snowflake.js"></script>
</head>
<body bgcolor=#333333><table width=100% height=100%><td align=center><span style='font: 55px tahoma;size:55px;color:#ffffff;text-shadow: 10px 10px 10px;'><font style="font-family: 'Shadows Into Light', cursive;">個人資料</span></font></center>
<form method="post">
  <div class="inset">
  <p>
    <label for="name">姓名</label>
    <input type="name" name="name" id="name">
  </p>
  <p>
    <label for="phone">電話</label>
    <input type="phone" name="phone" id="phone">
  </p>
  <p>
    <label for="home">住址</label>
    <input type="home" name="home" id="home">
  </p>
  </div>
  <p class="p-container">
    <input type="submit" name="mod" id="mod" value="submit">
  </p>
</form>
</body></html>
<?php
  if(!empty($_POST['mod'])){
    if(empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['home'])){
      die('<label>姓名 && 電話 && 住址不能為空</label>');
    }else {
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $home = $_POST['home'];
      whoami($name,$phone,$home);
    }
  }
  function whoami($name = null,$phone = null,$home = null){
    $link = create_connection();
    $user = $_SESSION['user'];
    $sql = "SELECT user_account FROM `user` WHERE user_account = '$user'";
    $result = execute_sql('shop',$sql,$link);
    $sql_account = @mysql_result($result,0);

    if(empty($sql_account)){
      $sql = "INSERT INTO user (user_account,user_home,user_name,user_phone) VALUES ('$user','$home','$name','$phone')";
      $result = execute_sql("shop",$sql,$link);
      mysql_close($link);
      echo "<script> {window.alert('已新增您的資料如下: \\r 姓名:$name \\r 電話:$phone \\r 住址:$home');location.href='index.php'} </script>";
    }
    else {
      $sql = "UPDATE `user` SET user_home = '$home', user_name = '$name', user_phone = '$phone' WHERE user_account = '$user'";
      $result = execute_sql('shop',$sql,$link);
      mysql_close($link);
      echo "<script> {window.alert('已更新您的資料如下: \\r 姓名:$name \\r 電話:$phone \\r 住址:$home');location.href='index.php'} </script>";
    }

  }

 ?>
