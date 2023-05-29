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
        
        <div class="modal-product" style="display: none;">

            <div class="product-wrapper wrapper">                
                <div class="instructor">
                    <img src="../../assets/bibo.png" alt="instrutor image" style="cursor:pointer"/>
                    <a href="#" class="user">Loja</a>
                </div>
            </div>

            <div class="product-wrapper wrapper">                
                <ion-icon name="pricetag-outline"></ion-icon>
                <h3>Nome do Produto</h3>
            </div>

            <div class="img-wrapper wrapper">
                <img src="../../ASSETS/paisagem.png" alt="post-image" style="cursor:pointer"/>
            </div>
            
            <div class="desc-wrapper wrapper">
                <h2>Valor</h2>
                <p>Valor do Produto</p>
            </div>                        

            <button id="btnSite" type="button" onclick="" style="cursor:pointer">Visitar Anúncio</button>

            <button type="button" onclick="location.reload();" style="cursor:pointer">Fechar</button>      
        </div>

    </div>

    <div id="app">
        <h1 id="page-title">Meus Anúncios</h1>

        <!-- //Imprime as Categorias para Filtrar a Aplicação -->
        <header class="activities-list flex">
            <?php include('../templates/categorias_anuncio.php');
            ?>
        </header>
    
        <main>            
            
            <!--Barra de Pesquisa-->            
            <form id="barraPesquisa" class = "form" name="barraPesquisa" <?php 
                if(isset($_GET['categoriafiltrada'])){?>
                    action="./anuncio.php?categoriafiltrada=<?php echo $categoriafiltrada;?>" 
                    <?php
                }else{?>
                    action="./anuncio.php"
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
                
                <div class="title-wrapper">
                    <h2>Anúncios(<?php echo $queryProdutos->num_rows;?>)</h2>
                </div>

                <?php
                if ($queryProdutos->num_rows > 0){
                    while($produto = mysqli_fetch_array($queryProdutos)){?>
                        <div class="event">                                            
                            <?php                                
                                //Carrega o apelido/fantasia do Criador do Anúncio
                                $usuario = $produto['TABUSU_Codigo'];
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
                                                                                              
                            ?>

                            <div class="produto-post">                                
                                <img src="<?php echo $produto['TABPRO_Imagem'];?>" 
                                onclick="modalProductView('<?php echo $produto['TABPRO_Nome']; ?>','<?php echo $produto['TABPRO_Imagem']?>', <?php echo $produto['TABPRO_Valor']; ?>, '<?php echo $nomeIcon;?>', <?php echo $produto['TABUSU_Codigo']?>,'<?php echo $apelido?>', '<?php echo $produto['TABPRO_Url'] ?>');" style="cursor: pointer;"/>
                            </div>

                            <a class="sm" style="cursor: pointer;" onclick="modalProductView('<?php echo $produto['TABPRO_Nome']; ?>','<?php echo $produto['TABPRO_Imagem']?>', <?php echo $produto['TABPRO_Valor']; ?>, '<?php echo $nomeIcon;?>', <?php echo $produto['TABUSU_Codigo']?>,'<?php echo $apelido?>', '<?php echo $produto['TABPRO_Url'] ?>');" style="cursor: pointer;">                            
                                Saiba mais                                        
                            </a>
                            

                            <?php
                            if($_SESSION['CODIGO'] == $produto['TABUSU_Codigo']){?>                            
                                
                                <a href="./anuncio_update.php?codigo=<?php echo $produto['TABPRO_Codigo'];?>" style="cursor: pointer;">Editar Anúncio</a>

                                
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
                include '../templates/footers/navBarAnuncio.php';                
            ?>
        </footer>
    </div>
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>        
    <script>

        function apagarProduto(nome, codigo){
            let text = "Confirma apagar o anúncio " + nome + "?";
            if (confirm(text) == true) {
                window.location.href = "./anuncio_delete.php?codigo="+codigo; 
            }  
        }

        bgblur = document.querySelector(".background-blur")
        modalProduct = document.querySelector(".modal-product")
        modalPost = document.querySelector(".modal-post")               

        function modalProductView(nome, imagem, valor, imgIcon, perfil, usuario, url) {
            var title = document.querySelector(".title-post h3")
            title.innerHTML = nome    
            var btnShop = document.querySelector("#btnSite")
            btnShop.setAttribute("onclick", "location.href='"+ url + "';")
            var image = document.querySelector(".img-wrapper img")
            image.setAttribute("onclick", "location.href='"+ url + "';")
            image.setAttribute("src", imagem)          
            var value = document.querySelector(".desc-wrapper p")
            value.innerHTML = "R$" + valor                                                                                                                   
            var icon = document.querySelector(".instructor-wrapper img")
            if (imgIcon != ''){
                icon.setAttribute("src", "../perfil/arquivos/"+imgIcon)
            }else{
                icon.setAttribute("src", "../../ASSETS/buttonPerfil.svg")
            } 
            var user = document.querySelector(".user")   
            icon.setAttribute("onclick", "location.href='../perfil/perfil.php?perfil=" + perfil + "';")
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