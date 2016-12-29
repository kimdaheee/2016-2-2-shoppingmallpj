<?
 session_start();
?>
<html>
<head>
<meta charset="utf-8">
<link href="../css/main.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/top_logincs.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/top_menucs.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/joinmember.css" rel="stylesheet" type="text/css" media="all">
<script>

  function check_id()
  {
    window.open("id_check.php?id=" + document.join_form3.id.value);
  }


  function check_input()
  {

    if (!document.join_form3.name.value)
    {
        alert("이름을 입력하세요");
        document.join_form3.name.focus();
        return;
    }

     if (!document.join_form3.id.value)
     {
         alert("아이디를 입력하세요");
         document.join_form3.id.focus();//커서가 깜빡거리는 상태
         return;
     }

     if (!document.join_form3.passwd.value)
     {
         alert("비밀번호를 입력하세요");
         document.join_form3.passwd.focus();
         return;
     }

     if (!document.join_form3.passwd_confirm.value)
     {
         alert("비밀번호 확인을 입력하세요");
         document.join_form3.passwd_confirm.focus();
         return;
     }

     if (!document.join_form3.address.value)
     {
         alert("주소를 입력하세요");
         document.join_form3.address.focus();
         return;
     }

     if (!document.join_form3.hp2.value || !document.join_form3.hp3.value )
     {
         alert("휴대폰 번호를 입력하세요");
         document.join_form3.address.focus();
         //포커스를 바로 주지 않기 때문에 제일 가까운 닉에다가 커서를 놓음
         return;
     }

     if (document.join_form3.passwd.value !=
           document.join_form3.passwd_confirm.value)
     {
         alert("비밀번호가 일치하지 않습니다.\n 다시 입력해주세요");
         document.join_form3.passwd.focus();
         document.join_form3.passwd.select();
         //select: 입력한 비밀번호가 틀릴 경우 입력된 값이 다 지워짐
         return;
     }

     document.join_form3.submit();
  }

  function reset_form()
  {
     document.join_form3.name.value = "";
     document.join_form3.id.value = "";
     document.join_form3.passwd.value = "";
     document.join_form3.passwd_confirm.value = "";
     document.join_form3.birth.value = "";
     document.join_form3.address.value = "";
     document.join_form3.hp1.value = "010";
     document.join_form3.hp2.value = "";
     document.join_form3.hp3.value = "";
     document.join_form3.id.focus();

     return;
  }
</script>
</head>

<body>
  <div id="wrap">
   <div id="header">
     <?php include "../lib/top_logo2.php"; ?>
   </div>

   <div id="menu">
   <?php include "../lib/top_menu2.php"; ?>
   </div>

   <div id="content">
         <form  name="join_form3" method="post" action="joininsert.php">
         <table  border="1" width="640" cellspacing="1" cellpadding="4">
      <tr>
        <td align="right" > * 이름 :</td>
       <td><input type="text" size="15" maxlength="12" name="name"></td>
      </tr>
      <tr>
        <td align="right">* 아이디 :</td>
        <td><input type="text" size="15" maxlength="12" name="id">
          <div id="id2"><a href="#"><img src="../img/check_id.gif" onclick="check_id()"></a></div>
        <div id="id3">4~12자의 영문 소문자, 숫자와 특수기호(_)만 사용할 수 있습니다.</div>
        </td>
      </tr>
      <tr>
        <td align="right"> * 비밀번호 :</td>
        <td><input type="password" size="15" maxlength="10" name="passwd"></td>
      </tr>
      <tr>
        <td align="right"> * 비밀번호 확인 :</td>
        <td><input type="password" size="15" maxlength="12" name="passwd_confirm"></td>
      </tr>
      <tr>
        <td align="right"> * 성별 :</td>
        <td><input type="radio" name="gender" value="M" checked>남
            <input type="radio" name="gender" value="F">여</td>
      </tr>
      <tr>
        <td align="right"> * 생년월일 :</td>
        <td><input type="text" size="20" name="birth">
      </tr>
      <tr>
        <td align="right"> * 휴대폰 :</td>
        <td><select class="hp" name="hp1">
              <option value='010'>010</option>
              <option value='011'>011</option>
              <option value='016'>016</option>
              <option value='017'>017</option>
              <option value='018'>018</option>
              <option value='019'>019</option>
            </select> - <input type="text" class="hp" name="hp2"> - <input type="text" class="hp" name="hp3"></td>
      </tr>
      <tr>
        <td align="right"> * 주소 :</td>
        <td><input type="text" size="50" name="address"></td>
      </tr>
      </table>
      </div>
     <div class="clear" style="background:red"></div>
     <div id="must"> * 는 필수로 입력해주십시오.<br/><br/>

       <a href="#"><img src="../img/button_save.gif"  onclick="check_input()"></a>&nbsp;&nbsp;
       <a href="#"><img src="../img/button_reset.gif" onclick="reset_form()"></a>
     </div>
   </form>
 </div>
</div>
</body>
</html>
