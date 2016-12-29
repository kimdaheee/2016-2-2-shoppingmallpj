<?php
session_start();
require_once '../lib/DBManager.php';
  try{
    $db=connect();

      if(isset($_POST['mode'])&&$_POST['mode']=="insert"){
      $stt = $db->prepare("select * from member1;");
      $stt->execute();

      $userid = isset($_POST['id'])?$_POST['id']:"";
      $userpw = isset($_POST['passwd'])?$_POST['passwd']:"";

      while($row=$stt->fetch(PDO::FETCH_ASSOC))
      {
        if($row['user_id']==$userid && $row['user_pw']==$userpw){
        $sessionID=$row['user_id'];
        $sessionPW=$row['user_pw'];
          }
        }
        if(isset($sessionID)){
          $_SESSION['ID_key_session']=$sessionID;
          Header("Location: ../main.php");
        }else{
          echo "아이디나 비밀번호를 확인해주세요";
        }
      }
    } catch(PDOException $e){
      exit("DB접속 불가:{$e->getMessage()}");
    }
  $db=null;
 ?>
