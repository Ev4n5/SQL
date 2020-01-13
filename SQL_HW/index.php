<?php
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
  <link rel="stylesheet" type="text/css" href="css/mod2.css">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="icon" type="image/png" href="https://inews.gtimg.com/newsapp_bt/0/8994688035/640" />
<head>
<body bgcolor="">
  <nav><h3 style="background-color:#3e3e3e;color:white;margin:0;padding:10px 20px;text-align:center;">menu</h3>
    <ul  class="cwhite">
      <li>Shop
        <ul class="middle">
          <li class="btn btn2"><a href="?item=C3">電子產品</a></li>
          <li class="btn btn2"><a href="?item=food">食品</a></li>
          <li class="btn btn2"><a href="?item=clothes">服裝</a></li>
          <li class="btn btn2"><a href="?item=home">居家</a></li>
        </ul>
      </li>
      <li>Seting
      <ul class="middle">
        <li class="btn btn2"><a href="whoami.php">個人資料</a></li>
        <li class="btn btn2"><a href="upload.php">登入商品</a></li>
        <li class="btn btn2"><a href="order.php">我的訂單</a></li>
        <li class="btn btn2"><a href="order2.php">管理訂單</a></li>
        <li class="btn btn2"><a href="?mod=logout">登出</a></li>
      </ul>
        </li>
    </ul>
  </nav>
<?php
  if(!empty($_GET['item'])){include('item.php');}
  if(!empty($_GET['mod']) && $_GET['mod'] == 'logout'){
    session_destroy();
    header("Location: index.php");
  }
 ?>
</body></html>
