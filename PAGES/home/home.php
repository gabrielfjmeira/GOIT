<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../index.php?error=4");
    }   

    if($_SESSION['TIPOUSUARIO'] == 4){
        header ("Location: ../perfil/perfil.php");
    }

    //Conteúdo Pesquisado
    if(isset($_POST['searchTXT'])){
        $conteudoPesquisado = $_POST['searchTXT'];
    }

    //Categoria Filtrada
    if(isset($_GET['categoriafiltrada'])){
        $categoriafiltrada = $_GET['categoriafiltrada'];        
    }
    
    //Alerta o usuário se o mesmo está inscrito em uma atividade que foi cancelada
    $atividadesParticipadas = "SELECT * FROM PARATV WHERE TABUSU_Codigo = " . $_SESSION['CODIGO'] . ";";
    $queryAtividadesParticipadas = $mysqli->query($atividadesParticipadas) or die(mysql_error());
    if($queryAtividadesParticipadas->num_rows > 0){
        while($atividadesParticipadasData = mysqli_fetch_array($queryAtividadesParticipadas)){
            //Verifica se a atividade inscrita foi cancelada
            $verificacaoAtividade = "SELECT * FROM TABATV WHERE TABATV_Codigo = " . $atividadesParticipadasData['TABATV_Codigo'] . ";";
            $queryVerificacaoAtividade = $mysqli->query($verificacaoAtividade) or die(mysql_error());
            $verificacaoAtividadeData = mysqli_fetch_array($queryVerificacaoAtividade);

            if($verificacaoAtividadeData['TABATV_Cancelada'] == 1){?>
                <script>
                    alert('A atividade <?php echo $verificacaoAtividadeData['TABATV_Titulo'];?>, que ocorreria no dia <?php echo $verificacaoAtividadeData['TABATV_Data'];?> as <?php echo $verificacaoAtividadeData['TABATV_Hora'];?> \nEm que você se inscreveu foi cancelada! Por isso não ocorrerá mais!');                     
                </script>
                <?php
                $deleteParticipacaoAtv = "DELETE FROM PARATV WHERE TABATV_Codigo = " . $atividadesParticipadasData['TABATV_Codigo']. " AND TABUSU_Codigo = " . $_SESSION['CODIGO'] . ";";
                $queryDeleteParticipacaoAtv = $mysqli->query($deleteParticipacaoAtv) or die(mysql_error());               
            }
        }
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
            <div class="product-wrapper-modal wrapper">
                <img class="enterprise-logo" src="../../ASSETS/buttonPerfil.svg" alt="loja image" style="cursor:pointer; border-radius:50%;"/>
                <p style="cursor:pointer; color: var(--blue); margin-top: 0.5rem;">Loja</p>
            </div>            

            <div class="title" style="margin-top: 1.5rem; margin-bottom: 1.5rem;">                
                <ion-icon name="pricetag-outline"></ion-icon>
                <h3>Nome do Produto</h3>
            </div>
            
            <img class="img-wrapper" src="../../ASSETS/paisagem.png" alt="post-image" style="cursor:pointer;"/>
            
            <div class="price-wrapper wrapper" style="margin-top: 1.5rem">
                <h2>Valor</h2>
                <p>Valor do Produto</p>
            </div>                        

            <button id="btnSite" type="button" onclick="">Visitar Anúncio</button>

            <button class="close-button-modal-product" type="button" onclick="location.reload();">Fechar</button>            
        </div>

        <div class="modal-post" style="display: none;">            
            <div class="title-post">                
                <ion-icon name="calendar-clear"></ion-icon>
                <h3>Escalada no pico pão de Loth, localizado  em Quatro Barras</h3>
                <p>10/04/2023</p>
            </div>

            <img src="../../ASSETS/paisagem.png" alt="post-image">

            <div class="desc-wrapper wrapper">
                <h2>Descrição</h2>
                <p>Descrição da Atividade</p>
            </div>

            <div class="time-wrapper wrapper">
                <h2>Horário <ion-icon name="time-outline"></ion-icon> </h2>
                <p>13:40</p>
            </div>

            <div class="localization-wrapper wrapper">
                <h2>Local do Evento <ion-icon name="location-sharp"></ion-icon> </h2>
                <p>Rua José da Silva Guedes 345, Atuba, Curitiba</p>
            </div>

            <div class="reference-wrapper wrapper">
                <h2>Referência <ion-icon name="location-sharp"></ion-icon> </h2>
                <p>Nenhuma Referência Foi Informada!</p>
            </div>

            <div class="registered-wrapper wrapper">
                <h2>Inscritos</h2>                
                <p>
                    Número de Inscritos
                </p>
            </div>

            <div class="instructor-wrapper wrapper">
                <h2>Responsável <ion-icon name="man"></ion-icon> </h2>
                <div class="instructor">
                    <img src="../../assets/bibo.png" alt="instrutor image" style="cursor:pointer;">
                    <a href="#" class="user">Gabriel Felipe Jess Meira</a>
                </div>
            </div>

            <button type="button" onclick="location.reload();">Fechar</button>      
        </div>  
    </div>     

    <div id="app">
        <img onclick="location.href= './home.php'" src="../../ASSETS/Logo.png" alt="Logo go it" id="logo-header" style="cursor: pointer;">
        <h1 id="page-title">Home page</h1>

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
                        <input type="text" id="search-input" name="searchTXT" placeholder="Pesquisar atividades ao ar livre">
                        <?php
                    }?>
                    <button type="Submit"> Buscar </button>
                </div>
            </form>                                   

            <section class="products-section">
                <?php              
                
                //Imprime os Anúncios                       
                if(isset($_GET['categoriafiltrada'])){
                    $produtos= "SELECT * FROM TABPRO WHERE CATATV_Codigo = $categoriafiltrada ORDER BY RAND() LIMIT 2";
                }else{
                    $produtos= "SELECT * FROM TABPRO ORDER BY RAND() LIMIT 2";                   
                }                    
                                
                $queryProdutos = $mysqli->query($produtos) or die(mysql_error());
                $postagem = 0;?>

                <div class="title-wrapper">
                    <h2 style="margin-top: 2.4rem;">Produtos(<?php echo $queryProdutos->num_rows;?>)</h2>
                </div>

                <div class="products">
                    <?php
                    if ($queryProdutos->num_rows > 0){
                        while($produto = mysqli_fetch_array($queryProdutos)){?>
                            <div class="product-wrapper">                                            
                                <?php                                
                                    //Carrega o apelido/fantasia do Criador do Anúncio
                                    $usuario = $produto['TABUSU_Codigo'];
                                    $registroUsuario = "SELECT * FROM TABUSU WHERE TABUSU_Codigo = $usuario";                       
                                    $queryRegistroUsuario = $mysqli->query($registroUsuario) or die(mysql_error());
                                    $usuario_data = mysqli_fetch_array($queryRegistroUsuario);
                                    $tipousuario = $usuario_data['TIPUSU_Codigo'];

                                    if(substr($usuario_data['TABUSU_Icon'], -4) == ".jpg" || substr($usuario_data['TABUSU_Icon'], -4) == ".png" ){
                                        $nomeIconLoja = substr($usuario_data['TABUSU_Icon'], -17);
                                    }else{
                                        $nomeIconLoja = substr($usuario_data['TABUSU_Icon'], -18);
                                    }; 

                                    $lojista = "SELECT * FROM TABLOJ WHERE TABUSU_Codigo = $usuario";
                                    $queryLojista = $mysqli->query($lojista) or die(mysql_error());
                                    $lojista_data = mysqli_fetch_array($queryLojista);
                                    $apelido = $lojista_data['TABLOJ_Fantasia'];

                                    if(substr($produto['TABPRO_Imagem'], -4) == ".jpg" || substr($produto['TABPRO_Imagem'], -4) == ".png" ){
                                        $nomeImagemProduto = substr($produto['TABPRO_Imagem'], -17);
                                    }else{
                                        $nomeImagemProduto = substr($produto['TABPRO_Imagem'], -18);
                                    };                                                                                                
                                ?>
                                
                                <img class="enterprise-logo" src="../perfil/arquivos/<?php echo $nomeIconLoja;?>" onclick="location.href='../perfil/perfil.php?perfil=<?php echo $produto['TABUSU_Codigo']?>'" alt="logo-enterprise" style="cursor:pointer">                                
                                            
                                <img class="product-image" src="../anuncios/arquivos/<?php echo $nomeImagemProduto;?>" 
                                onclick="modalProductView('<?php echo $produto['TABPRO_Nome']; ?>','<?php echo $nomeImagemProduto;?>', <?php echo $produto['TABPRO_Valor']; ?>, '<?php echo $nomeIconLoja;?>', <?php echo $produto['TABUSU_Codigo']?>,'<?php echo $apelido?>', '<?php echo $produto['TABPRO_Url'] ?>');" style="cursor: pointer;"/>                            

                                <a class="sm" style="cursor: pointer;" onclick="modalProductView('<?php echo $produto['TABPRO_Nome']; ?>','<?php echo $nomeImagemProduto?>', <?php echo $produto['TABPRO_Valor']; ?>, '<?php echo $nomeIconLoja;?>', <?php echo $produto['TABUSU_Codigo']?>,'<?php echo $apelido?>', '<?php echo $produto['TABPRO_Url'] ?>');" style="cursor: pointer;">                            
                                    Visualizar produto                                      
                                </a>
                                
                                
                            </div><?php               
                        }                       
                    }else{                        
                        if(isset($categoriafiltrada)){?>
                            <h3>Sem Produtos Cadastrados Nesta Categoria!</h3>
                            <?php
                        }else{?>
                            <h3>Sem Produtos Cadastrados!</h3>
                            <?php
                        }
                    }                   
                    ?>
                    
                </div>

                <?php
                    if(isset($categoriafiltrada)){?>
                        <a href="../anuncios/produtos.php?categoriafiltrada=<?php echo $categoriafiltrada;?>" class="viewMoreProducts">Visualizar produtos</a>
                        <?php
                    }else{?>
                        <a href="../anuncios/produtos.php" class="viewMoreProducts">Visualizar produtos</a>
                        <?php
                    }                
                ?>                
            </section>

            <section class="eventsAndGroups flex">

                <?php              
                
                //Imprime Atividades ao Ar Livre         
                if(isset($_POST['searchTXT']) && $conteudoPesquisado <> ""){
                    if(isset($_GET['categoriafiltrada'])){
                        $atividades = "SELECT * FROM TABATV WHERE CATATV_Codigo = $categoriafiltrada AND TABATV_Cancelada = 0 AND TABATV_Titulo LIKE '%$conteudoPesquisado%' AND TABATV_Data >= now() ORDER BY TABATV_Data ASC";
                    }else{
                        $atividades = "SELECT * FROM TABATV WHERE TABATV_Cancelada = 0 AND TABATV_Titulo LIKE '%$conteudoPesquisado%' AND TABATV_Data >= now() ORDER BY TABATV_Data ASC";
                    }                    
                }else{
                    if(isset($_GET['categoriafiltrada'])){
                        $atividades = "SELECT * FROM TABATV WHERE CATATV_Codigo = $categoriafiltrada AND TABATV_Cancelada = 0 AND TABATV_Data >= now() ORDER BY TABATV_Data ASC";
                    }else{
                        $atividades = "SELECT * FROM TABATV WHERE TABATV_Cancelada = 0 AND TABATV_Data >= now() ORDER BY TABATV_Data ASC";                    
                    }                    
                }
                
                $queryAtividades = $mysqli->query($atividades) or die(mysql_error());
                $postagem = 0;?>

                <div class="title-wrapper">
                    <h2>Atividades ao Ar Livre(<?php echo $queryAtividades->num_rows;?>)</h2>
                </div>

                <?php
                if ($queryAtividades->num_rows > 0){
                    while($atividade = mysqli_fetch_array($queryAtividades)){?>
                        <div class="event">
                            <p class="date-event"><?php echo $atividade['TABATV_Data'];?></p>
                            <div class="title-post">                                
                                <h5><?php echo $atividade['TABATV_Titulo'];?></h5>
                                <ion-icon name="calendar-clear"></ion-icon>
                            </div>
                
                            <!-- <h5>Atividade Criada Por <?php                                
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
            
                                switch($tipousuario){
                                    //Administrador
                                    case 1:
                                        $apelido = "Admin";
                                        break;                        
                                    //Praticante
                                    case 2:
                                        $praticante = "SELECT * FROM TABPRA WHERE TABUSU_Codigo = $usuario";
                                        $queryPraticante = $mysqli->query($praticante) or die(mysql_error());                                       
                                        $praticante_data = mysqli_fetch_array($queryPraticante);
                                        $apelido = $praticante_data['TABPRA_Apelido'];                                        
                                        break;                        
                                    //Instrutor                        
                                    case 3:
                                        $instrutor = "SELECT * FROM TABINS WHERE TABUSU_Codigo = $usuario";
                                        $queryInstrutor = $mysqli->query($instrutor) or die(mysql_error());
                                        $instrutor_data = mysqli_fetch_array($queryInstrutor);
                                        $apelido = $instrutor_data['TABINS_Apelido'];
                                        break;                        
                                    //Lojista
                                    case 4:
                                        $lojista = "SELECT * FROM TABLOJ WHERE TABUSU_Codigo = $usuario";
                                        $queryLojista = $mysqli->query($lojista) or die(mysql_error());
                                        $lojista_data = mysqli_fetch_array($queryLojista);
                                        $apelido = $lojista_data['TABLOJ_Fantasia'];
                                        break;                        
                                }
                            
                            ?>
                            </h5> -->    
                                                       
                            <!--Carrega o número de inscritos para o modal-->
                            <?php          
                                $postagem += 1;                                                  
                                $sqlNumeroInscritos = "SELECT * FROM PARATV WHERE TABATV_Codigo = " . $atividade['TABATV_Codigo'] . ";";
                                $querySqlNumeroInscritos = $mysqli->query($sqlNumeroInscritos) or die(mysql_error());                                
                              
                                if($querySqlNumeroInscritos->num_rows > 0){
                                    if($tipousuario == 4){
                                        $numeroInscritos = $querySqlNumeroInscritos->num_rows;
                                    }else{
                                        $numeroInscritos = $querySqlNumeroInscritos->num_rows + 1;
                                    }                                    
                                }else{
                                    if($tipousuario == 4){
                                        $numeroInscritos = 0;
                                    }else{
                                        $numeroInscritos = 1;
                                    }                                     
                                }?>                                
                                <input type="number" class="numeroInscritos<?php echo $postagem?>" value=<?php echo $numeroInscritos?> hidden/>
                                <?php                                
                                $maximoInscritos = $atividade['TABATV_Inscritos'];?>
                                
                                <input type="number" class="maxInscritos<?php echo $postagem?>" value=<?php echo $maximoInscritos?> hidden/>

                            <?php
                                if(substr($atividade['TABATV_Imagem'], -4) == ".jpg" || substr($atividade['TABATV_Imagem'], -4) == ".png" ){
                                    $nomeImagem = substr($atividade['TABATV_Imagem'], -17);
                                }else{
                                    $nomeImagem = substr($atividade['TABATV_Imagem'], -18);
                                };

                                $descricao_bd = str_replace("\n", '', $atividade['TABATV_Descricao']);                                
                                $descricao_sm = str_replace("\r", '', $descricao_bd);                                
                            ?>

                            <a class="sm" style="cursor: pointer;" onclick="modalPostView('<?php echo $atividade['TABATV_Titulo']; ?>','<?php echo $nomeImagem;?>', '<?php echo $descricao_sm; ?>','<?php echo $atividade['TABATV_Data']; ?>', '<?php echo $atividade['TABATV_Hora']; ?>', '<?php echo $atividade['TABATV_Localizacao']?>', '<?php echo $atividade['TABATV_Referencia']?>', <?php echo $postagem;?>, '<?php echo $nomeIcon;?>', <?php echo $atividade['TABUSU_Codigo']?>,'<?php echo $apelido?>');" style="cursor: pointer;">                            
                                Saiba mais                                        
                            </a>

                            <?php                            
                                if($_SESSION['TIPOUSUARIO'] != 4 || $_SESSION['TIPOUSUARIO'] != 1){
                                    $sqlCriador = "SELECT * FROM TABATV WHERE TABATV_Codigo = ". $atividade['TABATV_Codigo']." AND TABUSU_Codigo = ". $_SESSION['CODIGO']. ";";
                                    $querySqlCriador = $mysqli->query($sqlCriador) or die(mysql_error());
                                    if($querySqlCriador->num_rows == 1){?>
                                        <a onclick="alert('Como criador, para se desinscrever, apague a atividade!');">
                                            Inscrito
                                        </a>
                                    <?php
                                    }else{
                                        $sqlInscrito = "SELECT * FROM PARATV WHERE TABATV_Codigo = ". $atividade['TABATV_Codigo']." AND TABUSU_Codigo = ". $_SESSION['CODIGO']. ";";
                                        $querySqlInscrito = $mysqli->query($sqlInscrito) or die(mysql_error());
                                        if($querySqlInscrito->num_rows == 1){
                                        ?>
                                            <a onclick="cancelarInscricao('<?php echo $atividade['TABATV_Titulo']?>', <?php echo $atividade['TABATV_Codigo']?>);">
                                                Cancelar Inscrição
                                            </a>
                                        <?php
                                        }else{
                                            if($numeroInscritos == $maximoInscritos){?>
                                                <a onclick="alert('Número máximo de inscritos atingido nesta atividade ao ar livre!')">
                                                    Número máximo de inscritos atingido!
                                                </a>
                                            <?php
                                            }else{?>
                                                <a href="participar_atividadePHP.php?atividade=<?php echo $atividade['TABATV_Codigo']?>">
                                                    Inscrever-Se
                                                </a>
                                            <?php
                                            }
                                            ?>
                                            
                                        <?php
                                        }
                                    }                      
                                }                                      
                            ?>                            

                            <?php
                            if($_SESSION['CODIGO'] == $atividade['TABUSU_Codigo']){?>                            
                                
                                <a href="../atividades_ao_ar_livre/update/update_atividade.php?codigo=<?php echo $atividade['TABATV_Codigo'];?>" style="cursor: pointer;">Editar Atividade</a>

                                <a onclick="cancelarAtividade('<?php echo $atividade['TABATV_Titulo']?>', <?php echo $atividade['TABATV_Codigo']?>)" style="cursor: pointer;">Cancelar Atividade</a>
                                
                                <!--<a onclick="apagarAtividade('<?php //echo $atividade['TABATV_Titulo']?>', <?php //echo $atividade['TABATV_Codigo']?>)" style="cursor: pointer;">Excluir Atividade</a>-->
                            <?php
                            }
                            ?>                                          
                        </div><?php               
                    }                       
                }else{ ?>
            
                    <h3>Sem Atividades Ao Ar Livre Cadastradas!</h3>
       
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

        function cancelarInscricao(titulo, codigo){
            let text = "Confirma cancelar a incrição em " + titulo + "?";
            if (confirm(text) == true) {
                window.location.href = "./sair_atividadePHP.php?atividade="+codigo; 
            }   
        }

        function apagarAtividade(titulo, codigo){
            let text = "Confirma apagar a atividade " + titulo + "?";
            if (confirm(text) == true) {
                window.location.href = "../atividades_ao_ar_livre/delete/delete_atividadePHP.php?codigo="+codigo; 
            }  
        }

        function cancelarAtividade(titulo, codigo){
            let text = "Confirma o cancelamento da atividade " + titulo + ", esta ação é irreversível!";
            if (confirm(text) == true) {
                window.location.href = "./cancelar_atividade.php?atividade="+codigo;
            }
        }

        bgblur = document.querySelector(".background-blur")
        modalProduct = document.querySelector(".modal-product")
        modalPost = document.querySelector(".modal-post")              

        function modalPostView(titulo, imagem, descricao, data, hora, local, referencia, postagem, imgIcon, perfil, usuario) {
            var title = document.querySelector(".title-post h3")
            title.innerHTML = titulo    
            var image = document.querySelector(".modal-post img")
            if (imagem != ''){
                image.setAttribute("src", "../atividades_ao_ar_livre/arquivos/"+imagem)
            }else{
                image.setAttribute("src", "../atividades_ao_ar_livre/arquivos/default.png")
            }           
            var description = document.querySelector(".desc-wrapper p")
            description.innerHTML = descricao
            var date = document.querySelector(".title-post p")
            date.innerHTML = data
            var time = document.querySelector(".time-wrapper p")
            time.innerHTML = hora
            var localization = document.querySelector(".localization-wrapper p")
            localization.innerHTML = local                 
            var reference = document.querySelector(".reference-wrapper p")
            if(referencia != ""){
                reference.innerHTML = referencia
            }                                                                                                                   
            var numberRegistereds = document.querySelector(".numeroInscritos"+postagem).value
            var maxRegistereds = document.querySelector(".maxInscritos"+postagem).value
            var registered = document.querySelector(".registered-wrapper p")
            registered.innerHTML = numberRegistereds + "/" + maxRegistereds
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

        function modalProductView(nome, imagem, valor, imgIcon, perfil, usuario, url) {
            var title = document.querySelector(".modal-product .title")
            title.innerHTML = nome    
            var btnShop = document.querySelector("#btnSite")
            btnShop.setAttribute("onclick", "location.href='"+ url + "';")
            var image = document.querySelector(".modal-product .img-wrapper")
            image.setAttribute("onclick", "location.href='"+ url + "';")
            image.setAttribute("src", "../anuncios/arquivos/"+imagem)          
            var value = document.querySelector(".modal-product .price-wrapper p")
            value.innerHTML = "R$" + parseFloat(valor).toFixed(2);
            var icon = document.querySelector(".modal-product .product-wrapper-modal img")
            if (imgIcon != ''){
                icon.setAttribute("src", "../perfil/arquivos/"+imgIcon)
            }else{
                icon.setAttribute("src", "../../ASSETS/buttonPerfil.svg")
            } 
            var user = document.querySelector(".modal-product .product-wrapper-modal p")   
            icon.setAttribute("onclick", "location.href='../perfil/perfil.php?perfil=" + perfil + "';")
            user.setAttribute("onclick", "location.href='../perfil/perfil.php?perfil=" + perfil + "';")         
            user.innerHTML = usuario          
            bgblur.setAttribute("style" , "display: ")
            modalProduct.setAttribute("style" , "display: ")
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