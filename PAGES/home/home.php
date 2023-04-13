<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../index.php?error=4");
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
    <?php
        if ($_SESSION['TIPOUSUARIO'] == 1){
            include('../templates/headers/header_adm.html');
        } else{
            include('../templates/headers/header_users.html');
        }       

    ?>
    
</body>
</html>