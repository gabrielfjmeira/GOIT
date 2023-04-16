<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../index.php?error=4");
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
        <form id="formInsertAtividade" name="formInsertAtividade" action="insert_atividadePHP.php" method="POST" onsubmit="return formInsertAtividadeOnSubmit();">
            <center>
                <h1>Criar Atividade ao Ar Livre</h1>
                
                <label>Título: </label>
                <input type="text" id="txtTitulo" name="txtTitulo" placeholder="Título" class="input" required/><br><br>

                <label>Descrição: </label>
                <textarea id="txtDescricao" name="txtDescricao" placeholder="Descrição" class="input" required></textarea><br><br>               
               
                <label>Categoria da Atividade ao Ar Livre: </label>
                <select name="categoriaAtividade" required>        
                    <option value="" selected disabled="disabled" hidden>Escolha uma opção</option>
                    <?php          
                        $categoriasAtividades = "SELECT * FROM CATATV ORDER BY CATATV_Codigo ASC";      
                        $queryCategoriasAtividades = $mysqli->query($categoriasAtividades) or die(mysql_error());

                        while($categoriaAtividade = mysqli_fetch_array($queryCategoriasAtividades)){
                            $catatv_codigo = $categoriaAtividade['CATATV_Codigo'];
                            $catatv_descricao = $categoriaAtividade['CATATV_Descricao'];
                            
                            echo "<option value=".$catatv_codigo.">". $catatv_descricao."</option>";                                                                   
                        }
                    ?>                                                           
                </select><br><br>

                <label>Localização: </label>
                <textarea type="text" id="txtLocalizacao" name="txtLocalizacao" placeholder="Localização" class="input" required></textarea><br><br>     

                <label>Referência: </label>
                <textarea type="text" id="txtReferencia" name="txtReferencia" placeholder="Referência" class="input" required></textarea><br><br>   
                
                <label>Data da Atividade ao Ar Livre: </label>
                <input type="date" id="dataAtividade" name="dataAtividade" class="input" required/><br><br>

                <label>Hora da Atividade ao Ar Livre: </label>
                <input type="time" id="horaAtividade" name="horaAtividade" class="input" required/><br><br>
                
                <button type="submit">Publicar Atividade ao Ar Livre</button>                
            </center>
        </form>

        <!--Script-->        
        <script type="text/javascript" src="../../../../JAVASCRIPT/functions.js"></script>
    
</body>
</html>