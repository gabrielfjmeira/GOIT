<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../index.php?error=4");
    }   

    //Conteúdo Pesquisado
    if(isset($_POST['searchTXT'])){
        $conteudoPesquisado = $_POST['searchTXT'];
    }

    //Categoria Filtrada
    if(isset($_GET['categoriafiltrada'])){
        $categoriafiltrada = $_GET['categoriafiltrada'];        
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Configurações-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">      
    <link rel="stylesheet" href="../../CSS/home.css">
    <link rel="icon" href="../../ASSETS/icon.ico"/>

    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>

<body>
    
    <div class="background-blur" style="display: none;" onclick="exitModal();">
        
        <div class="modal-post" style="display: none;">
            <div class="title-post">                
                <ion-icon name="calendar-clear"></ion-icon>
                <h3>Nome do Produto</h3>
            </div>

            <img src="../../ASSETS/paisagem.png" alt="post-image">

            <div class="desc-wrapper wrapper">
                <h2>Descrição</h2>
                <p>Descrição do Produto</p>
            </div>

            <div class="instructor-wrapper wrapper">
                <h2>Anunciante <ion-icon name="man"></ion-icon> </h2>
                <div class="instructor">
                    <img src="../../assets/bibo.png" alt="instrutor image">
                    <a href="#" class="user">Loja</a>
                </div>
            </div>

            <button type="button" onclick="location.reload();">Fechar</button>      
        </div>

    </div>

    <div id="app">
        <h1 id="page-title">Meus Anúncios</h1>

        <!-- //Imprime as Categorias para Filtrar a Aplicação -->
        <header class="activities-list flex">
            <?php include('../templates/categorias.php');
            ?>
        </header>
    
        <main>            
            
            <!--Barra de Pesquisa-->            
            <form id="barraPesquisa" class = "form" name="barraPesquisa" <?php 
                if(isset($_GET['categoriafiltrada'])){?>
                    action="./home.php?categoriafiltrada=<?php echo $categoriafiltrada;?>" 
                    <?php
                }else{?>
                    action="./home.php"
                    <?php
                }
            ?> method="POST">
                <div class="search-wrapper flex" style="cursor: pointer;">
                    <ion-icon name="search-outline"></ion-icon>
                    <?php 
                    if(isset($_POST['searchTXT']) && $conteudoPesquisado <> ""){?>
                        <input type="text" id="search-input" name="searchTXT" value="<?php echo $conteudoPesquisado;?>">
                        <?php 
                    }else{?>
                        <input type="text" id="search-input" name="searchTXT" placeholder="Pesquisar">
                        <?php
                    }?>
                    <button type="Submit"> Buscar </button>
                </div>
            </form>                                   

            <section class="eventsAndGroups flex">

                <?php              
                
                //Imprime Meus Anúncios        
                if(isset($_POST['searchTXT']) && $conteudoPesquisado <> ""){
                    if(isset($_GET['categoriafiltrada'])){
                        $produtos= "SELECT * FROM TABPRO WHERE CATATV_Codigo = $categoriafiltrada  AND TABPRO_Nome LIKE '%$conteudoPesquisado%' AND TABUSU_Codigo = ".$_SESSION['CODIGO']. " ORDER BY TABPRO_Nome ASC";
                    }else{
                        $produtos= "SELECT * FROM TABPRO WHERE TABPRO_Nome LIKE '%$conteudoPesquisado%' AND TABUSU_Codigo = ".$_SESSION['CODIGO']. " ORDER BY TABPRO_Nome ASC";
                    }                    
                }else{
                    if(isset($_GET['categoriafiltrada'])){
                        $produtos= "SELECT * FROM TABPRO WHERE CATATV_Codigo = $categoriafiltrada AND TABUSU_Codigo = ".$_SESSION['CODIGO']. " ORDER BY TABPRO_Nome ASC";
                    }else{
                        $produtos= "SELECT * FROM TABPRO WHERE TABUSU_Codigo = ".$_SESSION['CODIGO']. " ORDER BY TABPRO_Nome ASC";                   
                    }                    
                }
                
                $queryProdutos = $mysqli->query($produtos) or die(mysql_error());
                $postagem = 0;?>

                <br> <button onclick="location.href='./anuncio_insert.php';">Publicar Anúncio</button> 
                <a href="./anuncio_insert.php">Publicar Anúncio</a>
                <br>
                <div class="title-wrapper">
                    <h2>Anúncios(<?php echo $queryProdutos->num_rows;?>)</h2>
                </div>

                <?php
                if ($queryProdutos->num_rows > 0){
                    while($produto = mysqli_fetch_array($queryProdutos)){?>
                        <div class="event">
                            <div class="title-post">                                
                                <h5><?php echo $produtos['TABPRO_Nome'];?></h5>
                                <ion-icon name="calendar-clear"></ion-icon>
                            </div>
                
                            <?php                                
                                //Carrega o apelido/fantasia do Criador da Atividade ao Ar Livre
                                $usuario = $atividade['TABUSU_Codigo'];
                                $registroUsuario = "SELECT * FROM TABUSU WHERE TABUSU_Codigo = $usuario";                       
                                $queryRegistroUsuario = $mysqli->query($registroUsuario) or die(mysql_error());
                                $usuario_data = mysqli_fetch_array($queryRegistroUsuario);
                                $tipousuario = $usuario_data['TIPUSU_Codigo'];

                                if(substr($usuario_data['TABUSU_Icon'], -4) == ".jpg" || substr($usuario_data['TABUSU_Icon'], -4) == ".png" ){
                                    $nomeIcon = substr($usuario_data['TABUSU_Icon'], -17);
                                }else{
                                    $nomeIcon = substr($usuario_data['TABUSU_Icon'], -18);
                                }; 

                                $lojista = "SELECT * FROM TABLOJ WHERE TABUSU_Codigo = $usuario";
                                $queryLojista = $mysqli->query($lojista) or die(mysql_error());
                                $lojista_data = mysqli_fetch_array($queryLojista);
                                $apelido = $lojista_data['TABLOJ_Fantasia'];
                                $postagem += 1; 

                                if(substr($produto['TABPRO_Imagem'], -4) == ".jpg" || substr($produto['TABPRO_Imagem'], -4) == ".png" ){
                                    $nomeImagem = substr($produto['TABPRO_Imagem'], -17);
                                }else{
                                    $nomeImagem = substr($produto['TABPRO_Imagem'], -18);
                                };

                                $descricao_bd = str_replace("\n", '', $produto['TABPRO_Descricao']);                                
                                $descricao_sm = str_replace("\r", '', $descricao_bd);                                
                            ?>

                            <a class="sm" style="cursor: pointer;" onclick="modalPostView('<?php echo $produto['TABPRO_Nome']; ?>','<?php echo $nomeImagem;?>', '<?php echo $descricao_sm; ?>', '<?php echo $nomeIcon;?>', <?php echo $produto['TABUSU_Codigo']?>,'<?php echo $apelido?>');" style="cursor: pointer;">                            
                                Saiba mais                                        
                            </a>
                            

                            <?php
                            if($_SESSION['CODIGO'] == $produto['TABUSU_Codigo']){?>                            
                                
                                <a href="../atividades_ao_ar_livre/update/update_atividade.php?codigo=<?php echo $atividade['TABATV_Codigo'];?>" style="cursor: pointer;">Editar Anúncio</a>

                                
                                <a onclick="apagarProduto('<?php echo $produto['TABPRO_Nome']?>', <?php echo $produto['TABPRO_Codigo']?>)" style="cursor: pointer;">Excluir Anúncio</a>
                            <?php
                            }
                            ?>

                        </div><?php               
                    }                       
                }else{ ?>
            
                    <h3>Sem Anúncios Cadastrados!</h3>

                <?php 
                }
                ?>
            </section>
        </main>
        
        <footer>
            <?php 
                $assets_path = '../../ASSETS';
                include '../templates/footers/navBar.php';                
            ?>
        </footer>
    </div>
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>        
    <script>

        function apagarProduto(nome, codigo){
            let text = "Confirma apagar o anúncio " + nome + "?";
            if (confirm(text) == true) {
                window.location.href = "../atividades_ao_ar_livre/delete/delete_atividadePHP.php?codigo="+codigo; 
            }  
        }

        bgblur = document.querySelector(".background-blur")
        modalProduct = document.querySelector(".modal-product")
        modalPost = document.querySelector(".modal-post")

        function modalProductView() {
            bgblur.setAttribute("style" , "display: ")
            modalProduct.setAttribute("style" , "display: ")
        }        

        function modalPostView(nome, imagem, descricao, imgIcon, perfil, usuario) {
            var title = document.querySelector(".title-post h3")
            title.innerHTML = nome    
            var image = document.querySelector(".modal-post img")
            image.setAttribute("src", "./arquivos/"+imagem)          
            var description = document.querySelector(".desc-wrapper p")
            description.innerHTML = descricao                                                                                                                   
            var icon = document.querySelector(".instructor-wrapper img")
            if (imgIcon != ''){
                icon.setAttribute("src", "../perfil/arquivos/"+imgIcon)
            }else{
                icon.setAttribute("src", "../../ASSETS/buttonPerfil.svg")
            } 
            var user = document.querySelector(".user")   
            user.setAttribute("onclick", "location.href='../perfil/perfil.php?perfil=" + perfil + "';")         
            user.innerHTML = usuario          
            bgblur.setAttribute("style" , "display: ")
            modalPost.setAttribute("style" , "display: ")
        }   

        function exitModal(){
            bgblur.addEventListener("click", function(event){
                
                if(event.target.closest(".modal-product") || event.target.closest(".modal-post")){
                    return
                }
                else {
                    bgblur.setAttribute("style", "display: none;" )
                    modalProduct.setAttribute("style", "display: none;")
                    modalPost.setAttribute("style", "display: none;")
                }
            }); 
        }

    </script>
</body>
</html>