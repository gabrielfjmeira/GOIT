<?php

    //Realiza Log-Out do usuário
   if(!isset($_SESSION)){
      session_start();
   }  

   session_destroy();

   header("Location: ../../index.php");

?>