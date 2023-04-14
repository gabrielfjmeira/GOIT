<?php
    //Incluí conexão
    include('../../../CONNECTIONS/connection.php');     

    //Verifica se o Usuário está Logado
    if ($_SESSION['LOGGED'] == True){
        header ("Location: ../../home/home.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Configurações-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../CSS/style.css">

    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body>
    <!--Cabeçalho-->
    <section class="header">
        <center>
            <h1>GO🐐IT | A Social Adventure</h1>
            <button onclick="window.location.href = '../selecao_tipoUsuario.php'">
                Voltar ⬅
            </button> 
        </center>
    </section>

    <!--Formulário-->
    <section class="form">
        <form id="formCadastroPraticante" name="formCadastroPraticante" action="insert_praticantePHP.php" method="POST" onsubmit="return formCadastroPraticanteOnSubmit();">
            <center>
                <h1>Cadastro de Praticante</h1>
                
                <label>Nome: </label>
                <input type="text" id="txtNome" name="txtNome" placeholder="Nome" class="input" required/><br><br>
                
                <label>Apelido: </label>
                <input type="text" id="txtApelido" name="txtApelido" placeholder="Apelido" class="input" required/>
                <?php

                    $error = $_GET['error'];

                    if ($error == 001){
                        echo "<p class='error'>Apelido já está sendo utilizado.</p><br>"; 
                    }else{
                        echo "<p class='error'></p><br>";
                    }                
                ?>
                <label>Data de Nascimento: </label>
                <input type="date" id="dataNascimento" name="dataNascimento" placeholder="Data de Nascimento" class="input" required/><br><br>

                <label>Sexo:</label>
                <input type="radio" id="sexo_m" name="sexo" value="0" required>
                <label>Masculino</label>
                <input type="radio" id="sexo_f" name="sexo" value="1" required>
                <label>Feminino</label>
                <input type="radio" id="sexo_o" name="sexo" value="2" required>
                <label>Outro</label><br><br>

                <label>Email: </label>
                <input type="text" id="txtEmail" name="txtEmail" placeholder="Email" class="input" required/><br><br>

                <label>Senha: </label>
                <input type="password" id="txtSenha" name="txtSenha" placeholder="Senha" class="input" required/><br><br>

                <label>Confirme sua Senha: </label>
                <input type="password" id="txtSenhaConfirmada" name="txtSenhaConfirmada" placeholder="Confirme sua Senha" class="input" required/><br><br>

                <p>
                    <label>Mostrar senha</label>                
                    <input type="checkbox" onclick="mostrarSenha();"><br><br>
                </p>

                <button type="submit"> Cadastrar </button>
                <p> Já possuí Login? <a href="../../index.html">Realizar Login</a></p> 
            </center>
        </form>

        <!--Script-->        
        <script type="text/javascript" src="../../../JAVASCRIPT/functions.js"></script>
        
    </section>
</body>
</html>