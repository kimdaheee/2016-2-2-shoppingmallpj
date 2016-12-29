<?php
  session_start();
  $real_name=$_GET['real_name'];
  $show_name=$_GET['show_name'];

	if(!$_SESSION['ID_key_session']) {
		echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.')
	     history.go(-1)
	   </script>
		");
		exit;
	}
    $file_path = "../data/".$real_name;

    if( file_exists($file_path))//파일이나 디렉토리가 존재하는지
    {
		   if($fp = fopen($file_path,"rb")){//파일을 염
       //첫번째 인자값에 파일이 존재한다면 파일을 헤더에서 읽을 수 있는 값으로 저장
       //실패시 거짓 에러 반환

				Header("Content-type: application/x-msdownload");//다운로드할 컨텐트의 타입
        Header("Content-Disposition: attachment; filename=$show_name"); //서버에서 클라이언트로 정보 전달 전송하려는 파일 네임이 쇼 파일네임이됨
        Header("Content-Transfer-Encoding: binary");//전송방식 바이너리
				Header("Content-Description: File Transfer");//서버가 클라이언트에게 전송하는 정보다

        header("Expires: 0"); //캐시 없애줌
}


			if(!fpassthru($fp))//현재 위치에서 주어진 파일 포인터를 끝까지 읽고 출력
				fclose($fp);//파일 포인터를 닫음
	}
?>
