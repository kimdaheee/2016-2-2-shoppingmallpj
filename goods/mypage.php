<?php
session_start();
?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="../css/main.css" rel="stylesheet" type="text/css" media="all">
    <link href="../css/top_logincs.css" rel="stylesheet" type="text/css" media="all">
    <link href="../css/top_menucs.css" rel="stylesheet" type="text/css" media="all">
    <link href="../css/goods_formcs.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body>
    <div id="wrap">
       <div id="header">
          <?php require_once "../lib/top_logo2.php"; ?>
      </div>
    <div id="menu">
       <?php require_once "../lib/top_menu2.php"; ?>
    </div>
  </body>
  </html>
<?php
require_once '../lib/DBManager.php';
try{
  $db=connect();
  $userid=$_SESSION['ID_key_session'];

  $sql="select user_id, mgoods_name, mgoods_count, mgoods_price, mgoods_date, mgoods_img from mylist where user_id='{$userid}'";
  $stt = $db->prepare($sql,[PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL]);
  $res=$stt->execute();

  if($res){
    echo ' 성공';
    }else{
    echo '실패';
    }

    while($row=$stt->fetch(PDO::FETCH_ASSOC)){
      $userid=$row['user_id'];
      $name=$row['mgoods_name'];
      $count=$row['mgoods_count'];
      $price=$row['mgoods_price'];
      $date=$row['mgoods_date'];
      $img=$row['mgoods_img'];
      $result=$count*$price;

      echo(
      " <table id='list_form' width='1000px' height='300px' border='1px solid black'>
          <tr>
            <th width='100px'>아이디</th>
            <th rowspan='2' width='300px'><img src='../img/{$img}'></th>
            <th width='100px'>상품명</th>
            <th width='100px'>구매수량</th>
            <th width='100px'>구매가격</th>
            <th width='100px'>구매일자</th>
          </tr>
          <tr>
            <td width='100px' align='center'>$userid</td>
            <td width='100px' align='center'>$name</td>
            <td width='100px' align='center'>$count</td>
            <td width='100px' align='center'>$result</td>
            <td width='100px' align='center'>$date</td>
          </tr>
          </table>"
        );
      }
    }catch(PDOException $e){
      exit("에러발생: {$e->getMessage()}");
    }

$db=null;
 ?>
