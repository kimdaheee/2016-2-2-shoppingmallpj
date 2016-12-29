<?php session_start(); ?>
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
    $num=$_GET['num'];

    $sql="select goods_num, goods_name, goods_price, goods_img, goods_type from goods where goods_num={$num}";
    $stt = $db->prepare($sql,[PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL]);
    $res=$stt->execute();

    if($res){
			echo ' 성공';
			}else{
			echo '실패';
			}

      while($row=$stt->fetch(PDO::FETCH_ASSOC)){
        $goods_img=$row['goods_img'];
        $goods_name=$row['goods_name'];
        $goods_price=$row['goods_price'];
        $date = date("Y-m-d (H:i)");
        $userid= $_SESSION['ID_key_session'];
        echo(
          " <form name='goods_detail' action='mypage_insert.php?num={$num}' method='post'>
            <table class='detail_table'>
            <tr>
              <th><img src='../img/$goods_img'</th>
              <input type='hidden' value='$goods_img' name='goods_img'>
            </tr>
            <tr>
              <td>상품명</td>
              <td>$goods_name</td>
              <input type='hidden' value='$goods_name' name='goods_name'>
            </tr>
            <tr>
              <td>가격</td>
              <td>$goods_price</td>
              <input type='hidden' value='$goods_price' name='goods_price'>
            </tr>
            <tr>
              <td>구매수량</td>
              <td><input type='text' name='goods_count'>개</td>
            </tr>
            </table>
            <input type= 'hidden' value='$userid' name='userid'>
            <input type= 'hidden' value='$date' name='date'>
            <input type='submit' value='구매'>
            </form>"
          );
        }
      }catch(PDOException $e){
        exit("에러발생: {$e->getMessage()}");
      }

  $db=null;
?>
