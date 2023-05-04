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
    $risco     = $_POST['riscoAtividade'];
    
    //insere no banco de dados
    $insertCategoriasAtividades = "INSERT INTO CATATV (CATATV_Codigo, CATATV_Descricao, TABRIS_Codigo) VALUES (NULL, '$descricao', $risco)";
    $queryInsertCategoriasAtividades = $mysqli->query($insertCategoriasAtividades) or die("Falha na execução do código sql" . $mysqli->error); 
    
    //Redireciona para a Página de Gerenciamento de Categorias de Atividades ao Ar Livre
    header("Location: ../categoriasatividades.php?inserido=1");
?>