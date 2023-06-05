<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Verifica se o Usuário está Logado
    if ($_SESSION['LOGGED'] == True){
        header ("Location: ../PAGES/home/home.php");
    }

    //Rediriciona o Usuário para sua Página de Cadastro
    if(!isset($_POST['tipusu_Codigo'])){
        $tipo_usuario    = $_POST['tipoUsuario'];        

        if($tipo_usuario == 2){            
            header("Location: ./praticante/cadastro_praticante.php");            
        } else if($tipo_usuario == 3){
            header("Location: ./instrutor/cadastro_instrutor.php");
        } else{
            header("Location: ./lojista/cadastro_lojista.php");
        }
    }

?>