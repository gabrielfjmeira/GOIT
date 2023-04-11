<?php
    //Incluí a conexão
    include('./CONNECTIONS/connection.php');

    //Verifica se o usuário está logado
    if(!isset($_SESSION['CODIGO'])){
        header("Location: ../../CONNECTIONS/logout.php");
    }
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
    <!--Conteúdo-->    
    <h1>HOME</h1>
    <button onclick="window.location.href = '../../CONNECTIONS/logout.php';">
        LogOut ❌
    </button>
</body>
</html>