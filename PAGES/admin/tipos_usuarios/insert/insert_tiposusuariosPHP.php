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
    $admin     = $_POST['selAdmin'];               
    
    //insere no banco de dados
    $insertTipoUsuario = "INSERT INTO TIPUSU (TIPUSU_Codigo, TIPUSU_Descricao, TIPUSU_Administrador) VALUES (NULL, '$descricao', $admin)";
    $queryInsertTiposUsuarios = $mysqli->query($insertTipoUsuario) or die("Falha na execução do código sql" . $mysqli->error); 
    
    //Redireciona para a Página de Gerenciamento de Tipos de Usuários
    header("Location: ../tiposusuarios.php?inserido=1");
?>