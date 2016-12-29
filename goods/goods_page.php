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
    $type=$_GET['type'];

    $sql="select goods_num, goods_name, goods_price, goods_img, goods_type from goods where goods_type='{$type}'";
    $stt = $db->prepare($sql,[PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL]);
    $res=$stt->execute();

    if($res){
			echo ' 성공';
			}else{
			echo '실패';
			}

      while($row=$stt->fetch(PDO::FETCH_ASSOC)){
        $num=$row['goods_num'];
        echo(
          "<span>
            <table id='goods_table'>
            <tr>
              <td><a href='goods_detail.php?num={$num}'><img src='../img/{$row['goods_img']}'></th></a>
            </tr>
            <tr>
              <td>{$row['goods_name']}</td>
            </tr>
            <tr>
              <td>{$row['goods_price']}</td>
            </tr>
          </table>
          </span>"
          );
      }
    }catch(PDOException $e){
      exit("에러발생: {$e->getMessage()}");
    }

  $db=null;
?>
