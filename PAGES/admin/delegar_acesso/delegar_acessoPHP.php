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

    //Update no Banco de Dados
    if (isset($_GET['codigo']) && isset($_GET['tipo'])){
        //Definição de Variáveis    
        $codigo = $_GET['codigo'];      
        $tipo = $_GET['tipo'];

        if($tipo == 1){
            $updateInstrutorNaoVerificado = "UPDATE TABINS SET TABINS_Verificado= 1 WHERE TABUSU_Codigo = $codigo;";
            $queryUpdateInstrutorNaoVerificado = $mysqli->query($updateInstrutorNaoVerificado) or die("Falha na execução do código sql" . $mysqli->error); 
        }else{
            $updateLojistaNaoVerificado = "UPDATE TABLOJ SET TABLOJ_Verificado= 1 WHERE TABUSU_Codigo = $codigo;";
            $queryUpdateLojistaNaoVerificado = $mysqli->query($updateLojistaNaoVerificado) or die("Falha na execução do código sql" . $mysqli->error); 
        }

        //Redireciona para a Página de Gerenciamento de Acesso
        header("Location: ./delegaracesso.php?delegado=1");
    } else{
        //Redireciona para a Página de Gerenciamento de Acesso
        header("Location: ./delegaracesso.php");
    }   
    
?>