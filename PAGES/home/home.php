<?php
    //Incluí conexão
    include('../../CONNECTIONS/connection.php');     

    //Verifica se o Usuário está logado
    // if(!isset($_SESSION['CODIGO'])){
    //     header("Location: ../../CONNECTIONS/logout.php");
    //     echo "não logado";
    // }    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body>
    <h1>HOME</h1>
    <button onclick="window.location.href = '../../CONNECTIONS/logout.php';">
        LogOut ❌
    </button>
</body>
</html>