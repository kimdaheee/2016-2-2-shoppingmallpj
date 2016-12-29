<?php
session_start();
unset($_SESSION['ID_key_session']);

Header("Location: ../main.php");
 ?>
