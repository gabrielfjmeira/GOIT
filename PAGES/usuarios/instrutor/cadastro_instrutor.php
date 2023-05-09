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
    <form id="formCadastroInstrutor" name="formCadastroInstrutor" class="form" action="insert_instrutorPHP.php" method="POST" onsubmit="return formCadastroInstrutorOnSubmit();">
        <div class="input-wrapper">
            <label>Nome completo*</label>
            <input type="text" id="txtNome" name="txtNome" placeholder="Nome" class="input" 
            pattern="^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]{3,}$" 
            title="Nome só deve conter letras e deve possuir no mínimo 3 caracteres e no máximo 100 caracteres!" required/>
            <small id="errorNome" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
        </div>

        <div class="input-wrapper">
            <label>Apelido*</label>
            <input type="text" id="txtApelido" name="txtApelido" placeholder="Apelido" class="input" 
            pattern="^[A-z]\w{3,29}$" 
            title="Apelido deve começar com uma letra e não pode conter símbolos, deve possuir no mínimo 4 caracteres e no máximo 30 caracteres!" required/>
            <small id="errorApelido" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
        </div>         

        <div class="input-wrapper">
            <label>Data de Nascimento*</label>
            <input type="date" id="dataNascimento" name="dataNascimento" placeholder="dd/mm/aaaa" class="input" 
            title="dd/mm/aaaa" required/>
        </div>
        
        <div class="input-wrapper">
            <label>Sexo*</label>
                <div class = "input-sexo">
                    <div class="input-radio">
                        <input type="radio" id="sexo_m" name="sexo" value="0" required>
                        <label>Masculino</label>
                    </div>

                    <div class="input-radio">
                        <input type="radio" id="sexo_f" name="sexo" value="1" required>
                        <label>Feminino</label>
                    </div>

                    <div class="input-radio">
                        <input type="radio" id="sexo_o" name="sexo" value="2" required>
                        <label>Outro</label>
                    </div>
                </div>
        </div>

        <div class="input-wrapper">
            <label>Cadastur*</label>
            <input type="text" id="txtCadastur" name="txtCadastur" placeholder="Formato: XX########XXXX" class="input" 
            pattern="^[A-Z]{2}[0-9]{8}[A-Z]{4}$" 
            title="Cadastur inválido! Formato: XX########XXXX" required/>
            <small id="errorCadastur" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
        </div>

        <div class="input-wrapper">
            <label>Categoria em que atua*</label>
            <select id="catInstrutor" name="catInstrutor" required>        
                <option selected disabled="disabled" hidden>Escolha uma opção</option>
                <?php          
                    $categorias = "SELECT * FROM CATATV ORDER BY CATATV_Descricao ASC";      
                    $queryCategorias = $mysqli->query($categorias) or die(mysql_error());

                    while($categoria = mysqli_fetch_array($queryCategorias)){
                        $catatv_codigo = $categoria['CATATV_Codigo'];
                        $catatv_descricao = $categoria['CATATV_Descricao'];
                        
                        echo "<option value=".$catatv_codigo.">". $catatv_descricao."</option>";                                                                   
                    }
                ?>                                                           
            </select>
            <small id="errorCategoria" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>            
        </div>

        <div class="input-wrapper">
            <label>Email*</label>
            <input type="text" id="txtEmail" name="txtEmail" placeholder="email@email.com" class="input" 
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
                            let txtApelido = document.getElementById('txtApelido');                            
                            let errorApelido = document.getElementById('errorApelido');                                                                                                                  
                            
                            txtApelido.style.border = "1px solid #DB5A5A";                            
                            errorApelido.innerHTML = "Apelido já cadastrado!";   
                            txtApelido.focus();                                                                        
                        </script>
                        <?php
                        break;
                    case 002:?>
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtCadastur = document.getElementById('txtCadastur');                            
                            let errorCadastur = document.getElementById('errorCadastur');                                                                                                                  
                            
                            txtCadastur.style.border = "1px solid #DB5A5A";                            
                            errorCadastur.innerHTML = "Cadastur já cadastrado!";                                                                       
                            txtCadastur.focus();    
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
                    case 004:?>
                        <script type="text/javascript">
                            //Cria Variáveis
                            let catInstrutor = document.getElementById('catInstrutor');                            
                            let errorCategoria = document.getElementById('errorCategoria');                                                                                                                  
                            
                            catInstrutor.style.border = "1px solid #DB5A5A";                            
                            errorCategoria.innerHTML = "Selecione uma Categoria!";                                                                       
                            catInstrutor.focus();    
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

        <p>
            <label>Mostrar senha</label>                
            <input type="checkbox" onclick="mostrarSenha();">
        </p>

        <button type="submit">Cadastrar</button>

        <div class="wrapper-cadastrar-login">
            <p>Já possuí cadastro?</p> 
            <a href="../../../index.php">Login aqui</a>
        </div>
        
    </form>

    <!--Script-->        
    <script type="text/javascript" src="../../../JAVASCRIPT/functions.js"></script>

</body>
</html>