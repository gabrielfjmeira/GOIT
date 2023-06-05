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
    <link rel="icon" href="../../../ASSETS/icon.ico"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body>

    <button onclick="location.href='../selecao_tipoUsuario.php'" id = "buttonBack">
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
                <?php 
                    if(isset($_GET['razaoSocial'])){?>
                        value="<?php echo $_GET['razaoSocial'];?>"                        
                        <?php
                    }       
                ?>  
            pattern="^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]{8,100}$" 
            title="Razão Social só deve conter letras e deve possuir no mínimo 8 caracteres e no máximo 100 caracteres" required/>
            <small id="errorRazaoSocial" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
        </div>

        <div class="input-wrapper">    
            <label>Fantasia*</label>
            <input type="text" id="txtFantasia" name="txtFantasia" placeholder="Fantasia" class="input" onchange="verificaApelido();"
                <?php 
                    if(isset($_GET['fantasia'])){?>
                        value="<?php echo $_GET['fantasia'];?>"                        
                        <?php
                    }       
                ?>
            pattern="^[A-z]\w{3,29}$" 
            title="Fantasia deve começar com uma letra e não pode conter símbolos, deve possuir no mínimo 4 caracteres e no máximo 30 caracteres!" required/>
            <small id="errorFantasia" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
        </div>

        <div class="input-wrapper">
            <label>CNPJ*</label>
            <input type="text" id="txtCNPJ" name="txtCNPJ" placeholder="Formato: ##############" class="input" onchange="verificaCNPJ();"
                <?php 
                    if(isset($_GET['cnpj'])){?>
                        value="<?php echo $_GET['cnpj'];?>"                        
                        <?php
                    }       
                ?>
            pattern="^[0-9]{14}$" 
            title="CNPJ deve possuir 14 dígitos: ##############" required/>      
            <small id="errorCNPJ" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>                     
        </div>        

        <div class="input-wrapper">    
            <label>Email*</label>
            <input type="text" id="txtEmail" name="txtEmail" placeholder="Email" class="input" onchange="verificaEmail();"
                <?php 
                    if(isset($_GET['email'])){?>
                        value="<?php echo $_GET['email'];?>"                        
                        <?php
                    }       
                ?>
            pattern="^[\w*\.]+@([\w-]+\.)+[\w-]{2,4}$" 
            title="Digite um email válido! Exemplo: email@email.com" required/>
            <small id="errorEmail" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>        
        </div>       
        
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

         <!--Imprime Erros se Houver-->
         <?php
            if(isset($_GET['error'])){
                $error = $_GET['error'];
                switch ($error){
                    case 001:?>
                        <!--Erro de Fantasia-->
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtFantasia = document.getElementById('txtFantasia');                            
                            let errorFantasia = document.getElementById('errorFantasia');
                            let txtCNPJ = document.getElementById('txtCNPJ');                            
                            let errorCNPJ = document.getElementById('errorCNPJ');
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                               
                            
                            txtFantasia.style.border = "1px solid #DB5A5A"; 
                            errorFantasia.style.color = "#DB5A5A";
                            errorFantasia.innerHTML = "Fantasia já cadastrada!";
                            txtCNPJ.style.border = "1px solid #90EE90";   
                            errorCNPJ.style.color = "#90EE90";                         
                            errorCNPJ.innerHTML = "CNPJ disponível!";
                            txtEmail.style.border = "1px solid #90EE90"; 
                            errorEmail.style.color = "#90EE90";                           
                            errorEmail.innerHTML = "Email disponível!";

                            txtFantasia.focus();                                                                        
                        </script>
                        <?php
                        break;
                    case 002:?>
                        <!--Erro de CNPJ-->
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtFantasia = document.getElementById('txtFantasia');                            
                            let errorFantasia = document.getElementById('errorFantasia');
                            let txtCNPJ = document.getElementById('txtCNPJ');                            
                            let errorCNPJ = document.getElementById('errorCNPJ');
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                               
                            
                            txtFantasia.style.border = "1px solid #90EE90"; 
                            errorFantasia.style.color = "#90EE90";
                            errorFantasia.innerHTML = "Fantasia disponível!";
                            txtCNPJ.style.border = "1px solid #DB5A5A";   
                            errorCNPJ.style.color = "#DB5A5A";                         
                            errorCNPJ.innerHTML = "CNPJ já cadastrado!";
                            txtEmail.style.border = "1px solid #90EE90"; 
                            errorEmail.style.color = "#90EE90";                           
                            errorEmail.innerHTML = "Email disponível!";

                            txtCNPJ.focus();    
                        </script>
                        <?php
                        break;  
                    case 003:?>
                        <!--Erro de Email-->
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtFantasia = document.getElementById('txtFantasia');                            
                            let errorFantasia = document.getElementById('errorFantasia');
                            let txtCNPJ = document.getElementById('txtCNPJ');                            
                            let errorCNPJ = document.getElementById('errorCNPJ');
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                               
                            
                            txtFantasia.style.border = "1px solid #90EE90"; 
                            errorFantasia.style.color = "#90EE90";
                            errorFantasia.innerHTML = "Fantasia disponível!";
                            txtCNPJ.style.border = "1px solid #90EE90";   
                            errorCNPJ.style.color = "#90EE90";                         
                            errorCNPJ.innerHTML = "CNPJ disponível!";
                            txtEmail.style.border = "1px solid #DB5A5A"; 
                            errorEmail.style.color = "#DB5A5A";                           
                            errorEmail.innerHTML = "Email já cadastrado!";

                            txtEmail.focus();        
                        </script>
                        <?php
                        break;    
                    case 004:?>
                        <!--Erro de CNPJ - Email-->
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtFantasia = document.getElementById('txtFantasia');                            
                            let errorFantasia = document.getElementById('errorFantasia');
                            let txtCNPJ = document.getElementById('txtCNPJ');                            
                            let errorCNPJ = document.getElementById('errorCNPJ');
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                               
                            
                            txtFantasia.style.border = "1px solid #90EE90"; 
                            errorFantasia.style.color = "#90EE90";
                            errorFantasia.innerHTML = "Fantasia disponível!";
                            txtCNPJ.style.border = "1px solid #DB5A5A";   
                            errorCNPJ.style.color = "#DB5A5A";                         
                            errorCNPJ.innerHTML = "CNPJ já cadastrado!";
                            txtEmail.style.border = "1px solid #DB5A5A"; 
                            errorEmail.style.color = "#DB5A5A";                           
                            errorEmail.innerHTML = "Email já cadastrado!";

                            txtCNPJ.focus();        
                        </script>
                        <?php
                        break;
                    case 005:?>
                        <!--Erro de Fantasia - Email-->
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtFantasia = document.getElementById('txtFantasia');                            
                            let errorFantasia = document.getElementById('errorFantasia');
                            let txtCNPJ = document.getElementById('txtCNPJ');                            
                            let errorCNPJ = document.getElementById('errorCNPJ');
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                               
                            
                            txtFantasia.style.border = "1px solid #DB5A5A"; 
                            errorFantasia.style.color = "#DB5A5A";
                            errorFantasia.innerHTML = "Fantasia já cadastrada!";
                            txtCNPJ.style.border = "1px solid #90EE90";   
                            errorCNPJ.style.color = "#90EE90";                         
                            errorCNPJ.innerHTML = "CNPJ disponível!";
                            txtEmail.style.border = "1px solid #DB5A5A"; 
                            errorEmail.style.color = "#DB5A5A";
                            errorEmail.innerHTML = "Email já cadastrado!";

                            txtFantasia.focus();        
                        </script>
                        <?php
                        break;
                    case 006:?>
                        <!--Erro de Fantasia - CNPJ-->
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtFantasia = document.getElementById('txtFantasia');                            
                            let errorFantasia = document.getElementById('errorFantasia');
                            let txtCNPJ = document.getElementById('txtCNPJ');                            
                            let errorCNPJ = document.getElementById('errorCNPJ');
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                               
                            
                            txtFantasia.style.border = "1px solid #DB5A5A"; 
                            errorFantasia.style.color = "#DB5A5A";
                            errorFantasia.innerHTML = "Fantasia já cadastrada!";
                            txtCNPJ.style.border = "1px solid #DB5A5A";   
                            errorCNPJ.style.color = "#DB5A5A";                         
                            errorCNPJ.innerHTML = "CNPJ já cadastrado!";
                            txtEmail.style.border = "1px solid #90EE90"; 
                            errorEmail.style.color = "#90EE90";
                            errorEmail.innerHTML = "Email disponível!";

                            txtFantasia.focus();        
                        </script>
                        <?php
                        break;
                    case 007:?>
                        <!--Erro de Fantasia - CNPJ-->
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtFantasia = document.getElementById('txtFantasia');                            
                            let errorFantasia = document.getElementById('errorFantasia');
                            let txtCNPJ = document.getElementById('txtCNPJ');                            
                            let errorCNPJ = document.getElementById('errorCNPJ');
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                               
                            
                            txtFantasia.style.border = "1px solid #DB5A5A"; 
                            errorFantasia.style.color = "#DB5A5A";
                            errorFantasia.innerHTML = "Fantasia já cadastrada!";
                            txtCNPJ.style.border = "1px solid #DB5A5A";   
                            errorCNPJ.style.color = "#DB5A5A";                         
                            errorCNPJ.innerHTML = "CNPJ já cadastrado!";
                            txtEmail.style.border = "1px solid #DB5A5A"; 
                            errorEmail.style.color = "#DB5A5A";
                            errorEmail.innerHTML = "Email já cadastrado!";

                            txtFantasia.focus();        
                        </script>
                        <?php
                        break;                                  
                }
            }
        ?>
        
    </form>

        <!--Script-->
        <script type="text/javascript" src="../../../JAVASCRIPT/functions.js"></script>
        <script>
            function verificaApelido(){
                var txtFantasia = document.getElementById("txtFantasia");
                var errorFantasia = document.getElementById("errorFantasia");            
                var fantasiaInserida = document.getElementById("txtFantasia").value;               
                                
                $.ajax({                
                    url: '../../verificacoes/validaApelido.php?apelido='+fantasiaInserida,
                    method: 'get',
                    dataType: 'text',
                    data: fantasiaInserida,                
                }).done(function(data){
                    console.log(data);      
                    if($.trim(data) == ""){
                        $("#errorFantasia").html("Fantasia disponível!"); 
                        $('#txtFantasia').css('border', '1px solid #90EE90');
                        $('#errorFantasia').css('color', '#90EE90');                        
                    }else{
                        $("#errorFantasia").html("Fantasia já cadastrada!"); 
                        $('#txtFantasia').css('border', '1px solid #DB5A5A');
                        $('#errorFantasia').css('color', '#DB5A5A');
                    } 
                });
            }

            function verificaEmail(){
                var txtEmail = document.getElementById("txtEmail");
                var errorEmail = document.getElementById("errorEmail");            
                var emailInserido = document.getElementById("txtEmail").value;     

                $.ajax({                
                    url: '../../verificacoes/validaEmail.php?email='+emailInserido,
                    method: 'get',
                    dataType: 'text',
                    data: emailInserido,                
                }).done(function(data){
                    console.log(data);                
                    if($.trim(data) == ""){
                        $("#errorEmail").html("Email disponível!"); 
                        $('#txtEmail').css('border', '1px solid #90EE90');
                        $('#errorEmail').css('color', '#90EE90');                        
                    }else{
                        $("#errorEmail").html(data); 
                        $('#txtEmail').css('border', '1px solid #DB5A5A');
                        $('#errorEmail').css('color', '#DB5A5A');
                    }
                });
            }

            function verificaCNPJ(){
                var txtCNPJ = document.getElementById("txtCNPJ");
                var errorCNPJ = document.getElementById("errorCNPJ");            
                var cnpjInserido = document.getElementById("txtCNPJ").value;     

                $.ajax({                
                    url: '../../verificacoes/validaCNPJ.php?cnpj='+cnpjInserido,
                    method: 'get',
                    dataType: 'text',
                    data: cnpjInserido,                
                }).done(function(data){
                    console.log(data);                
                    if($.trim(data) == ""){
                        $("#errorCNPJ").html("CNPJ disponível!"); 
                        $('#txtCNPJ').css('border', '1px solid #90EE90');
                        $('#errorCNPJ').css('color', '#90EE90');                        
                    }else{
                        $("#errorCNPJ").html(data); 
                        $('#txtCNPJ').css('border', '1px solid #DB5A5A');
                        $('#errorCNPJ').css('color', '#DB5A5A');
                    }
                });
            }
        </script>
</body>
</html>