<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Rediriciona o Usuário para sua Página de Cadastro
    if ($_SESSION['TIPOUSUARIO'] == 4){
        if(isset($_POST['tipo_pub'])){
            $tipoPub    = $_POST['tipo_pub'];        
    
            if($tipoPub == 0){            
                header("Location: ../atividades_ao_ar_livre/insert/insert_atividade.php");            
            } else{
                header("Location: ../anuncios/anuncio_insert.php");
            } 
        }else{
            header("Location: ../perfil/perfil.php");
        }
    }else{
        header("Location: ../home/home.php");
    }
?>