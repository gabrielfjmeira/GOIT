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

    //Carrega os Registros da Tabela de Tipos de Usuários
    $tiposUsuarios = "SELECT * FROM TIPUSU ORDER BY TIPUSU_Codigo ASC;";
    $queryTiposUsuarios = $mysqli->query( $tiposUsuarios);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Configurações-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body>
    
    <!--Cabeçalho-->    
    <header>        
        <h1>GERENCIAR TIPOS DE USUÁRIOS</h1>        
        <button onclick="window.location.href = '../admin.php';">
            Voltar ⬅
        </button>
    </header>


    
</body>
</html>