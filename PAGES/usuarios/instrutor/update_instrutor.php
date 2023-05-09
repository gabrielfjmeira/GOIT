<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../index.php?error=4");
    }
    
    //Carrega o Registro do Banco
    $sqlUser = "SELECT * FROM TABUSU WHERE TABUSU_Codigo = " . $_SESSION['CODIGO'];
    $querySqlUser = $mysqli->query($sqlUser) or die("Falha na execução do código sql" . $mysqli->error);
    if ($querySqlUser->num_rows == 1){
        $user_data = mysqli_fetch_assoc($querySqlUser);                
        $email = $user_data['TABUSU_Email'];                
        $sqlInstrutor = "SELECT * FROM TABINS WHERE TABUSU_Codigo = " . $_SESSION['CODIGO'];
        $querySqlInstrutor = $mysqli->query($sqlInstrutor) or die("Falha na execução do código sql" . $mysqli->error);
        if($querySqlInstrutor->num_rows == 1){
            $instrutor_data = mysqli_fetch_assoc($querySqlInstrutor);
            $nome = $instrutor_data['TABINS_Nome'];
            $apelido = $instrutor_data['TABINS_Apelido'];
            $dataNascimento = $instrutor_data['TABINS_DataNascimento'];
            $categoria = $instrutor_data['TABINS_Categoria'];
        }else{
            header ("Location: ../../perfil/perfil.php");    
        }
    }else{
        header ("Location: ../../perfil/perfil.php");
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
        <form id="formUpdatePerfil" name="formUpdatePerfil" action="./update_instrutorPHP.php" method="POST" enctype="multipart/form-data">            
            <div class="type-publi">
                <!--<h3>Grupo</h3>

                <div id="switch" onclick="togglePubliType()">
                    <button></button>
                    <span></span>
                </div>-->

                <h3 class="selected">Editar Perfil</h3>
            </div>

            <div class="input-wrapper">
                <label>Nome completo*</label>
                <input type="text" id="txtNome" name="txtNome" placeholder="Nome" class="input" value="<?php echo $nome;?>"
                pattern="^[A-Z]([a-z] || [ã] || [é] || [ô])+[\s]*(([A-Z]||[a-z])([a-z] || [ã] || [é] || [ô])+[\s]*){0,}$" 
                title="Nome só deve conter letras e deve possuir no mínimo 3 caracteres e no máximo 100 caracteres!" required/>
                <small id="errorNome" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
            </div>

            <div class="input-wrapper">
                <label>Apelido*</label>
                <input type="text" id="txtApelido" name="txtApelido" placeholder="Apelido" class="input" value="<?php echo $apelido;?>"
                pattern="^[A-z]\w{3,29}$" 
                title="Apelido deve começar com uma letra e não pode conter símbolos, deve possuir no mínimo 4 caracteres e no máximo 30 caracteres!" required/>
                <small id="errorApelido" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
            </div>         

            <div class="input-wrapper">
                <label>Data de Nascimento*</label>
                <input type="date" id="dataNascimento" name="dataNascimento" placeholder="dd/mm/aaaa" class="input" 
                title="dd/mm/aaaa" value="<?php echo $dataNascimento;?>" required/>
            </div>

            <div class="input-wrapper">
                <label>Categoria em que atua*</label>
                <select id="catInstrutor" name="catInstrutor" required>        
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
                <label>Email*</label>
                <input type="text" id="txtEmail" name="txtEmail" placeholder="email@email.com" class="input" value="<?php echo $email;?>"
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
                            errorApelido.style.color = "#DB5A5A";                           
                            errorApelido.innerHTML = "Apelido já cadastrado!";   
                            txtApelido.focus();                                                                        
                        </script>
                        <?php
                        break;
                    case 002:?>
                        <script type="text/javascript">
                            //Cria Variáveis
                            let txtEmail = document.getElementById('txtEmail');                            
                            let errorEmail = document.getElementById('errorEmail');                                                                                                                  
                            
                            txtEmail.style.border = "1px solid #DB5A5A"; 
                            errorEmail.style.color = "#DB5A5A";                           
                            errorEmail.innerHTML = "Email já cadastrado!";   
                            txtEmail.focus();                                                                        
                        </script>
                        <?php
                        break; 
                }
            }
        ?>

            <div class="input-wrapper">
                <label for="">Upload da Imagem do Perfil</label>
                <label for="imgPerfil" class="uploadImage-input-wrapper">  
                    <?php
                        if(is_null($user_data['TABUSU_Icon'])){?>
                            <img id="imagemSelecionada" src="../../../ASSETS/uploadIcon.svg" style="max-width: 8rem; max-height: 8rem;" class="uploadIcon">                    
                        <?php
                        }else{
                            if(substr($user_data['TABUSU_Icon'], -4) == ".jpg" || substr($user_data['TABUSU_Icon'], -4) == ".png" ){
                                $nomeImagem = substr($user_data['TABUSU_Icon'], -17);
                            }else{
                                $nomeImagem = substr($user_data['TABUSU_Icon'], -18);
                            };  
                            ?>
                            <img id="imagemSelecionada" src="../arquivos/<?php echo $nomeImagem;?>" style="max-width: 8rem; max-height: 8rem;" class="uploadIcon">                    
                        <?php
                        }                    
                    ?>                                          
                    <input type="file" id="imgPerfil" name="imgPerfil" accept="image/*" onchange="validaImagem(this);"> 
                </label>
            </div>
            
            <button type="submit">Confirmar Alterações</button>

            <div id="apagar-perfil">
                <button type="button" onclick="apagarPerfil();">Apagar Perfil</button>               
            </div>

        </form>
        
        <footer>
                <?php 
                    $assets_path = '../../../ASSETS';
                    include '../../templates/footers/navBarPerfil.php'  
                ?>
        </footer>

    </div>
        
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>   
    <script src="../../../JAVASCRIPT/functions.js"></script>
    <script>
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

        function apagarPerfil(){
            let text = "Deseja apagar seu perfil?\nEsta ação é IRREVERSÍVEL!!!";
            if (confirm(text) == true) {
                location.href = "./delete_instrutor.php";
            }
        }
    </script>
</body>
</html>