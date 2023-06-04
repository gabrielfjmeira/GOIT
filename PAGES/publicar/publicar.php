<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../index.php?error=4");
    }   
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Configurações-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/publicarPostagem.css">
    <link rel="icon" href="../../ASSETS/icon.ico"/>    

    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body>
    <!--Cabeçalho-->
    <div id="app">
        <header>
            <button style="cursor: pointer;" onclick="window.history.back()"><img src="../../ASSETS/backButtonDark.svg" alt="back-button"></button>
            <img src="../../ASSETS/Logo.png" alt="logo" class="logo" 
            <?php
                if($_SESSION['TIPOUSUARIO'] == 4){?>
                    onclick="location.href='../perfil/perfil.php'" 
                <?php
                }else{?>
                    onclick="location.href='../home/home.php'" 
                <?php
                }            
            ?>   
            style="cursor: pointer;">  
        </header>
        
        <!--Formulário-->    
        <form id="formPublicar" name="formPublicar" action="./publicar_PHP.php" method="POST" enctype="multipart/form-data">
            <div class="type-publi">
                <h3 class="selected">Publicar</h3>
            </div>

            <div class="input-wrapper">
                <label>Escolha o que Deseja Publicar</label>
                <select name="tipo_pub" id="">
                    <option value="0"  id="pub_p" required>Evento</option>
                    <option value="1"  id="pub_a" required>Anúncio</option>
                </select>
            </div>

            <button id="submitButton" type="submit">Continuar</button>
        </form>

        <footer>
            <?php 
                $assets_path = '../../ASSETS';
                include '../templates/footers/navBarPublicar.php';                
            ?>
        </footer>
    </div>
        
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</body>
</html>