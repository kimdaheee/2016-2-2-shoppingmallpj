<?php session_start(); ?>
<html>
<head>
<meta charset="utf-8">
<link href="../css/main.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/top_logincs.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/top_menucs.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/login_formcs.css" rel="stylesheet" type="text/css" media="all">
<body>
  <div id="wrap">
    <div id="header">
      <?php include "../lib/top_logo2.php"; ?>
    </div>

    <div id="menu">
  	<?php include "../lib/top_menu2.php"; ?>
    </div>

  	<div id="col2">
      <form name="login_form" action="login.php" method="post">
        <!-- <div id="title">
          <img src="../img/title_login.gif" alt="" />
        </div> -->
        <div class="loginForm">
          <div class="box">
           <input type="text" class="iText" name="id" value="아이디를 입력하세요.">
           <br>
           <input type="password"  class="iText" name="passwd">
           <br>
           <p>
             <span class="fleft"><input type="checkbox" id=""><label for=""> 아이디 저장</label></span>
             <span class="fright"><a href="">아이디 찾기</a>&nbsp;|&nbsp;<a href="">비밀번호 찾기</a></span>
           </p>
         </div>
         <div id="login_button">
            <input type="image" src="../img/login_button.jpg"><br/>
            <input type="hidden" name="mode" value="insert"><br/>
         </div>
       </div>
      </form>
    </div>
  </div>
</body>
</html>
