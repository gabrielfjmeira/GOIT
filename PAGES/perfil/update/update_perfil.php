<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../index.php?error=4");
    }
    
    //Redireciona para a página de edição de perfil de usuários
    switch($_SESSION['TIPOUSUARIO']){                            
        //Praticante
        case 2:
            header ("Location: ../../usuarios/praticante/update_praticante.php");
            break;                        
        //Instrutor                        
        case 3:
            header ("Location: ../../usuarios/instrutor/update_instrutor.php");
            break;                        
        //Lojista
        case 4:
            header ("Location: ../../usuarios/lojista/update_lojista.php");
            break;                        
    }
   
?>