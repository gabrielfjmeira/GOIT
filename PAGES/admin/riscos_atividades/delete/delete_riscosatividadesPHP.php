<?php
    //Incluí Conexão
    include('../../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../../index.php?error=4");
    }

    //Verifica se é um Admin
    if ($_SESSION['TIPOUSUARIO'] != 1){
        header ("Location: ../../../home/home.php");
    }

    //Verifica se Recebeu um Código para Excluir
    if (isset($_GET['codigo'])){
        $codigo = $_GET['codigo'];
        
        $riscoAtividade = "SELECT * FROM TABRIS WHERE TABRIS_Codigo = $codigo";
        $queryRiscoAtividade = $mysqli->query($riscoAtividade) or die("Falha na execução do código sql" . $mysqli->error);

        if ($queryRiscoAtividade->num_rows == 1){

            $deleteRiscoAtividade = "DELETE FROM TABRIS WHERE TABRIS_Codigo = $codigo";
            $queryDeleteRiscoAtividade = $mysqli->query($deleteRiscoAtividade) or die("Falha na execução do código sql" . $mysqli->error);
            header ("Location: ../riscosatividades.php?excluido=1");

        }else{
            header ("Location: ../riscosatividades.php");
        }
        
    }else{
        header ("Location: ../riscosatividades.php");
    }    
?>