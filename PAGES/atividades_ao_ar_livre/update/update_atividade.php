<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../index.php?error=4");
    }
    
    //Carrega o Registro do Banco
    if (isset($_GET['codigo'])){
        $codigo = $_GET['codigo'];
        
        $atividade = "SELECT * FROM TABATV WHERE TABATV_Codigo = $codigo";
        $queryAtividade = $mysqli->query($atividade) or die("Falha na execução do código sql" . $mysqli->error);
        if ($queryAtividade->num_rows == 1){
            $atividade_data = mysqli_fetch_assoc($queryAtividade);
            $codigo = $atividade_data['TABATV_Codigo'];
            $titulo = $atividade_data['TABATV_Titulo'];
            $descricao = $atividade_data['TABATV_Descricao'];            
            $categoria = $atividade_data['CATATV_Codigo'];
            $localizacao = $atividade_data['TABATV_Localizacao'];
            $referencia = $atividade_data['TABATV_Referencia'];
            $inscritos = $atividade_data['TABATV_Inscritos'];
            $data = $atividade_data['TABATV_Data'];
            $hora = $atividade_data['TABATV_Hora'];
        }else{
            header ("Location: ../../home/home.php");
        }
        
    }else{
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
    <link rel="stylesheet" href="../../../CSS/publicarPostagem.css">    
    <link rel="icon" href="../../../ASSETS/icon.ico"/>

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
        <form id="formInsertAtividade" name="formInsertAtividade" action="update_atividadePHP.php" method="POST" enctype="multipart/form-data" onsubmit="return validaHora();">
            <input type="number" id="nbrCodigo" name="nbrCodigo" value="<?php echo $codigo;?>" hidden>  
            <div class="type-publi">
                    <!--<h3>Grupo</h3>

                    <div id="switch" onclick="togglePubliType()">
                        <button></button>
                        <span></span>
                    </div>-->

                    <h3 class="selected">Editar Atividade Ao Ar Livre</h3>
            </div>

            <div class="input-wrapper">
                <label for="title-post">Título*</label>
                <div class="title-input-wrapper">
                    <input type="text" id="txtTitulo" name="txtTitulo" placeholder="Título" value="<?php echo $titulo;?>"
                    pattern="^.{5, 100}$" 
                    title="Título deve possuir no mínimo 5 caracteres e no máximo 100 caracteres!" required/>
                    <p>0/100</p>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="categoria">Categoria da atividade do evento*</label>
                <select name="categoriaAtividade" required>        
                    <option disabled="disabled" hidden>Escolha uma opção</option>
                    <?php          
                        $categoriasAtividades = "SELECT * FROM CATATV ORDER BY CATATV_Codigo ASC";      
                        $queryCategoriasAtividades = $mysqli->query($categoriasAtividades) or die(mysql_error());

                        while($categoriaAtividade = mysqli_fetch_array($queryCategoriasAtividades)){
                            $catatv_codigo = $categoriaAtividade['CATATV_Codigo'];
                            $catatv_descricao = $categoriaAtividade['CATATV_Descricao'];
                            if($categoria == $catatv_codigo){
                                echo "<option value=".$catatv_codigo." selected>". $catatv_descricao."</option>";                                                                   
                            }else{
                                echo "<option value=".$catatv_codigo.">". $catatv_descricao."</option>";                                                                   
                            }                            
                        }
                    ?>                                                           
                </select>
            </div>

            <div class="input-wrapper">
                <label for="">Descrição*</label>
                <div class="desc-input-wrapper">
                    <textarea id="txtDescricao" name="txtDescricao" placeholder="Ex: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget ligula aliquet, iaculis est eu, ornare velit. Cras vestibulum venenatis blandit." required>
                        <?php echo str_replace("<br />", "", $descricao);?>
                    </textarea>
                    <p>0/600</p>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="">Upload da Imagem do evento</label>
                <label for="imgAtividade" class="uploadImage-input-wrapper">  
                    <?php
                        if(is_null($atividade_data['TABATV_Imagem'])){?>
                            <img id="imagemSelecionada" src="../../../ASSETS/uploadIcon.svg" style="max-width: 8rem; max-height: 8rem;" class="uploadIcon">                    
                        <?php
                        }else{
                            if(substr($atividade_data['TABATV_Imagem'], -4) == ".jpg" || substr($atividade_data['TABATV_Imagem'], -4) == ".png" ){
                                $nomeImagem = substr($atividade_data['TABATV_Imagem'], -17);
                            }else{
                                $nomeImagem = substr($atividade_data['TABATV_Imagem'], -18);
                            };  
                            ?>
                            <img id="imagemSelecionada" src="../arquivos/<?php echo $nomeImagem;?>" style="max-width: 8rem; max-height: 8rem;" class="uploadIcon">                    
                        <?php
                        }                    
                    ?>                                          
                    <input type="file" id="imgAtividade" name="imgAtividade" accept="image/*" onchange="validaImagem(this);"> 
                </label>
            </div>

            <div class="input-wrapper">
                <label for="">Endereço*</label>
                <div class="local-input-wrapper">
                    <input type="text" name="txtLocalizacao" placeholder="Ex: Rua José das cruzes 112, Pinhais" value="<?php echo $localizacao;?>"
                    pattern="^.{, 100}$" 
                    title="Endereço deve possuir no máximo 100 caracteres!" required/>
                    <ion-icon name="location-sharp"></ion-icon>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="">Referência</label>
                <div class="local-input-wrapper">
                    <input type="text" name="txtReferencia" id="txtReferencia" placeholder="Ex: Próximo ao supermercado Condor" value="<?php echo $referencia;?>"
                    pattern="^.{, 50}$" 
                    title="Referência deve possuir no máximo 50 caracteres!"/>
                    <ion-icon name="pin-outline"></ion-icon>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="">Número máximo de inscritos*</label>
                <div class="local-input-wrapper">
                    <input type="number" name="nbrInscritos" id="nbrInscritos" placeholder="Ex: 50" value=<?php echo $inscritos;?>
                    pattern="^[0-9]{1, 3}$"
                    title="Número máximo de inscritos deve possuir no máximo 3 casas decimais!" required/>                    
                </div>
            </div>
            
            <div class="input-wrapper">
                <label for="">Data</label>
                <div class="local-input-wrapper">
                    <input type="date" id="dataAtividade" name="dataAtividade" placeholder="dd/mm/yyyy" value="<?php echo $data;?>" required>
                    <ion-icon name="calendar-clear-outline"></ion-icon>
                </div>
            </div>

            <div class="input-wrapper">
                <label id="lblHorario" for="">Horário*</label>
                <div class="time-input-wrapper">
                    <input type="time" id="horaAtividade" name="horaAtividade" placeholder="--:--" value="<?php echo $hora;?>">
                    <ion-icon name="time-outline"></ion-icon>
                </div>
                <small id="errorTime" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
            </div>
                        
            <button id="submitButton" type="submit">Confirmar Alterações</button>
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
    <script>
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

        function validaHora(){
            var now = new Date(); 
            var dd = now.getDate();
            var mm = now.getMonth() + 1; //Janeiro é 0!
            var yyyy = now.getFullYear();

            if (dd < 10) {
            dd = '0' + dd;
            }

            if (mm < 10) {
            mm = '0' + mm;
            } 
            
            var nowDateTime = yyyy + '-' + mm + '-' + dd + " " + now.getTime();           
            var date = document.getElementById('dataAtividade');
            var time = document.getElementById('horaAtividade');
            var lblHorario = document.getElementById('lblHorario');
            var timeInput = document.querySelector('.time-input-wrapper');
            var datetime = date.value + " " + time.value+":00";

            if(datetime < nowDateTime){
                timeInput.style.border = "1px solid #DB5A5A";  
                lblHorario.style.color = "#DB5A5A";
                errorTime.style.color = "#DB5A5A";                          
                errorTime.innerHTML = "Horário precisa ser maior que o atual";                                                                       
                time.focus();
                return false;
            }            
            return true;
        }
    </script>
</body>
</html>