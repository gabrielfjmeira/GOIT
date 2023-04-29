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
            <input type="text" id="txtRazaoSocial" name="txtRazaoSocial" placeholder="Razão Social" class="input" 
            pattern="^.{8,}$" 
            title="Razão Social deve possuir no mínimo 8 caracteres e no máximo 100 caracteres!" required/>
        </div>

        <div class="input-wrapper">    
            <label>Fantasia: </label>
            <input type="text" id="txtFantasia" name="txtFantasia" placeholder="Fantasia" class="input" 
            pattern="^.{4,30}$" 
            title="Fantasia deve possuir no mínimo 4 caracteres e no máximo 30 caracteres!" required/>
        </div>

        <div class="input-wrapper">
            <label>CNPJ: </label>
            <input type="text" id="CNPJ" name="CNPJ" placeholder="CNPJ" class="input" 
            pattern="^[0-9]{14}$" 
            title="CNPJ deve possuir 14 dígitos: ##############" required/>               
        </div>

        <div class="input-wrapper">    
            <label>Email: </label>
            <input type="text" id="txtEmail" name="txtEmail" placeholder="Email" class="input" 
            pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" 
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
        <script type="text/javascript">
            //Verificações do Cadastro de Lojista
            function formCadastroLojistaOnSubmit(){                
                let txtSenha = document.getElementById('txtSenha');
                let txtSenhaConfirmada = document.getElementById('txtSenhaConfirmada');
                
                //let reSenha= /(?=^.{8,}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;                                                                     
                
                if (txtSenha.value != txtSenhaConfirmada.value) {
                    txtSenhaConfirmada.setCustomValidity("Senhas informadas não coincidem!");
                    txtSenhaConfirmada.reportValidity();
                    return false;
                } else {
                    txtSenhaConfirmada.setCustomValidity("");                    
                }
                
                return true;
            }

            //Função de Mostrar/Ocultar Senha
            function mostrarSenha(){
                let txtSenha = document.getElementById('txtSenha');
                let txtSenhaConfirmada = document.getElementById('txtSenhaConfirmada');
                
                if (txtSenha.type == "password"){
                    txtSenha.type = "text";
                    txtSenhaConfirmada.type = "text";
                } else {
                    txtSenha.type = "password";
                    txtSenhaConfirmada.type = "password";
                }              
            }
        </script>
</body>
</html>