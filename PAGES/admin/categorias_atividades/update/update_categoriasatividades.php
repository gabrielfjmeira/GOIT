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

    //Carrega o Registro do Banco
    if (isset($_GET['codigo'])){
        $codigo = $_GET['codigo'];
        
        $categoriaAtividade = "SELECT * FROM CATATV WHERE CATATV_Codigo = $codigo";
        $queryCategoriaAtividade = $mysqli->query($categoriaAtividade) or die("Falha na execução do código sql" . $mysqli->error);
        if ($queryCategoriaAtividade->num_rows == 1){
            $categoriaAtividade_data = mysqli_fetch_assoc($queryCategoriaAtividade);            
            $descricao = $categoriaAtividade_data['CATATV_Descricao'];
            $risco = $categoriaAtividade_data['TABRIS_Codigo'];            
        }else{
            header ("Location: ../categoriasatividades.php");
        }
        
    }else{
        header ("Location: ../categoriasatividades.php");
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
        <form id="formAlterarCategoriasAtividades" name="formAlterarCategoriasAtividades" action="./update_categoriasatividadesPHP.php" method="POST" onsubmit="return formAlterarCategoriasAtividadesOnSubmit();">
            <center>
                <h1>Alterar Categoria de Atividade: <?php echo $codigo . " - " . $descricao;?></h1>
                
                <input type="hidden" id="nbrCodigo" name="nbrCodigo" value=<?php echo $codigo;?>>

                <label>Descrição: </label>
                <input type="text" id="txtDescricao" name="txtDescricao" placeholder="Descricao" value="<?php echo $descricao;?>" class="input" 
                pattern="^.{5,30}"
                title="Descrição deve ter no mínimo 5 e no máximo 30 caracteres!" required/><br><br>               
                                
                <label>Risco de Atividade: </label>
                <select name="riscoAtividade" required>                            
                    <?php          
                        $riscosAtividades = "SELECT * FROM TABRIS ORDER BY TABRIS_Codigo ASC";      
                        $queryRiscosAtividades = $mysqli->query($riscosAtividades) or die(mysql_error());

                        while($riscoAtividade = mysqli_fetch_array($queryRiscosAtividades)){
                            $tabris_codigo = $riscoAtividade['TABRIS_Codigo'];
                            $tabris_descricao = $riscoAtividade['TABRIS_Descricao'];

                            if ($risco == $tabris_codigo){
                                echo "<option value=".$tabris_codigo." selected>". $tabris_descricao."</option>";                                       
                            }else{
                                echo "<option value=".$tabris_codigo.">". $tabris_descricao."</option>";                                       
                            }                            
                        }
                    ?>                                                           
                </select><br><br>                

                <button type="submit">Alterar</button>                
            </center>
        </form>

        <!--Script-->        
        <script type="text/javascript" src="../../../JAVASCRIPT/functions.js"></script>
    
</body>
</html>