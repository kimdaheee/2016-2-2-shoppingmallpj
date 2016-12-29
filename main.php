<?php
session_start();
 ?>

<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title>홈페이지 제작</title>
    <link rel="stylesheet" href="./css/main.css">
  </head>
  <body>
    <div id='wrap'>
      <div id="header">
        <?php require_once "./lib/top_logo.php"; ?>
      </div>
    <div id='menu'>
      <?php require_once "./lib/top_menu.php"; ?>
    </div>
    <div id='content'>
      <div id="main_img">
        <img src="./img/mainimg2.jpg">
      </div>
    </div>
  </div>
  </body>
</html>
