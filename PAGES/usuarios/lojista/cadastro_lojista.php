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

    <button onclick="window.history.back()" id = "buttonBack">
        <img src="../../../ASSETS/backWhite.svg" alt="Back button" style="cursor: pointer;">
    </button> 

    <!--Cabeçalho-->
    <header>
        <img src="../../../ASSETS/logoWhite.png" class = "logo" alt="Logo Go It">
        <h1>Cadastro</h1> 
    </header>

    <!--Formulário-->
    <form id="formCadastroLojista" name="formCadastroLojista" class="form" action="insert_lojistaPHP.php" method="POST" onsubmit="return formCadastroLojistaOnSubmit();">
        
        <div class="input-wrapper">
            <label>Razão Social*</label>
            <input type="text" id="txtRazaoSocial" name="txtRazaoSocial" placeholder="Razão Social" class="input" 
            pattern="^[A-Z][a-z]+[\s]*(([A-Z]||[a-z])[a-z]{1,}[\s]*){0,}$" 
            title="Razão Social só deve conter letras e deve possuir no mínimo 3 caracteres e no máximo 100 caracteres" required/>
            <small id="errorRazaoSocial" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
        </div>

        <div class="input-wrapper">    
            <label>Fantasia*</label>
            <input type="text" id="txtFantasia" name="txtFantasia" placeholder="Fantasia" class="input" 
            pattern="^[A-z]\w{3,29}$" 
            title="Fantasia deve começar com uma letra e não pode conter símbolos, deve possuir no mínimo 4 caracteres e no máximo 30 caracteres!" required/>
            <small id="errorFantasia" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
        </div>

        <div class="input-wrapper">
            <label>CNPJ*</label>
            <input type="text" id="txtCNPJ" name="txtCNPJ" placeholder="Formato: ##############" class="input" 
            pattern="^[0-9]{14}$" 
            title="CNPJ deve possuir 14 dígitos: ##############" required/>      
            <small id="errorCNPJ" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>                     
        </div>        

        <div class="input-wrapper">    
            <label>Email*</label>
            <input type="text" id="txtEmail" name="txtEmail" placeholder="Email" class="input" 
            pattern="^[\w*\.]+@([\w-]+\.)+[\w-]{2,4}$" 
            title="Digite um email válido! Exemplo: email@email.com" required/>
            <small id="errorEmail" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>        
        </div>

        <!--Imprime Erros se Houver-->
        <?php
            if(isset($_GET['error'])){
                $error = $_GET['error'];
                switch ($error){
                    case 001:?>
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtFantasia = document.getElementById('txtFantasia');                            
                            let errorFantasia = document.getElementById('errorFantasia');                                                                                                                  
                            
                            txtFantasia.style.border = "1px solid #DB5A5A";                            
                            errorFantasia.innerHTML = "Fantasia já cadastrada!";   
                            txtFantasia.focus();                                                                        
                        </script>
                        <?php
                        break;
                    case 002:?>
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtCNPJ = document.getElementById('txtCNPJ');                            
                            let errorCNPJ = document.getElementById('errorCNPJ');                                                                                                                  
                            
                            txtCNPJ.style.border = "1px solid #DB5A5A";                            
                            errorCNPJ.innerHTML = "CNPJ já cadastrado!";                                                                       
                            txtCNPJ.focus();    
                        </script>
                        <?php
                        break;  
                    case 003:?>
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                                  
                            
                            txtEmail.style.border = "1px solid #DB5A5A";                            
                            errorEmail.innerHTML = "Email já cadastrado!";                                                                       
                            txtEmail.focus();    
                        </script>
                        <?php
                        break;                            
                                    
                }
            }
        ?>
        
        <div class="input-wrapper">
            <label>Senha*</label>
            <input type="password" id="txtSenha" name="txtSenha" placeholder="Senha" class="input" 
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}" 
            title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e possuir no mínimo 8 caracteres e no máximo 20 caracteres" required/>
        </div>

        <div class="input-wrapper">
            <label>Confirme sua Senha*</label>
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
            <p>Já possuí cadastro?</p> 
            <a href="../../../index.php">Login aqui</a>
        </div>
        
    </form>

        <!--Script-->
        <script type="text/javascript" src="../../../JAVASCRIPT/functions.js"></script>
</body>
</html>