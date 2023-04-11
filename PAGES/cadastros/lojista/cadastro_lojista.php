<?php
    //Incluí conexão
    include('../../../CONNECTIONS/connection.php');     
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
                <input type="text" id="txtFantasia" name="txtFantasia" placeholder="Fantasia" class="input" required/>
                
                <label>CNPJ: </label>
                <input type="number" id="CNPJ" name="CNPJ" placeholder="CNPJ" onkeypress="MascaraParaCNPJ(this);" class="input" required/><br><br>                

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

        <script>
            //Verificações do formulário
            function formCadastroPraticanteOnSubmit(){
                       
                var txtEmail = document.getElementById('txtEmail');
                var txtSenha = document.getElementById('txtSenha');
                var txtSenhaConfirmada = document.getElementById('txtSenhaConfirmada');

                const reEmail = /^[a-z0-9.]+@[a-z0-9]+\.[a-z]+\.([a-z]+)?$/;        
                                                 
                if (!reEmail.test(txtEmail.value)) {
                    txtEmail.setCustomValidity("Digite um E-Mail válido!");
                    txtEmail.reportValidity();
                    return false;
                }else{
                    txtEmail.setCustomValidity("");
                }                       
                
                if (txtSenha.value.length < 7 || txtSenha.value.length > 20){                    
                    txtSenha.setCustomValidity("Senha deve possuir no mínimo 7 e no máximo 20 caracteres!");
                    txtSenha.reportValidity();
                    return false;
                }else{
                    txtSenha.setCustomValidity("");
                }
                
                if (txtSenha.value != txtSenhaConfirmada.value) {
                    txtSenhaConfirmada.setCustomValidity("Senhas diferentes!");
                    txtSenhaConfirmada.reportValidity();
                    return false;
                } else {
                    txtSenhaConfirmada.setCustomValidity("");                    
                }
                
                return true;
            }

            //Função de Mostrar/Ocultar Senha
            function mostrarSenha(){
                var txtSenha = document.getElementById('txtSenha');
                var txtSenhaConfirmada = document.getElementById('txtSenhaConfirmada');
                
                if (txtSenha.type == "password"){
                    txtSenha.type = "text";
                    txtSenhaConfirmada.type = "text";
                } else {
                    txtSenha.type = "password";
                    txtSenhaConfirmada.type = "password";
                }              
            }
            
            function MascaraParaCNPJ(valorDoTextBox) {
                if (valorDoTextBox.length <= 14) {  

                    //Coloca ponto entre o segundo e o terceiro dígitos
                    valorDoTextBox = valorDoTextBox.replace(/^(\d{2})(\d)/, "$1.$2")

                    //Coloca ponto entre o quinto e o sexto dígitos
                    valorDoTextBox = valorDoTextBox.replace(/^(\d{2})\.(\d{3})(\d)/, "$1 $2 $3")

                    //Coloca uma barra entre o oitavo e o nono dígitos
                    valorDoTextBox = valorDoTextBox.replace(/\.(\d{3})(\d)/, ".$1/$2")

                    //Coloca um hífen depois do bloco de quatro dígitos
                    valorDoTextBox = valorDoTextBox.replace(/(\d{4})(\d)/, "$1-$2") 
                } 
                return valorDoTextBox
            }
            
        </script>
    </section>
</body>
</html>