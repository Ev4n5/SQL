<script type="text/javascript" src="js/item.js"></script>


<div class="box" id="div1">
  <div class="item" id="div2">
 </div></div>
<?php
  require_once("dbtools.inc.php");
  $item = $_GET['item'];
  $link = create_connection();
  $sql = "SELECT item.item_id,item.item_name,item.item_price,item.item_type,user.user_name FROM `item` INNER JOIN `user` ON user.user_account = item.item_user  WHERE item.item_type = '$item' ";
  $result = execute_sql('shop',$sql,$link);
  //$sql_data = @mysql_fetch_Array($result);
  //$row = mysql_fetch_assoc($result);
   while($row=@mysql_fetch_assoc($result)){
    $tmp[] = $row;
   }
   //$data = json_encode($tmp);
   //print_r($data);
  mysql_close($link);
 ?>


 <script type="text/javascript">
   var data = new Array
   data = <?php echo json_encode($tmp); ?>;
   window.onload = function() {
     var fun = additem(data);
   };
 </script>

<?php
  if(!empty($_GET['item_id'])){
    $item = $_GET['item'];
    $item_id = $_GET['item_id'];
    $link = create_connection();
    $sql ="SELECT COUNT(*) FROM `item_order`";
    $result = execute_sql('shop',$sql,$link);
    $id = @mysql_result($result,0);
    $sql ="SELECT item_user FROM `item` WHERE item_id = '$item_id'";
    $result = execute_sql('shop',$sql,$link);
    $item_user = @mysql_result($result,0);
    $user = $_SESSION['user'];
    $sql = "INSERT INTO item_order (order_id,order_seller,order_user,order_product,order_status) VALUES ('$id','$item_user','$user','$item_id','未出貨')";
    $result = execute_sql('shop',$sql,$link);
    echo "<script> {window.alert('訂單已成立，請到我的訂單確認');location.href='index.php?mod=$item'}</script>";

  }
 ?>
