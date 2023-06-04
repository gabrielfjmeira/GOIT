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
        <form id="formInsertAnuncio" name="formInsertAnuncio" action="anuncio_insertPHP.php" method="POST" enctype="multipart/form-data" onsubmit="return formInsertAnuncioOnSubmit();">
            <div class="type-publi">
                <h3 class="selected">Publicar Anúncio</h3>
            </div>

            <div class="input-wrapper">
                <label for="title-post">Nome*</label>
                <div class="title-input-wrapper">
                    <input type="text" id="txtNome" name="txtNome" placeholder="Nome" 
                    pattern="^.{5, 100}$" 
                    title="Nome deve possuir no mínimo 5 caracteres e no máximo 100 caracteres!" required/>
                </div>
            </div>

            <div class="input-wrapper">
            <label for="categoria">Categoria do Produto*</label>
                <select id="categoriaProduto" name="categoriaProduto" required>        
                    <option selected disabled="disabled" hidden>Escolha uma opção</option>
                    <?php          
                        $categoriasAtividades = "SELECT * FROM CATATV ORDER BY CATATV_Descricao ASC";      
                        $queryCategoriasAtividades = $mysqli->query($categoriasAtividades) or die(mysql_error());

                        while($categoriaAtividade = mysqli_fetch_array($queryCategoriasAtividades)){
                            $catatv_codigo = $categoriaAtividade['CATATV_Codigo'];
                            $catatv_descricao = $categoriaAtividade['CATATV_Descricao'];
                            
                            echo "<option value=".$catatv_codigo.">". $catatv_descricao."</option>";                                                                   
                        }
                    ?>                                                           
                </select>
                <small id="errorCategoriaProduto" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
            </div>            

            <!--Imprime Erros se Houver-->
            <?php
                if(isset($_GET['error'])){
                    $error = $_GET['error'];
                    switch ($error){
                        case 001:?>
                            <script type="text/javascript">
                                //Cria Variáveis
                                let categoriaProduto = document.getElementById('categoriaProduto');                            
                                let errorCategoriaProduto = document.getElementById('errorCategoriaProduto');                                                                                                                  
                                
                                categoriaProduto.style.border = "1px solid #DB5A5A";                            
                                errorCategoriaProduto.innerHTML = "Selecione uma categoria!";   
                                categoriaProduto.focus();                                                                        
                            </script>
                            <?php
                            break;
                    }
                }
            ?>

            <div class="input-wrapper">
                <label for="">Upload da imagem do produto</label>
                <label for="imgProduto" class="uploadImage-input-wrapper">                        
                    <img id="imagemSelecionada" src="../../ASSETS/uploadIcon.svg" style="max-width: 8rem; max-height: 8rem;" class="uploadIcon">                    
                    <input type="file" id="imgProduto" name="imgProduto" accept="image/*" onchange="validaImagem(this);" required/> 
                </label>
            </div>

            <div class="input-wrapper">
                <label for="">Valor*</label>
                <div class="title-input-wrapper">
                    <input type="number" id="nbrValor" name="nbrValor" step="any" min="1" max="99999.99" placeholder="Ex: 49.99" required/>                    
                    <small id="errorValor" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="txtURL">URL Produto*</label>
                <div class="title-input-wrapper">
                    <input type="text" id="txtURL" name="txtURL" placeholder="URL" required/>
                </div>
            </div>

            <button id="submitButton" type="submit">Publicar</button>
        </form>

        <footer>
            <?php 
                $assets_path = '../../ASSETS';
                include '../templates/footers/navBarAddAnuncio.php' 
            ?>
        </footer>
    </div>
        
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script type="text/javascript">
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

        function formInsertAnuncioOnSubmit(){
            //Cria Variáveis
            let nbrValor = document.getElementById('nbrValor');
            let errorValor = document.getElementById('errorValor');           
            
            if (nbrValor.value <= 0){
                nbrValor.style.border = "1px solid #DB5A5A";
                errorValor.innerHTML = "Valor deve ser um número positivo superior a 0!";
                nbrValor.focus();
                return false;
            }else{
                errorValor.innerHTML = "";
            }                                                       
                        
            return true;
        }

    </script>   
    
</body>
</html>