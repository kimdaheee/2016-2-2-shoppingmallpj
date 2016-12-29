<?php
function connect(){
  $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=wd2j_db';
  $user = 'wd2j';
  $pass = '1234';

  try{

    $dbo= new PDO($dsn,$user,$pass);

  }catch(PDOException $e){
    exit("DB접속 불가:{$e->getMessage()}");
  }
  return $dbo;
}

?>
