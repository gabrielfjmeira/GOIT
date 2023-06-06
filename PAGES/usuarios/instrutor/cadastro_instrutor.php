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
    <form id="formCadastroInstrutor" name="formCadastroInstrutor" class="form" action="insert_instrutorPHP.php" method="POST" onsubmit="return formCadastroInstrutorOnSubmit();">
        <div class="input-wrapper">
            <label>Nome completo*</label>
            <input type="text" id="txtNome" name="txtNome" placeholder="Nome" class="input"
                <?php 
                    if(isset($_GET['nome'])){?>
                        value="<?php echo $_GET['nome'];?>"
                        <?php
                    }       
                ?> 
            pattern="^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]{3,}$" 
            title="Nome só deve conter letras e deve possuir no mínimo 3 caracteres e no máximo 100 caracteres!" required/>
            <small id="errorNome" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
        </div>

        <div class="input-wrapper">
            <label>Apelido*</label>
            <input type="text" id="txtApelido" name="txtApelido" placeholder="Apelido" class="input" onchange="verificaApelido();"
                <?php 
                    if(isset($_GET['apelido'])){?>
                        value="<?php echo $_GET['apelido'];?>"                        
                        <?php
                    }       
                ?>
            pattern="^[A-z]\w{3,29}$" 
            title="Apelido deve começar com uma letra e não pode conter símbolos, deve possuir no mínimo 4 caracteres e no máximo 30 caracteres!" required/>
            <small id="errorApelido" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
        </div>         

        <div class="input-wrapper">
            <label>Instagram*</label>
            <input type="text" id="txtInstagram" name="txtInstagram" placeholder="@Instagram" class="input"
                <?php 
                    if(isset($_GET['instagram'])){?>
                        value="<?php echo $_GET['instagram'];?>"
                        <?php
                    }       
                ?> 
            required/>           
        </div>

        <div class="input-wrapper">
            <label>Data de Nascimento*</label>
            <input type="date" id="dataNascimento" name="dataNascimento" placeholder="dd/mm/aaaa" class="input" 
                <?php 
                    if(isset($_GET['dataNascimento'])){?>
                        value="<?php echo $_GET['dataNascimento'];?>"
                        <?php
                    }       
                ?>
            title="dd/mm/aaaa" required/>
        </div>
        
        <div class="input-wrapper">
            <label>Sexo*</label>
                <div class = "input-sexo">
                    <div class="input-radio">
                        <input type="radio" id="sexo_m" name="sexo" value="0"
                            <?php 
                                if(isset($_GET['sexo'])){
                                    if($_GET['sexo'] == 0){?>
                                        checked
                                        <?php
                                    }
                                }       
                            ?>
                        required>
                        <label>Masculino</label>
                    </div>

                    <div class="input-radio">
                        <input type="radio" id="sexo_f" name="sexo" value="1" 
                            <?php 
                                if(isset($_GET['sexo'])){
                                    if($_GET['sexo'] == 1){?>
                                        checked
                                        <?php
                                    }
                                }       
                            ?>
                        required>
                        <label>Feminino</label>
                    </div>

                    <div class="input-radio">
                        <input type="radio" id="sexo_o" name="sexo" value="2"
                            <?php 
                                if(isset($_GET['sexo'])){
                                    if($_GET['sexo'] == 2){?>
                                        checked
                                        <?php
                                    }
                                }       
                            ?>
                        required>
                        <label>Outro</label>
                    </div>
                </div>
        </div>

        <div class="input-wrapper">
            <label>Cadastur*</label>
            <input type="text" id="txtCadastur" name="txtCadastur" placeholder="Formato: XX########XXXX" class="input" onchange="verificaCadastur();"
                <?php 
                    if(isset($_GET['cadastur'])){?>
                        value="<?php echo $_GET['cadastur'];?>"                        
                        <?php
                    }       
                ?>
            pattern="^[A-Z]{2}[0-9]{8}[A-Z]{4}$" 
            title="Cadastur inválido! Formato: XX########XXXX" required/>
            <small id="errorCadastur" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
        </div>

        <div class="input-wrapper">
            <label>Categoria em que atua*</label>
            <select id="catInstrutor" name="catInstrutor" required>        
                <?php 
                    //Verifica se está recebendo a categoria
                    if(isset($_GET['categoria'])){                                                  
                        $categorias = "SELECT * FROM CATATV ORDER BY CATATV_Descricao ASC";      
                        $queryCategorias = $mysqli->query($categorias) or die(mysql_error());

                        while($categoria = mysqli_fetch_array($queryCategorias)){                            
                            $catatv_codigo = $categoria['CATATV_Codigo'];
                            $catatv_descricao = $categoria['CATATV_Descricao'];
                            if($catatv_codigo == $_GET['categoria']){
                                echo "<option value=".$catatv_codigo." selected>". $catatv_descricao."</option>";
                            }else{
                                echo "<option value=".$catatv_codigo.">". $catatv_descricao."</option>";
                            }                            
                        }                            
                    }else{?>
                        <option disabled="disabled" value="" selected hidden>Escolha uma opção</option>
                        <?php                          
                        $categorias = "SELECT * FROM CATATV ORDER BY CATATV_Descricao ASC";      
                        $queryCategorias = $mysqli->query($categorias) or die(mysql_error());

                        while($categoria = mysqli_fetch_array($queryCategorias)){
                            $catatv_codigo = $categoria['CATATV_Codigo'];
                            $catatv_descricao = $categoria['CATATV_Descricao'];
                            
                            echo "<option value=".$catatv_codigo.">". $catatv_descricao."</option>";                                                                   
                        }                            
                    }                
                ?>
            </select>
            <small id="errorCategoria" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>            
        </div>

        <div class="input-wrapper">
            <label>Email*</label>
            <input type="text" id="txtEmail" name="txtEmail" placeholder="email@email.com" class="input" onchange="verificaEmail();"
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

        <p>
            <label>Mostrar senha</label>                
            <input type="checkbox" onclick="mostrarSenha();">
        </p>

        <button type="submit">Cadastrar</button>

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
                        <!--Erro de Apelido-->
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtApelido = document.getElementById('txtApelido');                            
                            let errorApelido = document.getElementById('errorApelido');
                            let txtCadastur = document.getElementById('txtCadastur');                            
                            let errorCadastur = document.getElementById('errorCadastur');
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                            
                            
                            txtApelido.style.border = "1px solid #DB5A5A"; 
                            errorApelido.style.color = "#DB5A5A";
                            errorApelido.innerHTML = "Apelido já cadastrado!";   
                            txtCadastur.style.border = "1px solid #90EE90"; 
                            errorCadastur.style.color = "#90EE90";
                            errorCadastur.innerHTML = "Cadastur disponível!";
                            txtEmail.style.border = "1px solid #90EE90";
                            errorEmail.style.color = "#90EE90";               
                            errorEmail.innerHTML = "Email disponível!";

                            txtApelido.focus();                                                                        
                        </script>
                        <?php
                        break;
                    case 002:?>
                        <!--Erro de Email-->
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtApelido = document.getElementById('txtApelido');                            
                            let errorApelido = document.getElementById('errorApelido');
                            let txtCadastur = document.getElementById('txtCadastur');                            
                            let errorCadastur = document.getElementById('errorCadastur');
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                            
                            
                            txtApelido.style.border = "1px solid #90EE90"; 
                            errorApelido.style.color = "#90EE90";
                            errorApelido.innerHTML = "Apelido disponível!";   
                            txtCadastur.style.border = "1px solid #90EE90"; 
                            errorCadastur.style.color = "#90EE90";
                            errorCadastur.innerHTML = "Cadastur disponível!";
                            txtEmail.style.border = "1px solid #DB5A5A";
                            errorEmail.style.color = "#DB5A5A";               
                            errorEmail.innerHTML = "Email já cadastrado!";

                            txtEmail.focus();   
                        </script>
                        <?php
                        break;  
                    case 003:?>
                        <!--Erro de Cadastur-->
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtApelido = document.getElementById('txtApelido');                            
                            let errorApelido = document.getElementById('errorApelido');
                            let txtCadastur = document.getElementById('txtCadastur');                            
                            let errorCadastur = document.getElementById('errorCadastur');
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                            
                            
                            txtApelido.style.border = "1px solid #90EE90"; 
                            errorApelido.style.color = "#90EE90";
                            errorApelido.innerHTML = "Apelido disponível!";   
                            txtCadastur.style.border = "1px solid #DB5A5A"; 
                            errorCadastur.style.color = "#DB5A5A";
                            errorCadastur.innerHTML = "Cadastur já cadastrado!";
                            txtEmail.style.border = "1px solid #90EE90";
                            errorEmail.style.color = "#90EE90";               
                            errorEmail.innerHTML = "Email disponível!";

                            txtCadastur.focus();    
                        </script>
                        <?php
                        break;  
                    case 004:?>
                        <!--Erro de Cadastur - Email-->
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtApelido = document.getElementById('txtApelido');                            
                            let errorApelido = document.getElementById('errorApelido');
                            let txtCadastur = document.getElementById('txtCadastur');                            
                            let errorCadastur = document.getElementById('errorCadastur');
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                            
                            
                            txtApelido.style.border = "1px solid #90EE90"; 
                            errorApelido.style.color = "#90EE90";
                            errorApelido.innerHTML = "Apelido disponível!";   
                            txtCadastur.style.border = "1px solid #DB5A5A"; 
                            errorCadastur.style.color = "#DB5A5A";
                            errorCadastur.innerHTML = "Cadastur já cadastrado!";
                            txtEmail.style.border = "1px solid #DB5A5A";
                            errorEmail.style.color = "#DB5A5A";               
                            errorEmail.innerHTML = "Email já cadastrado!";

                            txtCadastur.focus();      
                        </script>
                        <?php
                        break;
                    case 005:?>
                        <!--Erro de Apelido - Email-->
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtApelido = document.getElementById('txtApelido');                            
                            let errorApelido = document.getElementById('errorApelido');
                            let txtCadastur = document.getElementById('txtCadastur');                            
                            let errorCadastur = document.getElementById('errorCadastur');
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                            
                            
                            txtApelido.style.border = "1px solid #DB5A5A"; 
                            errorApelido.style.color = "#DB5A5A";
                            errorApelido.innerHTML = "Apelido já cadastrado!";   
                            txtCadastur.style.border = "1px solid #90EE90"; 
                            errorCadastur.style.color = "#90EE90";
                            errorCadastur.innerHTML = "Cadastur disponível!";
                            txtEmail.style.border = "1px solid #DB5A5A";
                            errorEmail.style.color = "#DB5A5A";               
                            errorEmail.innerHTML = "Email já cadastrado!";

                            txtApelido.focus();      
                        </script>
                        <?php
                        break;
                    case 006:?>
                        <!--Erro de Apelido - Cadastur-->
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtApelido = document.getElementById('txtApelido');                            
                            let errorApelido = document.getElementById('errorApelido');
                            let txtCadastur = document.getElementById('txtCadastur');                            
                            let errorCadastur = document.getElementById('errorCadastur');
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                            
                            
                            txtApelido.style.border = "1px solid #DB5A5A"; 
                            errorApelido.style.color = "#DB5A5A";
                            errorApelido.innerHTML = "Apelido já cadastrado!";   
                            txtCadastur.style.border = "1px solid #DB5A5A"; 
                            errorCadastur.style.color = "#DB5A5A";
                            errorCadastur.innerHTML = "Cadastur já cadastrado!";
                            txtEmail.style.border = "1px solid #90EE90";
                            errorEmail.style.color = "#90EE90";               
                            errorEmail.innerHTML = "Email disponível!";

                            txtApelido.focus();      
                        </script>
                        <?php
                        break;
                    case 007:?>
                        <!--Erro de Apelido - Cadastur - Email-->
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtApelido = document.getElementById('txtApelido');                            
                            let errorApelido = document.getElementById('errorApelido');
                            let txtCadastur = document.getElementById('txtCadastur');                            
                            let errorCadastur = document.getElementById('errorCadastur');
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                            
                            
                            txtApelido.style.border = "1px solid #DB5A5A"; 
                            errorApelido.style.color = "#DB5A5A";
                            errorApelido.innerHTML = "Apelido já cadastrado!";   
                            txtCadastur.style.border = "1px solid #DB5A5A"; 
                            errorCadastur.style.color = "#DB5A5A";
                            errorCadastur.innerHTML = "Cadastur já cadastrado!";
                            txtEmail.style.border = "1px solid #DB5A5A";
                            errorEmail.style.color = "#DB5A5A";               
                            errorEmail.innerHTML = "Email já cadastrado!";

                            txtApelido.focus();      
                        </script>
                        <?php
                        break;
                    case 8:?>
                        <!--Erro de Apelido - Cadastur - Email-->
                        <script type="text/javascript">
                            //Cria Variáveis
                            let catInstrutor = document.getElementById('catInstrutor');                            
                            let errorCategoria = document.getElementById('errorCategoria');                                                                                                                                        
                            
                            catInstrutor.style.border = "1px solid #DB5A5A"; 
                            errorCategoria.style.color = "#DB5A5A";
                            errorCategoria.innerHTML = "Selecione uma categoria!";                               

                            catInstrutor.focus();      
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
                var txtApelido = document.getElementById("txtApelido");
                var errorApelido = document.getElementById("errorApelido");            
                var apelidoInserido = document.getElementById("txtApelido").value;               
                                
                $.ajax({                
                    url: '../../verificacoes/validaApelido.php?apelido='+apelidoInserido,
                    method: 'get',
                    dataType: 'text',
                    data: apelidoInserido,                
                }).done(function(data){
                    console.log(data);      
                    if($.trim(data) == ""){
                        $("#errorApelido").html("Apelido disponível!"); 
                        $('#txtApelido').css('border', '1px solid #90EE90');
                        $('#errorApelido').css('color', '#90EE90');                        
                    }else{
                        $("#errorApelido").html("Apelido já cadastrado!"); 
                        $('#txtApelido').css('border', '1px solid #DB5A5A');
                        $('#errorApelido').css('color', '#DB5A5A');
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

            function verificaCadastur(){
                var txtCadastur = document.getElementById("txtCadastur");
                var errorCadastur = document.getElementById("errorCadastur");            
                var cadasturInserido = document.getElementById("txtCadastur").value;     

                $.ajax({                
                    url: '../../verificacoes/validaCadastur.php?cadastur='+cadasturInserido,
                    method: 'get',
                    dataType: 'text',
                    data: cadasturInserido,                
                }).done(function(data){
                    console.log(data);                
                    if($.trim(data) == ""){
                        $("#errorCadastur").html("Cadastur disponível!"); 
                        $('#txtCadastur').css('border', '1px solid #90EE90');
                        $('#errorCadastur').css('color', '#90EE90');                        
                    }else{
                        $("#errorCadastur").html(data); 
                        $('#txtCadastur').css('border', '1px solid #DB5A5A');
                        $('#errorCadastur').css('color', '#DB5A5A');
                    }
                });
            }
        </script>

</body>
</html>