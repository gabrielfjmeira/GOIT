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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Configurações-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../../ASSETS/icon.ico"/>

    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body>
    <!--Cabeçalho-->
    <section class="header">
        <center>
            <h1>GO🐐IT | A Social Adventure</h1>
            <button onclick="window.location.href = '../tiposusuarios.php'">
                Voltar ⬅
            </button> 
        </center>
    </section>

    <!--Formulário-->    
    <section class="form">
        <form id="formInsertTiposUsuarios" name="formInsertTiposUsuarios" action="insert_tiposusuariosPHP.php" method="POST" onsubmit="return formInsertTiposUsuariosOnSubmit();">
            <center>
                <h1>Inserir Tipo de Usuário</h1>
                
                <label>Descrição: </label>
                <input type="text" id="txtDescricao" name="txtDescricao" placeholder="Descricao" class="input" 
                pattern="^.{5,13}"
                title="Descrição deve ter no mínimo 5 e no máximo 13 caracteres!" required/><br><br>                
                                
                <label>Administrador? </label>
                <select id="selAdmin" name="selAdmin" required>
                    <option value = 1>Sim</option>
                    <option value = 0 selected>Não</option>
                </select><br><br>

                <button type="submit">Inserir</button>                
            </center>
        </form>
    </section>        
    
</body>
</html>