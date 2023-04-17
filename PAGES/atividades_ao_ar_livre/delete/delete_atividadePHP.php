<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../index.php?error=4");
    }

    //Verifica se é um Admin
    if ($_SESSION['TIPOUSUARIO'] != 1){
        header ("Location: ../../home/home.php");
    }

    //Excluí a Atividade se Receber seu Código
    if (isset($_GET['codigo'])){
        $codigo = $_GET['codigo'];               
    
        $atividade = "SELECT * FROM TABATV WHERE TABATV_Codigo = $codigo";
        $queryAtividade = $mysqli->query($atividade) or die("Falha na execução do código sql" . $mysqli->error);

        if ($queryAtividade->num_rows == 1){

            $deleteAtividade = "DELETE FROM TABATV WHERE TABATV_Codigo = $codigo";
            $queryDeleteAtividade = $mysqli->query($deleteAtividade) or die("Falha na execução do código sql" . $mysqli->error);
            header ("Location: ../../home/home.php");

        }else{
            header ("Location: ../../home/home.php");
        }
        
    }else{
        header ("Location: ../../home/home.php");
    }    
?>