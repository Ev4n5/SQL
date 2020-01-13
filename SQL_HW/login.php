<?php
  session_start();
  if(isset($_SESSION["user"])){
    header('Location: index.php');
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
<body bgcolor=#333333><table width=100% height=100%><td align=center><span style='font: 55px tahoma;size:55px;color:#ffffff;text-shadow: 10px 10px 10px;'><font style="font-family: 'Shadows Into Light', cursive;">皮卡丘購物網</span></font></center>
<form method="post">
  <h1>登入</h1>
  <div class="inset">
  <p>
    <label for="account">帳號</label>
    <input type="text" name="account" id="account">
  </p>
  <p>
    <label for="password">密碼</label>
    <input type="password" name="password" id="password">
  </p>
  </div>
  <p class="p-container">
   <a href="register.php"><span>點此註冊</span></a>
    <input type="submit" name="mod" id="mod" value="login">
  </p>
  <?php
    if(!empty($_POST['mod'])){
      if(empty($_POST['account']) || empty($_POST['password'])){
        die('<label> 帳號或密碼不能為空</label>');
      }else {
        include('mod.php');
      }
    }
   ?>
</form>
</body></html>
