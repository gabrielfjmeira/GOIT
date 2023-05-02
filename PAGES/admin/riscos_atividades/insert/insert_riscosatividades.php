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

    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body>
    <!--Cabeçalho-->
    <section class="header">
        <center>
            <h1>GO🐐IT | A Social Adventure</h1>
            <button onclick="window.location.href = '../riscosatividades.php'">
                Voltar ⬅
            </button> 
        </center>
    </section>

    <!--Formulário-->    
    <section class="form">
        <form id="formInsertRiscosAtividades" name="formInsertRiscosAtividades" action="insert_riscosatividadesPHP.php" method="POST" onsubmit="return formInsertRiscosAtividadesOnSubmit();">
            <center>
                <h1>Inserir Risco de Atividade</h1>
                
                <label>Descrição: </label>
                <input type="text" id="txtDescricao" name="txtDescricao" placeholder="Descricao" class="input" 
                pattern="^.{4,30}"
                title="Descrição deve ter no mínimo 5 e no máximo 30 caracteres!" required/><br><br>
                
                <label>Mínimo: </label>
                <input type="number" id="nbrMinimo" name="nbrMinimo" placeholder="Mínimo" class="input"
                pattern="^.[0-9]{1}?[0-9]{1}$"
                title="Mínimo deve ser um número de 0-10" required/><br><br>

                <label>Máximo: </label>
                <input type="number" id="nbrMaximo" name="nbrMaximo" placeholder="Máximo" class="input" 
                pattern="^.[0-9]{1}?[0-9]{1}$"
                title="Máximo deve ser um número de 0-10" required/><br><br>
                
                <label>Recomenda-se instrutor? </label>
                <select id="selInstrutor" name="selInstrutor" required>
                    <option value = 1 selected>Sim</option>
                    <option value = 0>Não</option>
                </select><br><br>

                <button type="submit">Inserir</button>                
            </center>
        </form>

        <!--Script-->        
        <script type="text/javascript" src="../../../../JAVASCRIPT/functions.js"></script>
    
</body>
</html>