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
        $sqlLojista = "SELECT * FROM TABLOJ WHERE TABUSU_Codigo = " . $_SESSION['CODIGO'];
        $querySqlLojista = $mysqli->query($sqlLojista) or die("Falha na execução do código sql" . $mysqli->error);
        if($querySqlLojista->num_rows == 1){
            $lojista_data = mysqli_fetch_assoc($querySqlLojista);
            $fantasia = $lojista_data['TABLOJ_Fantasia'];            
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
    <link rel="icon" href="../../../ASSETS/icon.ico"/>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body>
    <!--Cabeçalho-->
    <div id="app">
        <header>
            <button style="cursor: pointer;" onclick="location.href='../../perfil/perfil.php';"><img src="../../../ASSETS/backButtonDark.svg" alt="back-button"></button>
            <img src="../../../ASSETS/Logo.png" alt="logo" onclick="location.href='../../home/home.php'" class="logo" style="cursor: pointer;">
        </header>
        
        <!--Formulário-->    
        <form id="formUpdatePerfil" name="formUpdatePerfil" action="./update_lojistaPHP.php" method="POST" enctype="multipart/form-data">            
            <div class="type-publi">
                <!--<h3>Grupo</h3>

                <div id="switch" onclick="togglePubliType()">
                    <button></button>
                    <span></span>
                </div>-->

                <h3 class="selected">Editar Perfil</h3>
            </div>
            
            <div class="input-wrapper">
                <label>Fantasia*</label>
                <input type="text" id="txtFantasia" name="txtFantasia" placeholder="Fantasia" class="title-input-wrapper" 
                    <?php 
                        if(isset($_GET['fantasiaIns'])){?>
                            value="<?php echo $_GET['fantasiaIns'];?>"
                            <?php
                        }else{?>
                            value="<?php echo $fantasia;?>"
                            <?php
                        }                    
                    ?>
                onchange="verificaFantasia();"
                pattern="^[A-z]\w{3,29}$" 
                title="Fantasia deve começar com uma letra e não pode conter símbolos, deve possuir no mínimo 4 caracteres e no máximo 30 caracteres!" required/>
                <small id="errorFantasia" style="color: #DB5A5A; margin-left: 0.6rem; margin-top: 0.4rem;"></small>
            </div>                                 

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
                            <img id="imagemSelecionada" src="../../perfil/arquivos/<?php echo $nomeImagem;?>" style="max-width: 8rem; max-height: 8rem;" class="uploadIcon">                    
                        <?php
                        }                    
                    ?>                                          
                    <input type="file" id="imgPerfil" name="imgPerfil" accept="image/*" onchange="validaImagem(this);"> 
                </label>
            </div>
            
            <button type="submit" id="submitButton">Confirmar Alterações</button>

            <center>
                <div id="apagar-perfil">
                    <button type="button" onclick="apagarPerfil();" style="padding: .4rem .8rem; background: red; color: var(--white); border: none; border-radius: .4rem">Apagar Perfil</button>               
                </div>
            </center>

            <!--Imprime Erros se Houver-->
            <?php
                if(isset($_GET['error'])){                
                    $error = $_GET['error'];                
                    switch ($error){
                        case 002:?>
                            <script type="text/javascript">
                                //Cria Variáveis
                                let txtFantasia = document.getElementById('txtFantasia');                            
                                let errorFantasia = document.getElementById('errorFantasia');                                                                                                                  
                                
                                txtFantasia.style.border = "1px solid #DB5A5A"; 
                                errorFantasia.style.color = "#DB5A5A";                           
                                errorFantasia.innerHTML = "Fantasia já cadastrada!";   
                                txtFantasia.focus();                                                                        
                            </script>
                            <?php
                            break;                     
                    }
                }
            ?>

        </form>        

        <footer>    
            <?php 
                $assets_path = '../../../ASSETS';
                include '../../templates/footers/navBarPerfilUpd.php'  
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
                location.href = "./delete_lojista.php";
            }
        }

        function verificaFantasia(){
            var txtFantasia = document.getElementById("txtFantasia");
            var errorFantasia = document.getElementById("errorFantasia");            
            var fantasiaInserida = document.getElementById("txtFantasia").value;               
                            
            $.ajax({                
                url: '../../verificacoes/validaApelido.php?apelido='+fantasiaInserida,
                method: 'get',
                dataType: 'text',
                data: fantasiaInserida,                
            }).done(function(data){
                console.log(data);      
                if($.trim(data) == ""){
                    $("#errorFantasia").html("Fantasia disponível!"); 
                    $('#txtFantasia').css('border', '1px solid green');
                    $('#errorFantasia').css('color', 'green');                        
                }else{
                    if($("#txtFantasia").val() != <?php echo $fantasia;?>){
                        $("#errorFantasia").html("Fantasia já cadastrada!"); 
                        $('#txtFantasia').css('border', '1px solid #DB5A5A');
                        $('#errorFantasia').css('color', '#DB5A5A');
                    }
                } 
            });
        }
    </script>
</body>
</html>