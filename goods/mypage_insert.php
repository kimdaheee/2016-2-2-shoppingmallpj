<?php
session_start();
require_once '../lib/DBManager.php';
try{
  $db=connect();
  $userid=$_POST['userid'];
  $img=$_POST['goods_img'];
  $name=$_POST['goods_name'];
  $count=$_POST['goods_count'];
  $price=$_POST['goods_price'];
  $date=$_POST['date'];
  $num=$_GET['num'];

  $sql="insert into mylist(user_id, mgoods_name, mgoods_count, mgoods_price, mgoods_date, mgoods_img)";
  $sql.="values(:user_id, :mgoods_name, :mgoods_count, :mgoods_price, :mgoods_date, :mgoods_img)";
  $stt = $db->prepare($sql,[PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL]);
  $res=$stt->execute([
    ':user_id'=>$userid,
    ':mgoods_name'=>$name,
    ':mgoods_count'=>$count,
    ':mgoods_price'=>$price,
    ':mgoods_date'=>$date,
    ':mgoods_img'=>$img
  ]);

  $sql="select g.goods_name,g.goods_stock, m.mgoods_count from goods g, mylist m where g.goods_name=m.mgoods_name;";



  if($res){
    echo ' 성공';
    }else{
    echo '실패';
    }
    echo("
      <script>
        location.href='mypage.php';
      </script>
    ");
  }catch(PDOException $e){
   exit("에러발생: {$e->getMessage()}");
  }

      $db=null;
?>
