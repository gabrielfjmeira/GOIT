<?php
    //Incluí a Conexão
    include('../../CONNECTIONS/connection.php');
    
    //Verifica se o Usuário está Logado
    if ($_SESSION['LOGGED'] == True){
        header ("Location: ../PAGES/home/home.php");
    }

    //Retornar todos os Registros de Tipos de Usuários
    $sqlTipoUsuarios = "SELECT * FROM TIPUSU";
    $resultTipoUsuarios = $mysqli->query($sqlTipoUsuarios) or die(mysql_error());
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Configurações-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="stylesheet" href="../../CSS/loginCadastro.css">
    <link rel="icon" href="../../ASSETS/icon.ico"/>

    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body>
    
    <button onclick="window.location.href = '../../index.php'" id = "buttonBack">
        <img src="../../ASSETS/backWhite.svg" alt="Back button" style="cursor: pointer;">
    </button>    
    
    <br><br>

    <!--Cabeçalho-->
    <header id = "headerCadastro">
        <img src="../../ASSETS/logoWhite.png" alt="Logo Go It">
        <h1>Cadastro</h1>
    </header>

    <!--Seleção do Tipo de Usuário-->
    <form id="formCadastroTipoUsuarios" name="formCadastroUsuarios" action="redirecionar_usuarioPHP.php" method="post" class="form">
        
        <div class="input-wrapper">
            <label>Selecione o seu tipo de usuário:</label>
            <select name="tipoUsuario" required>
    
                <option value="" selected disabled="disabled" hidden>Escolha uma opção</option>
                <?php                
                    while($tipoUsuario = mysqli_fetch_array($resultTipoUsuarios)){
                        $tipusu_Codigo = $tipoUsuario['TIPUSU_Codigo'];
                        $tipusu_Descricao = $tipoUsuario['TIPUSU_Descricao'];
                        $tipusu_Administrador = $tipoUsuario['TIPUSU_Administrador'];  

                        if ($tipusu_Administrador != 1){
                            echo "<option value='".$tipusu_Codigo."'>". $tipusu_Descricao."</option>";                                       
                        }                                                                          
                    }
                ?>                                                           
            </select>
        </div>
        <button id="btnProximo" type="submit">Próximo</button>        

    </form>           
</body>
</html>