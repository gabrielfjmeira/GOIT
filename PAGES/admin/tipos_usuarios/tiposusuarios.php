<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../index.php?error=4");
    }

    //Verifica se é um Admin
    if ($_SESSION['TIPOUSUARIO'] != 1){
        header ("Location: ../../home/home.php");
    }

    //Carrega os Registros da Tabela de Tipos de Usuários
    $tiposUsuarios = "SELECT * FROM TIPUSU ORDER BY TIPUSU_Codigo ASC";
    $queryTiposUsuarios = $mysqli->query($tiposUsuarios) or die("Falha na execução do código sql" . $mysqli->error);
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
    
    <center>
        <!--Cabeçalho-->    
        <header>        
            <h1>GERENCIAR TIPOS DE USUÁRIOS</h1>              
        </header>

        <!--Registros do Banco-->
        <div>
            <table>
                <thead>
                    <tr>
                        <th scope="col" hidden>#</th>
                        <th scope="col"   width="200px">Descrição</th> 
                        <th scope="col"   width="100px">Administrador</th>
                        <th width='270px' width="270px">Ações</th>
                    </tr>                
                </thead>   
                <tbody>
                    <?php
                        if($queryTiposUsuarios->num_rows > 0){                  
                            while($tiposUsuarios_data = mysqli_fetch_assoc($queryTiposUsuarios)){                           
                                $codigo = $tiposUsuarios_data['TIPUSU_Codigo'];?>

                                <tr>
                                    <td hidden><?php echo $codigo;?></td>
                                    <td align="center" width="200px"><?php echo $tiposUsuarios_data['TIPUSU_Descricao'];?></td>                                    
                                    <?php
                                    if ($tiposUsuarios_data['TIPUSU_Administrador'] == 1){?>
                                        <td align="center" width="200px">Sim</td>
                                    <?php    
                                    }else{?>
                                        <td align="center" width="200px">Não</td>
                                    <?php
                                    }?>
                                    <td align="center" width="270px">
                                        <a href="./update/update_tiposusuarios.php?codigo=<?php echo $codigo?>">
                                            <input type="button" class="button-alterar" value="Alterar">
                                        </a>                                        
                                        <a href="./delete/delete_tiposusuariosPHP.php?codigo=<?php echo $codigo?>">
                                            <input type="button" value="Excluir">
                                        </a>                                    
                                    </td>
                                </tr>
                            <?php
                            }
                        }else{?>
                            <tr>
                                <td class="font" colspan="3" align="center"> Sem registros no banco! </td>;
                            </tr>";
                        <?php
                        }
                    ?>
                </tbody>             
            </table>
        </div>  

        <div>
            <!--Inserir Novo Risco de Atividade-->
            <button type="button" class='button' onclick="location.href='./insert/insert_tiposusuarios.php'">
                Inserir Tipo de Usuário
            </button>
            
            <button onclick="window.location.href = '../admin.php';">
                Voltar ⬅
            </button>
        </div>    

        <div>
            <?php
                //Mensagem de Inserção
                if (isset($_GET['inserido'])){
                    $inserido = $_GET['inserido'];                        
                    if ($inserido == 1){                    
                        echo "<h4 class='advice'>Tipo de usuário inserido com sucesso!</h4>";
                    }else{
                        echo "<h4 class='advice'></h4>";
                    }
                }

                //Mensagem de Alteração
                if (isset($_GET['alterado'])){
                    $alterado = $_GET['alterado'];                        
                    if ($alterado == 1){                    
                        echo "<h4 class='advice'>Tipo de usuário alterado com sucesso!</h4>";
                    }else{
                        echo "<h4 class='advice'></h4>";
                    }
                }

                //Mensagem de Exclusão
                if (isset($_GET['excluido'])){
                    $excluido = $_GET['excluido'];                        
                    if ($excluido == 1){                    
                        echo "<h4 class='advice'>Tipo de usuário excluído com sucesso!</h4>";
                    }else{
                        echo "<h4 class='advice'></h4>";
                    }
                }

                //Mensagem de Erro
                if (isset($_GET['error'])){
                    $error = $_GET['error'];                        
                    if ($error == 1){                    
                        echo "<h4 class='advice'>Existem usuários cadastrados com este tipo de usuário, impossível continuar!</h4>";
                    }else{
                        echo "<h4 class='advice'></h4>";
                    }
                }
            ?>
        </div>
       
    </center>
</body>
</html>