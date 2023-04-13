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
        
        $riscoAtividade = "SELECT * FROM TABRIS WHERE TABRIS_Codigo = $codigo";
        $queryRiscoAtividade = $mysqli->query($riscoAtividade) or die("Falha na execução do código sql" . $mysqli->error);
        if ($queryRiscoAtividade == 1){
            $riscoAtividade_data = mysqli_fetch_assoc($queryRiscoAtividade);
            $descricao = $riscoAtividade_data['TABRIS_Descricao'];
            $minimo = $riscoAtividade_data['TABRIS_Minimo'];
            $maximo = $riscoAtividade_data['TABRIS_Maximo'];
            $instrutor = $riscoAtividade_data['TABRIS_Instrutor'];
        }else{
            header ("Location: ../riscosatividades.php");
        }
        
    }else{
        header ("Location: ../riscosatividades.php");
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
            <button onclick="window.location.href = '../riscosatividades.php'">
                Voltar ⬅
            </button> 
        </center>
    </section>

    <!--Formulário-->    
    <section class="form">
        <form id="formAlterarRiscosAtividades" name="formAlterarRiscosAtividades" action="update_riscosatividadesPHP.php" method="POST" onsubmit="return formAlterarRiscosAtividadesOnSubmit();">
            <center>
                <h1>Alterar Risco de Atividade: <?php echo $codigo . " - " . $descricao;?></h1>
                
                <input type="hidden" id="nbrCodigo" name="nbrCodigo" value="<?php $codigo;?>">

                <label>Descrição: </label>
                <input type="text" id="txtDescricao" name="txtDescricao" placeholder="Descricao" value="<?php echo $descricao;?>" class="input" required/><br><br>
                
                <label>Mínimo: </label>
                <input type="number" id="nbrMinimo" name="nbrMinimo" placeholder="Mínimo" value="<?php echo $minimo;?>" class="input" required/><br><br>

                <label>Máximo: </label>
                <input type="number" id="nbrMaximo" name="nbrMaximo" placeholder="Máximo" value="<?php echo $maximo;?>" class="input" required/><br><br>
                
                <label>Recomenda-se instrutor? </label>
                <select id="selInstrutor" name="selInstrutor">
                    <?php if($instrutor == 1){?>
                        <option value = 1 selected>Sim</option>
                        <option value = 0>Não</option>
                    <?php
                    }else{?>
                        <option value = 1>Sim</option>
                        <option value = 0 selected>Não</option>
                    <?php   
                    }
                    ?>
                </select><br><br>

                <button type="submit">Alterar</button>                
            </center>
        </form>

        <!--Script-->        
        <script type="text/javascript" src="../../../../JAVASCRIPT/functions.js"></script>
    
</body>
</html>