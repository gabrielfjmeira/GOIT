<?php
    //Incluí Conexão
    include('../../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../../index.php?error=4");
    }

    //Verifica se é um Admin
    if ($_SESSION['TIPOUSUARIO'] != 1){
        header ("Location: ../../../home/home.php");
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
            <button onclick="window.location.href = '../categoriasatividades.php'">
                Voltar ⬅
            </button> 
        </center>
    </section>

    <!--Formulário-->    
    <section class="form">
        <form id="formInsertCategoriasAtividades" name="formInsertCategoriasAtividades" action="insert_categoriasatividadesPHP.php" method="POST" onsubmit="return formInsertCategoriasAtividadesOnSubmit();">
            <center>
                <h1>Inserir Categoria de Atividade ao Ar Livre</h1>
                
                <label>Descrição: </label>
                <input type="text" id="txtDescricao" name="txtDescricao" placeholder="Descricao" class="input" 
                pattern="^.{5,30}"
                title="Descrição deve ter no mínimo 5 e no máximo 30 caracteres!" required/><br><br>
                
                <label>Risco de Atividade: </label>
                <select name="riscoAtividade" required>        
                    <option value="" selected disabled="disabled" hidden>Escolha uma opção</option>
                    <?php          
                        $riscosAtividades = "SELECT * FROM TABRIS ORDER BY TABRIS_Codigo ASC";      
                        $queryRiscosAtividades = $mysqli->query($riscosAtividades) or die(mysql_error());

                        while($riscoAtividade = mysqli_fetch_array($queryRiscosAtividades)){
                            $tabris_codigo = $riscoAtividade['TABRIS_Codigo'];
                            $tabris_descricao = $riscoAtividade['TABRIS_Descricao'];
                            
                            echo "<option value='".$tabris_codigo."'>". $tabris_descricao."</option>";                                                                   
                        }
                    ?>                                                           
                </select><br><br>
                
                <button type="submit">Inserir</button>                
            </center>
        </form>

        <!--Script-->        
        <script type="text/javascript" src="../../../../JAVASCRIPT/functions.js"></script>
    
</body>
</html>