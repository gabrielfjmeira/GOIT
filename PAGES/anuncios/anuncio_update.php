<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../index.php?error=4");
    }   
    //Carrega o Registro do Banco
    if (isset($_GET['codigo'])){
        $codigo = $_GET['codigo'];

        $produto = "SELECT * FROM TABPRO WHERE TABPRO_Codigo = $codigo";
        $queryproduto = $mysqli->query($produto) or die("Falha na execução do código sql" . $mysqli->error);
        if ($queryproduto->num_rows == 1){
            $produto_data = mysqli_fetch_assoc($queryproduto);
            $nome = $produto_data['TABPRO_Nome'];
            $valor = $produto_data['TABPRO_Valor'];
            $categoria = $produto_data['CATATV_Codigo'];
            $url = $produto_data['TABPRO_Url'];
            $imagem = $produto_data['TABPRO_Imagem'];
        }else{
            header ("Location: ./anuncio.php");
        }

    }else{
        header ("Location: ./anuncio.php");
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
                    onclick="location.href='../../perfil/perfil.php'" 
                <?php
                }else{?>
                    onclick="location.href='../../home/home.php'" 
                <?php
                }            
            ?>   
            style="cursor: pointer;">  
        </header>
        
        <!--Formulário-->    
        <form id="formUpdateAnuncio" name="formUpdateAnuncio" action="anuncio_updatePHP.php" method="POST" enctype="multipart/form-data" onsubmit="return formUpdateAnuncioOnSubmit();">
            <div class="type-publi">
                <h3 class="selected">Publicar Anúncio</h3>
            </div>
            <input type="number" name="codProduto" id="codProduto" value = <?php echo $codigo; ?> hidden/>

            <div class="input-wrapper">
                <label for="title-post">Nome*</label>
                <div class="title-input-wrapper">
                    <input type="text" id="txtNome" name="txtNome" placeholder="Nome" value = "<?php echo $nome; ?>"
                    pattern="^.{5, 100}$" 
                    title="Nome deve possuir no mínimo 5 caracteres e no máximo 100 caracteres!" required/>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="categoriaProduto">Categoria do Produto</label>
                <select name="categoriaProduto" required>
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
                <label for="">Upload da imagem do produto</label>
                <label for="imgProduto" class="uploadImage-input-wrapper">                        
                    <img id="imagemSelecionada" src="<?php echo $imagem; ?>" style="max-width: 8rem; max-height: 8rem;" class="uploadIcon">                    
                    <input type="file" id="imgProduto" name="imgProduto" accept="image/*" onchange="validaImagem(this);" /> 
                </label>
            </div>

            <div class="input-wrapper">
                <label for="">Valor*</label>
                <div class="title-input-wrapper">
                    <input type="number" id="nbrValor" name="nbrValor" step="any" min="1" max="99999.99" placeholder="Ex: 49.99" value=<?php echo $valor;?> required/>                    
                    <small id="errorValor" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="txtURL">URL Produto*</label>
                <div class="title-input-wrapper">
                    <input type="text" id="txtURL" name="txtURL" placeholder="URL" value = "<?php echo $url; ?>" required/>
                </div>
            </div>


            <button id="submitButton" type="submit">Confirmar Alterações</button>
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

        function formUpdateAnuncioOnSubmit(){
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