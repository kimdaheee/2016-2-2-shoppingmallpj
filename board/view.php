<?php
	session_start();
	try{
	require_once "../lib/DBManager.php";

	$db=connect();
  $table=$_GET['table'];
	$num=$_GET['num'];

	$sql = "select * from $table where b_no=$num";
  $stt=$db->prepare($sql,[PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL]);
  $stt->execute();
  $row = $stt->fetch(PDO::FETCH_ASSOC);

	$item_num     = $row['b_no'];
	$item_id      = $_SESSION['ID_key_session'];

	$image_name[0]   = $row['file_name_0'];
	$image_name[1]   = $row['file_name_1'];
	$image_name[2]   = $row['file_name_2'];


	$image_copied[0] = $row['file_copied_0'];
	$image_copied[1] = $row['file_copied_1'];
	$image_copied[2] = $row['file_copied_2'];

  $item_date    = $row['b_date'];
	$item_title = str_replace(" ", "&nbsp;", $row['b_title']);
	$item_content = $row['b_content'];
	}catch(PDOException $e){
		exit("에러발생: {$e->getMessage()}");
	}

	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i])
		{
			$imageinfo = GetImageSize("../data/".$image_copied[$i]);
			$image_width[$i] = $imageinfo[0];//가로크기
			$image_height[$i] = $imageinfo[1];//세로크기
			$image_type[$i]  = $imageinfo[2];//확장자

			if ($image_width[$i] > 785) //가로크기 785 넘으며 785로 초기화
					$image_width[$i] = 785;
		}
		else
		{
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		}
	}
	?>
<html>
<head>
<link href="../css/main.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/top_logincs.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/top_menucs.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/boardviewcs.css" rel="stylesheet" type="text/css" media="all">
<script>
    function del(href) //href: 주소 속성이라서 주소를 바꿔줌(바로 delete.php로 가게 됨)
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n 정말 삭제하시겠습니까?"))
				 {
                document.location.href = href;
        }
    }
</script>
</head>

<body>
<div id="wrap">
	<div id="header">
		<?php require_once "../lib/top_logo2.php"; ?>
	</div>

	<div id="menu">
	<?php require_once "../lib/top_menu2.php"; ?>
	</div>

		<div id="view_title">
			글 제목: <?= $item_title ?> | 아이디: <?= $item_id ?> | 작성일자: <?= $item_date ?>
		</div>

		<div id="view_content">
		<?php
		for ($i=0; $i<3; $i++)
		{
			if ($image_copied[$i])
			{
			$show_name=$image_name[$i];
			$real_name=$image_copied[$i];
		//	$img_name = $image_copied[$i];
			$real_type=$image_type[$i];
			$file_path="../data/".$real_name;
			// $file_size=filesize($file_path);
			//첨부파일 다운로드
			//$img_name = "../data/".$img_name;
			$img_width = $image_width[$i];

			echo "<img src='$file_path' width='$img_width'>"."<br><br>";
			echo (" 첨부파일 : $show_name&nbsp;&nbsp;&nbsp;&nbsp;
					<a href='download.php?table=$table&num=$num&real_name=$real_name&show_name=$show_name'>[저장]</a>
					<br>"
			);

		}
	}
	?>
		본문내용 : <?= $item_content ?>
		</div>

		<div id="view_button">
				<a href="boardlistform.php?table=<?=$table?>"><img src="../img/list.png"></a>&nbsp;
			<?php
				if($_SESSION['ID_key_session']==$item_id)
				{
			?>
						<a href="javascript:del('delete.php?table=<?=$table?>&amp;num=<?=$num?>')">
						<img src="../img/delete.png"></a>&nbsp;
			<?php
				}
			?>
		</div>
</div>
</body>
</html>
