<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');
    
    //Carrega os Registros de Tipos de Usuários
    $sqlTipoUsuarios = "SELECT * FROM TIPUSU";
    $resultTipoUsuarios = $mysqli->query($sqlTipoUsuarios) or die(mysql_error());
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
            <button onclick="window.location.href = '../../index.php'">
                Voltar ⬅
            </button>            
        </center>
    </section>

    <!--Seleção do Tipo de Usuário-->
    <section>
        <form id="formCadastroUsuarios" name="formCadastroUsuarios" action="redirecionar_usuarioPHP.php" method="post">
            <center>
                <h1>Cadastro</h1>
                <label>Selecione o seu tipo de usuário:</label>
                <select name="tipoUsuario" required>
                    <option value="" selected disabled="disabled" hidden>Escolha uma opção</option>
                    <?php                
                        while($tipoUsuario = mysqli_fetch_array($resultTipoUsuarios)){
                            $tipusu_Codigo = $tipoUsuario['TIPUSU_Codigo'];
                            $tipusu_Descricao = $tipoUsuario['TIPUSU_Descricao'];
                            $tipusu_Administrador = $tipoUsuario['TIPUSU_Administrador'];  

                            if ($tipusu_Administrador != 1){
                                echo "<option value='".$tipusu_Codigo."'>". $tipusu_Descricao."</option>";                                       
                            }                                                                          
                        }
                    ?>                                                           
                </select>
                <button type="submit">Continuar</button>
            </center>                       
        </form>
    </section>           
</body>
</html>