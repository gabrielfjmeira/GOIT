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
        <form id="formCadastroLojista" name="formCadastroLojista" action="insert_lojistaPHP.php" method="POST" onsubmit="return formCadastroLojistaOnSubmit();">
            <center>
                <h1>Cadastro de Lojista</h1>
                
                <label>Razão Social: </label>
                <input type="text" id="txtRazaoSocial" name="txtRazaoSocial" placeholder="Razão Social" class="input" required/><br><br>
                
                <label>Fantasia: </label>
                <input type="text" id="txtFantasia" name="txtFantasia" placeholder="Fantasia" class="input" required/><br><br>
                
                <label>CNPJ: </label>
                <input type="text" id="CNPJ" name="CNPJ" placeholder="CNPJ" onkeypress="MascaraParaCNPJ(this);" class="input" required/><br><br>                

                <label>Email: </label>
                <input type="text" id="txtEmail" name="txtEmail" placeholder="Email" class="input" required/><br><br>

                <label>Senha: </label>
                <input type="password" id="txtSenha" name="txtSenha" placeholder="Senha" class="input" required/><br><br>

                <label>Confirme sua Senha: </label>
                <input type="password" id="txtSenhaConfirmada" name="txtSenhaConfirmada" placeholder="Confirme sua Senha" class="input" required/><br><br>
                
                <p>
                    <label>Mostrar senha</label>
                    <input type="checkbox" onclick="mostrarSenha();"><br>
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