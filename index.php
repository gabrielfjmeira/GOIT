<?php
    //Incluí conexão
    include('./CONNECTIONS/connection.php');     
    
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Configurações-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
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
        <form id="formLogin" name="formLogin" action="./PAGES/login/loginPHP.php" method="POST" onsubmit="return formLoginOnSubmit();">
        
            <div class="input-wrapper">
                <label>Usuário/e-mail: </label>         
                <input type="text"     name="txtEmail" id="txtEmail" placeholder="E-Mail" class = "input" required/>
            </div>

            <div class="input-wrapper">
                <label>Senha: </label>
                <input type="password" name="txtSenha" id="txtSenha" placeholder="Senha" class = "input" required/>
                <a href="#" id = "forget-password">Esqueci a senha</a>
            </div>

            <!-- <p>
                <label>Mostrar senha</label>                
                <input type="checkbox" onclick="mostrarSenhaLogin();"><br><br>
            </p> -->
            
            <button type="submit"> Entrar </button>
            <div class="wrapper-cadastrar">
                <p> Não possui login ainda?</p>
                <a href="./PAGES/cadastros/selecao_tipoUsuario.php">Cadastre-se aqui</a>
            </div>
            <?php
                if (isset($_GET['cadastrado'])){
                    $cadastrado = $_GET['cadastrado'];                        
                    if ($cadastrado == 1){                    
                        echo "<h4 class='advice'>Cadastro realizado com sucesso!</h4>";
                    }else{
                        echo "<h4 class='advice'></h4>";
                    }
                } else if (isset($_GET['error'])){
                    $error = $_GET['error'];
                    if ($error == 001){
                        echo "<h4 class='error'>Email não cadastrado!</h4>";
                    }else if($error == 002) {
                        echo "<h4 class='error'>Senha incorreta!</h4>";
                    }else if($error == 003) {
                        echo "<h4 class='error'>Cadastro em análise</h4>";
                    }else if(){
                        echo "<h4 class='error'>Realize o login para acessar a plataforma</h4>";
                    }else{
                        echo "<h4 class='error'></h4>";
                    }
                }        
            ?>
        
        </form>
    </section>     
    
    <!--Script-->
    <script type="text/javascript" src="JAVASCRIPT\functions.js"></script>    
   
</body>
</html>