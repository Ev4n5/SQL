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
<body bgcolor=#333333><table width=100% height=100%><td align=center><span style='font: 55px tahoma;size:55px;color:#ffffff;text-shadow: 10px 10px 10px;'><font style="font-family: 'Shadows Into Light', cursive;">上傳商品</span></font></center>
<form method="post" enctype="multipart/form-data">
  <div class="inset">
  <p>
    <label for="name">商品名稱</label>
    <input type="name" name="name" id="name">
  </p>
  <p>
    <label for="phone">商品價錢</label>
    <input type="price" name="price" id="price">
  </p>
  <p>
    <label for="type">商品類型</label>
    <select name="type">
      <option value="C3">電子產品</option>
      <option value="food">食品</option>
      <option value="clothes">服裝</option>
      <option value="home">居家</option>
    </select>
  </p>
  <p>
    <label for="file">商品圖片</label>
    <input type="file" name="file" id="file">
  </p>
  </div>
  <p class="p-container">
    <input type="submit" name="mod" id="mod" value="upload">
  </p>
</form>
</body></html>
<?php
  if(!empty($_POST['mod'])){
    if(empty($_POST['name']) || empty($_POST['price']) || empty($_FILES["file"]["tmp_name"])){
      die('<label> 商品名稱 && 商品價錢不能為空</label>');
    }else {
      $name = $_POST['name'];
      $price = $_POST['price'];
      $type = $_POST['type'];
      upload_image($_FILES,$name,$price,$type);
    }
  }
  function upload_image($FILES = null,$name = null,$price = null,$type = null){
    $link = create_connection();
    $sql = "SELECT COUNT(*) FROM `item`";
    $result = execute_sql('shop',$sql,$link);
    $id = @mysql_result($result,0);
    $user = $_SESSION['user'];
    $sql = "INSERT INTO item (item_id,item_name,item_price,item_type,item_user) VALUES ('$id','$name','$price','$type','$user')";
    $result=execute_sql('shop',$sql,$link);
    mysql_close($link);
    $uploads_dir = '/home/evans/Desktop/SQL_HW/images';
    $tmp_name = $FILES["file"]["tmp_name"];
    move_uploaded_file($tmp_name,"$uploads_dir/$id");
    echo "<script> {window.alert('已新增您的資料如下: \\r 商品名稱:$name \\r 商品價錢:$price ');location.href='index.php'} </script>";


  }
 ?>
