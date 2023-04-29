<?php
    //Incluí conexão
    include('./CONNECTIONS/connection.php');     
    
    //Verifica se o Usuário está Logado
    if ($_SESSION['LOGGED'] == True){
        header ("Location: ./PAGES/home/home.php");
    }
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Configurações-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/loginCadastro.css">
    <link rel="stylesheet" href="./CSS/login.css">

    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body onload="formLogin.txtEmail.focus();">

    <!--Cabeçalho-->
    <header>
        <img src="./ASSETS/logoWhite.png" class = "logo" alt="Logo Go It">
        <h1>Login</h1> 
    </header>

    <!--Formulário de Login-->
    <section class="form">
        <form id="formLogin" class = "form" name="formLogin" action="./CONFIG/login/loginPHP.php" method="POST" onsubmit="return formLoginOnSubmit();">
        
            <div class="input-wrapper">
                <label>Usuário/e-mail: </label>         
                <input type="text"     name="txtEmail" id="txtEmail" placeholder="E-Mail" class="input" 
                pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" 
                title="Digite um email válido! Exemplo: email@email.com" required/>
            </div>

            <div class="input-wrapper">
                <label>Senha: </label>
                <input type="password" name="txtSenha" id="txtSenha" placeholder="Senha" class="input"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}" 
                title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e possuir no mínimo 8 caracteres e no máximo 20 caracteres" required/>
                <a href="#" id = "forget-password">Esqueci a senha</a>
            </div>

            <!-- <p>
                <label>Mostrar senha</label>                
                <input type="checkbox" onclick="mostrarSenhaLogin();"><br><br>
            </p> -->
            
            <button type="submit"> Entrar </button>
            <div class="wrapper-cadastrar-login">
                <p> Não possui login ainda?</p>
                <a href="./PAGES/usuarios/selecao_tipoUsuario.php">Cadastre-se aqui</a>
            </div>
            <?php
                if (isset($_GET['cadastrado'])){
                    $cadastrado = $_GET['cadastrado'];                        
                    if ($cadastrado == 1){                    
                        echo "<center><h4 class='advice'>Cadastro realizado com sucesso!</h4></center>";
                    }
                } else if (isset($_GET['error'])){
                    $error = $_GET['error'];

                    switch($error){                     
                        case 001:
                            echo "<center><h4 class='error'>Email não cadastrado!</h4></center>";
                            break;
                        case 002:
                            echo "<center><h4 class='error'>Senha incorreta!</h4></center>";
                            break;
                        case 003:
                            echo "<center><h4 class='error'>Cadastro em análise</h4></center>";
                            break;
                        case 004:
                            echo "<center><h4 class='error'>Realize o login para acessar a plataforma</h4></center>";
                            break;
                    }                    
                }        
            ?>
        
        </form>
    </section>     
    
    <!--Script-->
    <script type="text/javascript" src="./JAVASCRIPT/functions.js"></script>    
   
</body>
</html>