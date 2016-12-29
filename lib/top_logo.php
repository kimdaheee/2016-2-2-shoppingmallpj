<head>
  <link rel="stylesheet" href="./css/top_logincs.css"></link>
</head>
<div id="title">
  <a href="main.php">
    <img src="./img/title.jpg" border="0" href="./main.php" />
  </a>
</div>
<div id="top_login">
  <?php
    if(!isset($_SESSION['ID_key_session'])){
      //isset: 값이 있으면 true 없으면 false
      //!isset: 값이 없으면 true 있으면 false
   ?>
   <a href="./login/login_form.php">로그인</a>|
   <a href="./memberjoin/join_form3.php">회원가입</a>
   <?php
 } else if(($_SESSION['ID_key_session'])=="manager"){
    ?>
    환영합니다 <?=$_SESSION['ID_key_session'] ?> 님!
    <a href="./goods/mag_goods_form.php">관리페이지|</a>
    <a href="./login/logout.php">로그아웃</a>
   <?php
      }else{
        //php의 변수값, 함수의 결과값을 태그영역에 나타내기
    ?>
    환영합니다 <?=$_SESSION['ID_key_session'] ?> 님!
    <a href="./login/logout.php">로그아웃</a>
    <?php
      }
    ?>
</div>
