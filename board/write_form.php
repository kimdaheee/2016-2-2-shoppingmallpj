<?php
	session_start();
	require_once "../lib/DBManager.php";
  $db=connect();
	$table=$_GET['table'];

    if(!isset($_POST['board_form'])){//form값에 아무것도 없기 때문에 에러 방지
      $item_title="";
      $item_content="";
      $item_file_0="";
      $item_file_1="";
      $item_file_2="";
    }
	?>
		<html>
		<head>
		<link href="../css/main.css" rel="stylesheet" type="text/css" media="all">
		<link href="../css/top_logincs.css" rel="stylesheet" type="text/css" media="all">
		<link href="../css/top_menucs.css" rel="stylesheet" type="text/css" media="all">
		</head>
		<body>
		<div id="wrap">
			  <div id="header">
			    <?php require_once "../lib/top_logo2.php"; ?>
			  </div>

			  <div id="menu">
				   <?php require_once "../lib/top_menu2.php"; ?>
			  </div>
				<form name="board_form" method="post" action="writeinsert.php?&amp;table=<?=$table?>"
		      enctype="multipart/form-data">
		        <div class="col1"> 아이디 </div>
		        	<div class="col2"><?=$_SESSION['ID_key_session']?></div>
		        <div class="col1">제목</div>
					  	<div class="col2">
		          <input type="text" name="title" value="<?=$item_title?>"></div>
							<div id="write_row3">
		        		<div class="col1">내용</div>
					    <div class="col2">
		            <textarea rows="15" cols="79" name="content"><?=$item_content?></textarea></div>
							</div>
							<div id="write_row4">
		        		<div class="col1">이미지파일1</div>
					  		<div class="col2"><input type="file" name="upfile[]" required ></div>
							</div>
							<div id="write_row5">
				        <div class="col1"> 이미지파일2</div>
							  <div class="col2"><input type="file" name="upfile[]" required ></div>
							</div>
							<div id="write_row6">
		        		<div class="col1">이미지파일3</div>
					  		<div class="col2">
		          	<input type="file" name="upfile[]" required ></div>
							</div>

							<div id="write_button">
								<input type="submit" name="" value="전송">
		        		<!-- <img src="../img/ok.png" onclick="check_input()">&nbsp; -->
							</div>
						</form>
					</div>
				</body>
			</html>
