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
    
    <link rel="stylesheet" href="../../CSS/home.css">

    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>

<body>
    
    <div class="background-blur" style="display: none;" onclick="exitModal();">
        
        <div class="modal-post" style="display: none;">
            <form action="participar.php" medthod="POST"></form>
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

            <div class="instructor-wrapper wrapper">
                <h2>Responsável <ion-icon name="man"></ion-icon> </h2>
                <div class="instructor">
                    <img src="./assets/bibo.png" alt="instrutor image">
                    <a href="#" class="user">Gabriel Felipe Jess Meira</a>
                </div>
            </div>

            <?php
                //Verifica se o usuário está participando da atividade ao ar livre selecionada                
                $usuarioInscricao = $_SESSION['CODIGO'];
                $usuarioAtividade = "SELECT * FROM PARATV WHERE TABUSU_Codigo = $usuarioInscricao AND TABATV_Codigo = 3";                
                $queryUsuarioAtividade = $mysqli->query($usuarioAtividade) or die("Falha na execução do código sql" . $mysqli->error);
                $qtdUsuarioAtividade = $queryUsuarioAtividade->num_rows;

                if($qtdUsuarioAtividade->num_rows > 0){?>
                    <form action="participar_atividadePHP.php" method="POST" id=<?php echo $usuarioInscricao?>>
                        <input id="atvCodigo" name="atvCodigo" type="number" value=03 hidden>
                        <input id="usrCodigo" name="usrCodigo" type="number" value=<?php echo $_SESSION['CODIGO']?> hidden>
                    </form>
                    <button type="submit" form=<?php echo $usuarioInscricao ?> disabled>Inscrito</button>
                <?php
                }else{?>
                    <form action="participar_atividadePHP.php" method="POST" id=<?php echo $usuarioInscricao?> >
                        <input id="atvCodigo" name="atvCodigo" type="number" value=03 hidden>
                        <input id="usrCodigo" name="usrCodigo" type="number" value=<?php echo $_SESSION['CODIGO']?> hidden>
                    </form>
                    <button type="submit" form=<?php echo $usuarioInscricao ?> style="cursor: pointer;">Inscrever-se</button>
                <?php
                }
            
            ?>                        

        </div>

    </div>

    <div id="app">
        <img onclick="location.href= './home.php'" src="../../ASSETS/Logo.png" alt="Logo go it" id="logo-header" style="cursor: pointer;">

        <!-- //Imprime as Categorias para Filtrar a Aplicação -->
        <header class="activities-list flex">
            <?php include('../templates/categorias.php');
            ?>
        </header>
    
        <main>
            <div class="search-wrapper flex">
                <ion-icon name="search-outline"></ion-icon>
                <input type="text" id="search-input" placeholder="Search">
            </div>

            <section class="eventsAndGroups flex">

                <?php
                //Imprime Atividades ao Ar Livre         
                $atividades = "SELECT * FROM TABATV ORDER BY TABATV_Data ASC";                    
                $queryAtividades = $mysqli->query($atividades) or die(mysql_error());

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
                            <?php
                                if(substr($atividade['TABATV_Imagem'], -4) == ".jpg" || substr($atividade['TABATV_Imagem'], -4) == ".png" ){
                                    $nomeImagem = substr($atividade['TABATV_Imagem'], -17);
                                }else{
                                    $nomeImagem = substr($atividade['TABATV_Imagem'], -18);
                                };

                                                                                            
                            ?>

                            <a style="cursor: pointer;" onclick="modalPostView('<?php echo $atividade['TABATV_Titulo']; ?>','<?php echo $nomeImagem;?>', '<?php echo $atividade['TABATV_Descricao']; ?>','<?php echo $atividade['TABATV_Data']; ?>', '<?php echo $atividade['TABATV_Hora']; ?>', '<?php echo $atividade['TABATV_Localizacao']?>', '<?php echo $apelido?>');" style="cursor: pointer;">
                                Saiba mais                                        
                            </a>                                                                                          
                                                                                    
                            <?php
                            if($_SESSION['CODIGO'] == $atividade['TABUSU_Codigo']){?>                            
                                
                                <a href="../atividades_ao_ar_livre/update/update_atividade.php?codigo=<?php echo $atividade['TABATV_Codigo'];?>" style="cursor: pointer;">Editar Atividade</a>
                                
                                <a href="../atividades_ao_ar_livre/delete/delete_atividadePHP.php?codigo=<?php echo $atividade['TABATV_Codigo'];?>" style="cursor: pointer;">Excluir Atividade</a>
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

        function submitform() {
                document.saibamais.submit();
        }

        bgblur = document.querySelector(".background-blur")
        modalProduct = document.querySelector(".modal-product")
        modalPost = document.querySelector(".modal-post")

        function modalProductView() {
            bgblur.setAttribute("style" , "display: ")
            modalProduct.setAttribute("style" , "display: ")
        }        

        function modalPostView(titulo, imagem, descricao, data, hora, local, usuario) {
            var title = document.querySelector(".title-post h3")
            title.innerHTML = titulo    
            var image = document.querySelector(".modal-post img")
            if (imagem != ''){
                image.setAttribute("src", "../atividades_ao_ar_livre/arquivos/"+imagem)
            }            
            var description = document.querySelector(".desc-wrapper p")
            description.innerHTML = descricao
            var date = document.querySelector(".title-post p")
            date.innerHTML = data
            var time = document.querySelector(".time-wrapper p")
            time.innerHTML = hora
            var localization = document.querySelector(".localization-wrapper p")
            localization.innerHTML = local
            var user = document.querySelector(".user")
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