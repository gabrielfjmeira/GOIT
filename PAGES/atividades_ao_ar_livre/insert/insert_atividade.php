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
            <button style="cursor: pointer;" onclick="window.history.back();"><img src="../../../ASSETS/backButtonDark.svg" alt="back-button"></button>
            <img src="../../../ASSETS/Logo.png" alt="logo" class="logo">
        </header>
        
        <!--Formulário-->    
        <form id="formInsertAtividade" name="formInsertAtividade" action="insert_atividadePHP.php" method="POST" enctype="multipart/form-data" onsubmit="return formInsertAtividadeOnSubmit();">
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
                    <input type="text" id="txtTitulo" name="txtTitulo" placeholder="Título" 
                    pattern="^.{5, 100}$" 
                    title="Título deve possuir no mínimo 5 caracteres e no máximo 100 caracteres!" required/>
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
                <label for="">Descrição</label>
                <div class="desc-input-wrapper">
                    <textarea id="txtDescricao" name="txtDescricao" placeholder="Ex: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget ligula aliquet, iaculis est eu, ornare velit. Cras vestibulum venenatis blandit." required></textarea>
                    <p>0/600</p>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="">Upload da Imagem do evento</label>
                <label for="imgAtividade" class="uploadImage-input-wrapper">                        
                    <img id="imagemSelecionada" src="../../../ASSETS/uploadIcon.svg" style="max-width: 8rem; max-height: 8rem;" class="uploadIcon">
                    <input type="hidden" name="MAX_FILE_SIZE" value="16777215" />
                    <input type="file" id="imgAtividade" name="imgAtividade" accept="imagem/*" onchange="validaImagem(this);"> 
                </label>
            </div>

            <div class="input-wrapper">
                <label for="">Endereço</label>
                <div class="local-input-wrapper">
                    <input type="text" name="txtLocalizacao" placeholder="Ex: Rua José das cruzes 112, Pinhais" 
                    pattern="^.{, 100}$" 
                    title="Endereço deve possuir no máximo 100 caracteres!" required/>
                    <ion-icon name="location-sharp"></ion-icon>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="">Referência</label>
                <div class="local-input-wrapper">
                    <input type="text" name="txtReferencia" id="txtReferencia" placeholder="Ex: Próximo ao supermercado Condor" 
                    pattern="^.{, 50}$"
                    title="Referência deve possuir no máximo 50 caracteres!"/>
                    <ion-icon name="pin-outline"></ion-icon>
                </div>
            </div>
            
            <div class="input-wrapper">
                <label for="">Data</label>
                <div class="local-input-wrapper">
                    <input type="date" id="dataAtividade" name="dataAtividade" placeholder="dd/mm/yyyy" required>
                    <ion-icon name="calendar-clear-outline"></ion-icon>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="">Horário</label>
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
                include '../../templates/footers/navBarAddPub.php' 
            ?>
        </footer>
    </div>
        
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script type="text/javascript">
        //Limite de data Mínima para Criação de Atividade ao Ar Livre
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //Janeiro é 0!
        var yyyy = today.getFullYear();

        if (dd < 10) {
        dd = '0' + dd;
        }

        if (mm < 10) {
        mm = '0' + mm;
        } 
            
        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("dataAtividade").setAttribute("min", today);

        //Validação de Imagem
        function validaImagem(input) {
            var caminho = input.value;

            if (caminho) {
                var comecoCaminho = (caminho.indexOf('\\') >= 0 ? caminho.lastIndexOf('\\') : caminho.lastIndexOf('/'));
                var nomeArquivo = caminho.substring(comecoCaminho);

                if (nomeArquivo.indexOf('\\') === 0 || nomeArquivo.indexOf('/') === 0) {
                    nomeArquivo = nomeArquivo.substring(1);
                }

                var extensaoArquivo = nomeArquivo.indexOf('.') < 1 ? '' : nomeArquivo.split('.').pop();

                if (extensaoArquivo != 'png' &&
                    extensaoArquivo != 'jpg' &&
                    extensaoArquivo != 'jpeg') {
                    input.value = '';
                    alert("É preciso selecionar um arquivo de imagem (png, jpg ou jpeg)");
                }
            } else {
                input.value = '';
                alert("Selecione um caminho de arquivo válido");
            }
            if (input.files && input.files[0]) {
                var arquivoTam = input.files[0].size / 1024 / 1024;
                if (arquivoTam < 16) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagemSelecionada').setAttribute('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    input.value = '';
                    alert("O arquivo precisa ser uma imagem com menos de 16 MB");
                }
            } else{
                document.getElementById('imagemSelecionada').setAttribute('src', '#');
            }
        }
    </script>   
    
</body>
</html>