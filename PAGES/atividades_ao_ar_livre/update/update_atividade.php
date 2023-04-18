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

    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body>
    <!--Cabeçalho-->
    <section class="header">
        <center>
            <h1>GO🐐IT | A Social Adventure</h1>
            <button onclick="window.location.href = '../../home/home.php'">
                Voltar ⬅
            </button> 
        </center>
    </section>

    <!--Formulário-->    
    <section class="form">
        <form id="formAlterarPublicacao" name="formAlterarPublicacao" action="./update_atividadePHP.php" method="POST" onsubmit="return formAlterarAtividadeOnSubmit();">
            <center>
                <h1>Alterar Atividade Ao Ar Livre: <?php echo $titulo;?></h1>
                
                <input type="hidden" id="nbrCodigo" name="nbrCodigo" value=<?php echo $codigo;?>>

                <label>Título: </label>
                <input type="text" id="txtTitulo" name="txtTitulo" placeholder="Título" value="<?php echo $titulo;?>" class="input" required/><br><br>

                <label>Descrição: </label>
                <textarea type="text" id="txtDescricao" name="txtDescricao" placeholder="Descricao" class="input" required><?php echo $descricao;?></textarea><br><br>
                
                <label>Categoria da Atividade ao Ar Livre: </label>
                <select name="categoriaAtividade" required>                            
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
                </select><br><br>
                
                <label>Localização: </label>
                <textarea type="text" id="txtLocalizacao" name="txtLocalizacao" placeholder="Localização" class="input" required><?php echo $localizacao;?></textarea><br><br>     

                <label>Referência: </label>
                <textarea type="text" id="txtReferencia" name="txtReferencia" placeholder="Referência" class="input" required><?php echo $referencia;?></textarea><br><br>   
                
                <label>Data da Atividade ao Ar Livre: </label>
                <input type="date" id="dataAtividade" name="dataAtividade" value="<?php echo $data;?>" class="input" required/><br><br>

                <label>Hora da Atividade ao Ar Livre: </label>
                <input type="time" id="horaAtividade" name="horaAtividade" value="<?php echo $hora;?>" class="input" required/><br><br>

                <button type="submit">Alterar</button>                
            </center>
        </form>

        <!--Script-->        
        <script type="text/javascript" src="../../../JAVASCRIPT/functions.js"></script>
    
</body>
</html>