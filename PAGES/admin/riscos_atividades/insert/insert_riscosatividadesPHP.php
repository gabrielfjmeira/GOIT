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

    //Cria variáveis
    $descricao = $_POST['txtDescricao'];
    $minimo    = $_POST['nbrMinimo'];
    $maximo    = $_POST['nbrMaximo'];            
    $instrutor = $_POST['selInstrutor'];

    //insere no banco de dados
    $insertRiscosAtividades = "INSERT INTO TABRIS (TABRIS_Codigo, TABRIS_Descricao, TABRIS_Minimo, TABRIS_Maximo, TABRIS_Instrutor) VALUES (NULL, '$descricao', $minimo, $maximo, $instrutor)";
    $queryInsertRiscosAtividades = $mysqli->query($insertRiscosAtividades) or die("Falha na execução do código sql" . $mysqli->error); 
    
    //Redireciona para a Página de Gerenciamento de Riscos de Atividades
    header("Location: ../riscosatividades.php?inserido=1");
?>