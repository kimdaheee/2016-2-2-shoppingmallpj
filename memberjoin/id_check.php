<meta charset="utf-8">
<?php
  if(!isset($_GET['id'])){
    echo "아이디를 입력하세요";
    }else{
      require_once "../lib/DBManager.php";
      try{
        $db = connect();
        $sql = "select * from member1 where user_id=:user_id";

        $stt=$db->prepare($sql,
          [PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL]
        );
        $stt->execute([
        ':user_id'=>$_GET['id']
        ]);

        $result=$stt->rowCount();
        if($result){
          echo "중복된 아이디임 <br/>";
        }else{
          echo "사용가능한 아이디임";
        }
        $db=NULL;

      }catch(PDOException $e){
        exit("에러발생 : {$e->getMessage()}");
    }
  }
 ?>
