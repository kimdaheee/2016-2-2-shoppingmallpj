<meta charset="utf-8">
<?php
  $hp = $_POST['hp1']."-".$_POST['hp2']."-".$_POST['hp3'];

  $user_joindate = date("Y-m-d (H:i:s)");

  require_once "../lib/DBManager.php";
  try{
    $db=connect();
    $sql = "insert into member1(user_name, user_birth, user_id, user_pw, use_addr,
              user_phone, user_gender, user_joindate
              ) ";
    $sql .="values(:user_name, :user_birth, :user_id, :user_passwd, :user_addr, :user_phone, :user_gender, :user_joindate) ";
    $stt=$db->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      $result=$stt->execute(
        array(
          ':user_name'=>$_POST['name'],
          ':user_birth'=>$_POST['birth'],
          ':user_id'=>$_POST['id'],
          ':user_passwd'=>$_POST['passwd'],
          ':user_addr'=>$_POST['address'],
          ':user_phone'=>$hp,
          ':user_gender'=>$_POST['gender'],
          ':user_joindate'=>$user_joindate
        )
      );
      $db=NULL;

    echo("
      <script>
      location.href='../main.php';
      </script>
    ");
  }catch(PDOException $e){
    exit("에러발생: {$e->getMessage()}");
  }
 ?>
