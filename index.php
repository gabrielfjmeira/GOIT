<?php
    //Incluí conexão
    include('./CONNECTIONS/connection.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Configurações-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/style.css">

    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body onload="formLogin.txtEmail.focus();">

    <!--Cabeçalho-->
    <section class="header">
        <center>
            <h1>GO🐐IT | A Social Adventure</h1>
        </center>
    </section>

    <!--Formulário de Login-->
    <section class="form">
        <form id="formLogin" name="formLogin" action="./PAGES/login/loginPHP.php" method="POST" onsubmit="return formLoginOnSubmit();">
            <center>
                <h1>Login</h1>
                <input type="text"     name="txtEmail" id="txtEmail" placeholder="Email" class = "input" required/>
                <input type="password" name="txtSenha" id="txtSenha" placeholder="Senha" class = "input" required/>
                <button type="submit"> Entrar </button>
                <p> Não tem cadastro? <a href="./PAGES/cadastros/selecao_tipoUsuario.php">Cadastre-se</a></p> 
            </center>
        </form>
    </section> 
    
    <!--Impressão de Erros Recebidos via GET-->
    <section>
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
                if ($error == 1){
                    echo "<h4 class='error'>Email não cadastrado!</h4>";
                }else if($error == 2) {
                    echo "<h4 class='error'>Senha incorreta!</h4>";
                }else{
                    echo "<h4 class='error'></h4>";
                }
            }        
        ?>
    </section>

    <!--Script-->
    <script type="text/javascript" src="./JAVASCRIPT/functions.js"></script>
   
</body>
</html>