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
    <link rel="stylesheet" href="../../../CSS/loginCadastro.css">
    <link rel="stylesheet" href="../../../CSS/cadastro.css">


    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body>
    <!--Cabeçalho-->
    <header>
        <img src="../../../ASSETS/logoWhite.png" class = "logo" alt="Logo Go It">
        <h1>Cadastro</h1> 
    </header>

    <!--Formulário-->
    <form id="formCadastroPraticante" class ="form" name="formCadastroPraticante" action="insert_praticantePHP.php" method="POST" onsubmit="return formCadastroPraticanteOnSubmit();">
            
        <div class="input-wrapper">
            <label>Nome: </label>
            <input type="text" id="txtNome" name="txtNome" placeholder="Nome" class="input" 
            pattern="^.{8,}$" 
            title="Nome deve possuir no mínimo 8 caracteres e no máximo 100 caracteres!" required/>
        </div>

        <div class="input-wrapper">
            <label>Apelido: </label>
            <input type="text" id="txtApelido" name="txtApelido" placeholder="Apelido" class="input" 
            pattern="^.{4,30}$" 
            title="Apelido deve possuir no mínimo 4 caracteres e no máximo 30 caracteres!" required/>            
        </div>

        <?php

            $error = $_GET['error'];

            if ($error == 001){
                echo "<p class='error'>Apelido já está sendo utilizado.</p><br>"; 
            }
            // else{
            //     echo "<p class='error'></p>";
            // }      
        ?>

        <div class="input-wrapper">
            <label>Data de Nascimento: </label>
            <input type="date" id="dataNascimento" name="dataNascimento" placeholder="Data de Nascimento" class="input" 
            pattern="^[0-9]{2}-[0-9]{2}-[0-9]{4}$"
            title="dd/mm/aaaa" onchange=""  required />
            <small id="errordataNascimento" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
        </div>
        
        <div class="input-wrapper">
            <label>Sexo:</label>
                <div class = "input-sexo">
                    <div class="input-radio">
                        <input type="radio" id="sexo_m" name="sexo" value="0" required>
                        <label>Masculino</label>
                    </div>

                    <div class="input-radio">
                        <input type="radio" id="sexo_f" name="sexo" value="1" required>
                        <label>Feminino</label>
                    </div>

                    <div class="input-radio">
                        <input type="radio" id="sexo_o" name="sexo" value="2" required>
                        <label>Outro</label>
                    </div>
                </div>
        </div>

        <div class="input-wrapper">
            <label>Email: </label>
            <input type="text" id="txtEmail" name="txtEmail" placeholder="Email" class="input" 
            pattern="^[\w*\.]+@([\w-]+\.)+[\w-]{2,4}$" 
            title="Digite um email válido! Exemplo: email@email.com" required/> 
        </div>

        <div class="input-wrapper">
            <label>Senha: </label>
            <input type="password" id="txtSenha" name="txtSenha" placeholder="Senha" class="input" 
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}" 
            title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e possuir no mínimo 8 caracteres e no máximo 20 caracteres" required/>
        </div>

        <div class="input-wrapper">
            <label>Confirme sua Senha: </label>
            <input type="password" id="txtSenhaConfirmada" name="txtSenhaConfirmada" placeholder="Confirme sua Senha" class="input" 
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}" 
            title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e possuir no mínimo 8 caracteres e no máximo 20 caracteres" required/>
            <small id="errorSenhas" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
        </div>

        <div class = "show-password">
            <label>Mostrar senha</label>                
            <input type="checkbox" onclick="mostrarSenha();">
        </div>

        <button type="submit"> Cadastrar </button>

        <div class="wrapper-cadastrar-login">
            <p>Já possui cadastro?</p>
            <a href="../../../index.php">Login aqui</a>
        </div>

    </form>

        <!--Script-->        
        <script type="text/javascript" src="../../../JAVASCRIPT/functions.js"></script>
        
</body>
</html>