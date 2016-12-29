<?php
session_start();
$table="board";
 ?>
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link href="../css/main.css" rel="stylesheet" type="text/css" media="all">
      <link href="../css/top_logincs.css" rel="stylesheet" type="text/css" media="all">
      <link href="../css/top_menucs.css" rel="stylesheet" type="text/css" media="all">
      <link href="../css/boardlistformcs.css" rel="stylesheet" type="text/css" media="all">
   </head>
   <body>
      <div id="wrap">
         <div id="header">
            <?php require_once "../lib/top_logo2.php"; ?>
        </div>

      <div id="menu">
         <?php require_once "../lib/top_menu2.php"; ?>
      </div>
      <div class="clear"></div>

      <div id="list_top_title">
        <table width='1000px' height='300px' border='1px solid black'>
           <tr>
             <th width='100px' align='center'>글 번호</th>
             <th width='100px' align='center'>작성자</th>
             <th width='100px' align='center'>제목</th>
             <th width='100px' align='center'>작성일자</th>
           </tr>
   <?php
       require_once '../lib/DBManager.php';
       try{
         $db=connect();
         $sql="select * from $table order by b_no desc";
         $stt=$db->prepare($sql, [PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL]);
         $stt->execute();
         while($row=$stt->fetch(PDO::FETCH_ASSOC)){

          $item_num=$row['b_no'];
          $item_id=$row['b_writer'];
          $item_date=$row['b_date'];
          $item_date=substr($item_date, 0, 10);//날짜와 시간중에서 날짜만 나올 수 있게
          $item_title=str_replace(" ", "&nbsp;", $row ['b_title']);//b_title의 " "을 &nbsp;로 치환


           echo
               ("
                  <tr>
                    <td width='100px' align='center'>{$item_num}</td>
                    <td width='100px' align='center'>{$item_id}</td>
                    <td width='100px' align='center'><a href='view.php?table=$table&amp;num=$item_num&amp;'>{$item_title}</a></td>
                    <td width='100px' align='center'>{$item_date}</td>
                  </tr>

              ");

            }
          } catch(PDOException $e){
          exit("DB접속 불가:{$e->getMessage()}");
          }
          ?>
            </table>
            <div id="button">
              <a href="boardlistform.php?table=<?=$table?>">
              <img src="../img/list.png"></a>&nbsp;
              <?php
                if($_SESSION['ID_key_session'])
                {
               ?>
               <a href="write_form.php?table=<?=$table?>">
               <img src="../img/write.png"></a>
               <?php
                  }
                  $db=NULL;
                ?>
            </div>
        </div>
        </body>
      </html>
