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
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>皮卡丘購物網</title>
    <link rel="icon" type="image/png" href="https://inews.gtimg.com/newsapp_bt/0/8994688035/640" />
  </head>
  <body bgcolor="#AAFFEE">
    <input type="button" value="回首頁" onclick="location.href='index.php'">
    <table style="border:3px #cccccc solid;" rules="all" cellpadding='5';>
      <td>訂單編號</td>
      <td>商品名稱</td>
      <td>商品價錢</td>
      <td>買家資料</td>
      <td>訂單狀態</td>
      <tbody id="tbody1">
      </tbody>
    </table>
    <?php
      require_once("dbtools.inc.php");
      $user = $_SESSION['user'];
      $link=create_connection();

      $sql = "SELECT item_order.order_id,item.item_name,item.item_price,user.user_name,user.user_phone,user.user_home,item_order.order_status FROM `item_order` INNER JOIN `item` ON item.item_id = item_order.order_product INNER JOIN `user` ON item_order.order_user = user.user_account WHERE item_order.order_seller = '$user'";
    	$result=execute_sql('shop', $sql, $link);
      while($row=@mysql_fetch_assoc($result)){
       $tmp[] = $row;
      }
      mysql_close($link);
      //print_r($tmp);
     ?>

     <script type="text/javascript">
       var data = new Array
       let tmp = ""
       data = <?php echo json_encode($tmp); ?>;
       var tab=document.getElementById('tbody1');
       for(let i=0; i<data.length; i++){
         tmp +='<td>' + data[i]['order_id'] + '</td>'
         tmp +='<td>' + data[i]['item_name'] + '</td>'
         tmp +='<td>' + data[i]['item_price'] + '</td>'
         tmp +='<td>姓名:' + data[i]['user_name'] + '</br>電話:' + data[i]['user_phone'] + '</br>地址:' + data[i]['user_home'] + '</td>'
         tmp +='<td>' + data[i]['order_status'] + '</td>'
         tmp +='<td><input type="button" value="出貨" onclick="a('+ data[i]['order_id'] +');"></td>'
         tab.innerHTML+='<tr>' + tmp + '</tr>'
         tmp = ""

       }
       function a(data){
         location.href='order2.php?up=' + data;
       }

     </script>
     <?php
        if(!empty($_GET['up'])){
          $up = $_GET['up'];
          $link = create_connection();
          $sql = "UPDATE `item_order` SET order_status = '已出貨' WHERE order_id = $up";
          $result = execute_sql('shop',$sql,$link);
          mysql_close($link);
          echo "<script> {window.alert('訂單更新成功');location.href='order2.php'}</script>";

        }


      ?>
  </body></html>
