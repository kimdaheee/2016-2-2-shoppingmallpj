<?php
   session_start();
   try{
   require_once "../lib/DBManager.php";

   $db=connect();
   $table=$_GET['table'];
   $num=$_GET['num'];
   $sql = "delete from $table where b_no = $num";
   $stt=$db->prepare($sql,[PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL]);
   $result = $stt->execute();
   $row = $stt->fetch(PDO::FETCH_ASSOC);

   $copied_name[0] = $row['file_copied_0'];
   $copied_name[1] = $row['file_copied_1'];
   $copied_name[2] = $row['file_copied_2'];

   for ($i=0; $i<3; $i++)
   {
    if ($copied_name[$i])
     {
      $image_name = "../data/".$copied_name[$i];
      unlink($image_name);
     }
   }

   } catch(PDOException $e){
     exit("DB접속 불가:{$e->getMessage()}");
   }
   $db=null;

   echo "
     <script>
      location.href = 'boardlistform.php?table={$table}';
     </script>
   ";


?>
