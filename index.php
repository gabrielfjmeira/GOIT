<?php
    //Incluí conexão
    include('./CONNECTIONS/connection.php');     
    
    // //Verifica se o Usuário está Logado
    // if ($_SESSION['LOGGED'] == True){
    //     header ("Location: ./PAGES/home/home.php");
    // }
    
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
    <link rel="icon" href="./ASSETS/icon.ico"/>

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
                <label>E-mail</label>         
                <input type="text"     name="txtEmail" id="txtEmail" placeholder="E-Mail" class="input" 
                pattern="^[\w*\.]+@([\w-]+\.)+[\w-]{2,4}$" 
                title="Digite um email válido! Exemplo: email@email.com" required/>
                <small id="errorEmail" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
            </div>

            <div class="input-wrapper">
                <label>Senha</label>
                <input type="password" name="txtSenha" id="txtSenha" placeholder="Senha" class="input"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}" 
                title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e possuir no mínimo 8 caracteres e no máximo 20 caracteres" required/>
                <small id="errorSenha" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
                <a href="#" id = "forget-password">Esqueci a senha</a>                
            </div>

        <!--Imprime Erros se Houver-->
        <?php
            if(isset($_GET['error'])){                
                $error = $_GET['error'];                
                switch ($error){
                    case 001:?>
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                                  
                            
                            txtEmail.style.border = "1px solid #DB5A5A"; 
                            errorEmail.style.color = "#DB5A5A";                           
                            errorEmail.innerHTML = "Email não cadastrado!";   
                            txtEmail.focus();                                                                        
                        </script>
                        <?php
                        break;
                    case 002:?>
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtSenha = document.getElementById('txtSenha');                            
                            let errorSenha = document.getElementById('errorSenha');                                                                                                                  
                            
                            txtSenha.style.border = "1px solid #DB5A5A";  
                            errorSenha.style.color = "#DB5A5A";                          
                            errorSenha.innerHTML = "Senha incorreta!";                                                                       
                            txtSenha.focus();    
                        </script>
                        <?php
                        break;  
                    case 003:?>
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtEmail = document.getElementById('txtEmail');                                                        
                            let txtSenha = document.getElementById('txtSenha');                            
                            let errorSenha = document.getElementById('errorSenha');                                                                                                                 
                            
                            txtEmail.style.border = "1px solid #c29a17";                            
                            txtSenha.style.border = "1px solid #c29a17";
                            errorSenha.style.color = "#c29a17";
                            errorSenha.innerHTML = "Cadastro em análise!";                                                                       
                            txtEmail.focus();    
                        </script>
                        <?php
                        break; 
                    case 004:?>
                        <script type="text/javascript">
                            alert("Realize o login para acessar a plataforma!");                            
                        </script>
                        <?php
                        break;
                    case 005:
                        $usuario = $_GET['codigousuario'];
                        $tipoUsuario = $_GET['tipo'];
                        ?>
                        <script>
                            let text = "Cadastro foi negado após análise.\nDeseja enviar o cadastro para uma nova análise?";
                            if (confirm(text) == true) {
                                location.href = "./solicitar_analisePHP.php?usuario="+<?php echo $usuario;?>+"&tipo="+<?php echo $tipoUsuario;?>;
                            }  
                        </script>
                    <?php                                    
                        break;
                }
            }
        ?>

            <!-- <p>
                <label>Mostrar senha</label>                
                <input type="checkbox" onclick="mostrarSenhaLogin();"><br><br>
            </p> -->
            
            <button type="submit"> Entrar </button>
            <div class="wrapper-cadastrar-login">
                <p> Não possui login ainda?</p>
                <a href="./PAGES/usuarios/selecao_tipoUsuario.php">Cadastre-se aqui</a>
            </div>                      
        
        </form>
    </section>     
    
    <!--Script-->
    <script type="text/javascript" src="./JAVASCRIPT/functions.js"></script>    
   
</body>
</html>