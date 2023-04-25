<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../index.php?error=4");
    }
   
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Configurações-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../CSS/publicarPostagem.css">
    

    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body>
    <!--Cabeçalho-->
    <div id="app">
        <header>
            <button style="cursor: pointer;" onclick="window.location.href='../../home/home.php';"><img src="../../../ASSETS/backButtonDark.svg" alt="back-button"></button>
            <img src="../../../ASSETS/Logo.png" alt="logo" class="logo">
        </header>
        
        <!--Formulário-->    
        <form id="formInsertAtividade" name="formInsertAtividade" action="insert_atividadePHP.php" method="POST" onsubmit="return formInsertAtividadeOnSubmit();">
                
            <div class="type-publi">
                    <h3>Grupo</h3>

                    <div id="switch" onclick="togglePubliType()">
                        <button></button>
                        <span></span>
                    </div>

                    <h3 class="selected">Evento</h3>
            </div>

            <div class="input-wrapper">
                <label for="title-post">Título</label>
                <div class="title-input-wrapper">
                    <input type="text" id="txtTitulo" name="txtTitulo" placeholder="Título" required>
                    <p>0/100</p>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="categoria">Categoria da atividade do evento</label>
                <select name="categoriaAtividade" required>        
                    <option selected disabled="disabled" hidden>Escolha uma opção</option>
                    <?php          
                        $categoriasAtividades = "SELECT * FROM CATATV ORDER BY CATATV_Codigo ASC";      
                        $queryCategoriasAtividades = $mysqli->query($categoriasAtividades) or die(mysql_error());

                        while($categoriaAtividade = mysqli_fetch_array($queryCategoriasAtividades)){
                            $catatv_codigo = $categoriaAtividade['CATATV_Codigo'];
                            $catatv_descricao = $categoriaAtividade['CATATV_Descricao'];
                            
                            echo "<option value=".$catatv_codigo.">". $catatv_descricao."</option>";                                                                   
                        }
                    ?>                                                           
                </select>
            </div>

            <div class="input-wrapper">
                <label for="">Descrição do evento</label>
                <div class="desc-input-wrapper">
                    <textarea id="txtDescricao" name="txtDescricao" placeholder="Ex: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget ligula aliquet, iaculis est eu, ornare velit. Cras vestibulum venenatis blandit." required></textarea>
                    <p>0/600</p>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="">Localização do evento</label>
                <div class="local-input-wrapper">
                    <input type="text" name="txtLocalizacao" placeholder="Ex: Rua José das cruzes 112, Pinhais" required>
                    <ion-icon name="location-sharp"></ion-icon>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="">Referência</label>
                <div class="local-input-wrapper">
                    <input type="text" name="" id="" placeholder="Ex: Próximo ao supermercado Condor" >
                    <ion-icon name="pin-outline"></ion-icon>
                </div>
            </div>
            
            <div class="input-wrapper">
                <label for="">Data do evento</label>
                <div class="local-input-wrapper">
                    <input type="date" id="dataAtividade" name="dataAtividade" placeholder="dd/mm/yyyy" required>
                    <ion-icon name="calendar-clear-outline"></ion-icon>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="">Horário do evento</label>
                <div class="time-input-wrapper">
                    <input type="time" id="horaAtividade" name="horaAtividade" placeholder="--:--" >
                    <ion-icon name="time-outline"></ion-icon>
                </div>
            </div>
                        
            <button id="submitButton" type="submit">Publicar</button>
        </form>

        <footer>
            <?php 
                $assets_path = '../../../ASSETS';
                include '../../templates/footers/navBar.php' 
            ?>
        </footer>
    </div>
        
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!--Script-->        
    <script type="text/javascript" src="../../../JAVASCRIPT/functions.js"></script>
    
</body>
</html>