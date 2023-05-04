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

        //Deleta solicitação de acesso negadas
        if($tipo == 1){
            $deleteInstrutorNaoVerificado = "DELETE FROM TABINS WHERE TABUSU_Codigo = $codigo;";        
            $queryDeleteInstrutorNaoVerificado = $mysqli->query($deleteInstrutorNaoVerificado) or die("Falha na execução do código sql" . $mysqli->error); 
        }else{
            $deleteLojistaNaoVerificado = "DELETE FROM TABLOJ WHERE TABUSU_Codigo = $codigo;";
            $queryDeleteLojistaNaoVerificado = $mysqli->query($deleteLojistaNaoVerificado) or die("Falha na execução do código sql" . $mysqli->error); 
        }

        $deleteUser = "DELETE FROM TABUSU WHERE TABUSU_Codigo = $codigo;";
        $queryDeleteUser = $mysqli->query($deleteUser) or die("Falha na execução do código sql" . $mysqli->error); 
        
        //Redireciona para a Página de Gerenciamento de Acesso
        header("Location: ./delegaracesso.php?negado=1");
    }else{
        //Redireciona para a Página de Gerenciamento de Acesso
        header("Location: ./delegaracesso.php");
    }

?>