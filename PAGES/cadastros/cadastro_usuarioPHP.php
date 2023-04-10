<?php

    include('../../CONNECTIONS/connection.php');

    if(!isset($_POST['tipusu_Codigo'])){
        $tipo_usuario    = $_POST['tipoUsuario'];        

        if($tipo_usuario == 2){            
            header("Location: ./cadastro_praticante.php");            
        } else if($tipo_usuario == 3){
            header("Location: ./cadastro_instrutor.php");
        } else{
            header("Location: ./cadastro_lojista.php");
        }
    }

?>