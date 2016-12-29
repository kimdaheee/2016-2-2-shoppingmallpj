<?php session_start(); ?>

<?php
	$table=$_GET['table'];
	if(!$_SESSION['ID_key_session']) {
		echo("
		<script>
	     window.alert('로그인 후 이용해주세용')
	     history.go(-1)
	   </script>
		");
		exit;
	}

	$date = date("Y-m-d (H:i)");
	$files = $_FILES["upfile"];//3차원 배열인 $_FILES를 2차원 형태로 간소화
	$count = count($files['name']);//업로드한 이미지 갯수
	$upload_dir = '../data/';//파일이 저장되는 위치

	for ($i=0; $i<$count; $i++)
	{

		$upfile_name[$i]     = $files["name"][$i];//업로드 실제 파일명 //i가 순회화면서 upfile_name에 순서대로 이름을 저장
		$upfile_tmp_name[$i] = $files["tmp_name"][$i];//서버에 저장되는 임시 파일명
		$upfile_type[$i]     = $files["type"][$i];//업로드 파일 형식
		$upfile_size[$i]     = $files["size"][$i];//업로드 파일 크기
		$upfile_error[$i]    = $files["error"][$i];//에러 발생 확인

		$file = explode(".", $upfile_name[$i]);//문자열 나누기(.을 경계로 나눔->이름과 확장자를 나눔)
    //if ($file[0]&&$file[1]) {
			$file_count = count($file);
			$file_name="";
      //$file_name = $file[0];
			for($j = 0; $j <$file_count-1; $j++){
				$file_name .= $file[$j];
				if($j < $file_count-2){
					$file_name .= ".";
				}
			} //파일 이름
			$file_ext = $file[$file_count-1]; //파일확장자

    //}


		if (!$upfile_error[$i])
		{

			$new_file_name = date("Y_m_d_H_i_s");
			$new_file_name = $new_file_name."_".$i;
			$copied_file_name[$i] = $new_file_name.".".$file_ext;
			$uploaded_file[$i] = $upload_dir.$copied_file_name[$i];
			//../data/날짜_0.jpg로 저장됨
			if(isset($upfile_size[$i]) > 500000 ){
				echo("
				<script>
				alert('업로드 파일 크기가 지정된 용량(500KB)를 초과합니다! 파일 크기를 확인해주세요 ');
				history.go(-1)
				</script>
				");
				exit;
				}
			}

			if ((isset($upfile_type[$i])!= "image/gif") &&
				(isset($upfile_type[$i]) != "image/jpeg") &&
				(isset($upfile_type[$i]) != "image/pjpeg"))
			{
				echo("
					<script>
						alert('JPG와 GIF만 업로드 가능합니다!');
						history.go(-1)
					</script>
					");
				exit;
			}

			if (!move_uploaded_file($upfile_tmp_name[$i], $uploaded_file[$i])) //임시파일경로+파일이름 //옮길경로 + 파일이름
																																				//새 위치로 파일을 옮김
			{
				echo("
					<script>
					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다');
					history.go(-1)
					</script>
				");
				exit;
				}else {
					echo "잘 들어갔습니다!";
				}
			}

				require_once "../lib/DBManager.php";
			   try{
					$db=connect();
					$title=$_POST['title'];
					$idsession=$_SESSION['ID_key_session'];
					$content=$_POST['content'];

					$sql = "insert into $table (b_title, b_content, b_writer, b_date,";
					$sql .= " file_name_0, file_name_1, file_name_2, file_copied_0,  file_copied_1, file_copied_2) ";
					$sql .= "values('$title', '$content', '$idsession', '$date',";
					$sql .= "'$upfile_name[0]', '$upfile_name[1]', '$upfile_name[2]', '$copied_file_name[0]', '$copied_file_name[1]','$copied_file_name[2]')";

					$stt=$db->prepare($sql,[PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL]);
			    $result = $stt->execute();
					$db=NULL;
				}catch(PDOException $e){
					echo $e->getMessage();
				}
					echo("
						<script>
							location.href='boardlistform.php?table={$table}';
						</script>
					");

?>
