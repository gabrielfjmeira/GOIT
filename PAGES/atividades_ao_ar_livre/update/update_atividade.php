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
            $categoria = $atividade_data['CATRIS_Codigo'];
            $localizacao = $atividade_data['TABATV_Localizacao'];
            $referencia = $atividade_data['TABATV_Referencia'];
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
    

    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body>
    <!--Cabeçalho-->
    <div id="app">
        <header>
            <button style="cursor: pointer;" onclick="window.location.href='../../home/home.php';"><img src="../../../ASSETS/backButtonDark.svg" alt="back-button"></button>
            <img src="../../../ASSETS/Logo.png" alt="logo" class="logo">
        </header>
        
        <!--Formulário-->    
        <form id="formInsertAtividade" name="formInsertAtividade" action="update_atividadePHP.php" method="POST" onsubmit="return formInsertAtividadeOnSubmit();">
                
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
                    <input type="text" id="txtTitulo" name="txtTitulo" placeholder="Título" value="<?php echo $titulo;?>"
                    pattern="^.{5, 100}$" 
                    title="Título deve possuir no mínimo 5 caracteres e no máximo 100 caracteres!" required/>
                    <p>0/100</p>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="categoria">Categoria da atividade do evento</label>
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
                <label for="">Descrição</label>
                <div class="desc-input-wrapper">
                    <textarea id="txtDescricao" name="txtDescricao" placeholder="Ex: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget ligula aliquet, iaculis est eu, ornare velit. Cras vestibulum venenatis blandit." required>
                        <?php echo $descricao;?>
                    </textarea>
                    <p>0/600</p>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="">Endereço</label>
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
                    <input type="text" name="" id="" placeholder="Ex: Próximo ao supermercado Condor" value="<?php echo $referencia;?>"
                    pattern="^.{, 50}$" 
                    title="Referência deve possuir no máximo 50 caracteres!"/>
                    <ion-icon name="pin-outline"></ion-icon>
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
                <label for="">Horário</label>
                <div class="time-input-wrapper">
                    <input type="time" id="horaAtividade" name="horaAtividade" placeholder="--:--" value="<?php echo $hora;?>">
                    <ion-icon name="time-outline"></ion-icon>
                </div>
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
    
</body>
</html>