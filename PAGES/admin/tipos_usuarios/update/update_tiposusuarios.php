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
        
        $tipoUsuario = "SELECT * FROM TIPUSU WHERE TIPUSU_Codigo = $codigo";
        $queryTipoUsuario = $mysqli->query($tipoUsuario) or die("Falha na execução do código sql" . $mysqli->error);
        if ($queryTipoUsuario->num_rows == 1){
            $tipousuario_data = mysqli_fetch_assoc($queryTipoUsuario);            
            $descricao = $tipousuario_data['TIPUSU_Descricao'];
            $admin = $tipousuario_data['TIPUSU_Administrador'];            
        }else{
            header ("Location: ../tiposusuarios.php");
        }
        
    }else{
        header ("Location: ../tiposusuarios.php");
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
        <form id="formAlterarTiposUsuarios" name="formAlterarTiposUsuarios" action="./update_tiposusuariosPHP.php" method="POST" onsubmit="return formAlterarTiposUsuariosOnSubmit();">
            <center>
                <h1>Alterar Tipo de Usuário: <?php echo $codigo . " - " . $descricao;?></h1>
                
                <input type="hidden" id="nbrCodigo" name="nbrCodigo" value=<?php echo $codigo;?>>

                <label>Descrição: </label>
                <input type="text" id="txtDescricao" name="txtDescricao" placeholder="Descricao" value="<?php echo $descricao;?>" class="input" required/><br><br>               
                                
                <label>Administrador? </label>
                <select id="selAdmin" name="selAdmin" required>
                    <?php if($admin == 1){?>
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