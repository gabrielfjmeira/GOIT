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
    <form id="formCadastroLojista" name="formCadastroLojista" class="form" action="insert_lojistaPHP.php" method="POST" onsubmit="return formCadastroLojistaOnSubmit();">
        
        <div class="input-wrapper">
            <label>Razão Social: </label>
            <input type="text" id="txtRazaoSocial" name="txtRazaoSocial" placeholder="Razão Social" class="input" required/>
        </div>

        <div class="input-wrapper">    
            <label>Fantasia: </label>
            <input type="text" id="txtFantasia" name="txtFantasia" placeholder="Fantasia" class="input" required/>
        </div>

        <div class="input-wrapper">
            <label>CNPJ: </label>
            <input type="text" id="CNPJ" name="CNPJ" placeholder="CNPJ" onkeypress="MascaraParaCNPJ(this);" class="input" required/>               
        </div>

        <div class="input-wrapper">    
            <label>Email: </label>
            <input type="text" id="txtEmail" name="txtEmail" placeholder="Email" class="input" required/>
        </div>
        
        <div class="input-wrapper">
            <label>Senha: </label>
            <input type="password" id="txtSenha" name="txtSenha" placeholder="Senha" class="input" required/>
        </div>

        <div class="input-wrapper">
            <label>Confirme sua Senha: </label>
            <input type="password" id="txtSenhaConfirmada" name="txtSenhaConfirmada" placeholder="Confirme sua Senha" class="input" required/>
        </div>

        <div class = "show-password">
            <label>Mostrar senha</label>
            <input type="checkbox" onclick="mostrarSenha();">
        </div>                

        <button type="submit"> Cadastrar </button>
        
        <div class="wrapper-cadastrar-login">
            <p>Já possuí cadastro?</p> 
            <a href="../../../index.php">Login aqui</a>
        </div>
        
    </form>

        <!--Script-->
        <script type="text/javascript" src="../../../JAVASCRIPT/functions.js"></script>
</body>
</html>