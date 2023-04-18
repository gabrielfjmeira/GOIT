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
    $categoriasAtividades = "SELECT * FROM CATATV ORDER BY CATATV_Codigo ASC";
    $queryCategoriasAtividades = $mysqli->query($categoriasAtividades) or die("Falha na execução do código sql" . $mysqli->error);
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
            <h1>GERENCIAR CATEGORIAS DE ATIVIDADES AO AR LIVRE</h1>              
        </header>

        <!--Registros do Banco-->
        <div>
            <table>
                <thead>
                    <tr>
                        <th scope="col" hidden>#</th>
                        <th scope="col"   width="200px">Descrição</th> 
                        <th scope="col"   width="100px">Risco de Atividade ao Ar Livre</th>
                        <th width='270px' width="270px">Ações</th>
                    </tr>                
                </thead>   
                <tbody>
                    <?php
                        if($queryCategoriasAtividades->num_rows > 0){                  
                            while($categoriasatv_data = mysqli_fetch_assoc($queryCategoriasAtividades)){                           
                                $codigo = $categoriasatv_data['CATATV_Codigo'];
                                $codigo_risco = $categoriasatv_data['TABRIS_Codigo'];?>

                                <tr>
                                    <td hidden><?php echo $codigo;?></td>
                                    <td align="center" width="200px"><?php echo $categoriasatv_data['CATATV_Descricao'];?></td>                                    
                                    <?php                                    
                                        //Carrega a Descrição do Risco de Atividade ao Ar Livre
                                        $riscoAtividade = "SELECT * FROM TABRIS WHERE TABRIS_Codigo = $codigo_risco";
                                        $queryRiscoAtividade = $mysqli->query($riscoAtividade) or die("Falha na execução do código sql" . $mysqli->error);  
                                        if($queryRiscoAtividade->num_rows == 1){
                                            $riscoatv_data = mysqli_fetch_assoc($queryRiscoAtividade);
                                            $descricao_riscoatv = $riscoatv_data['TABRIS_Descricao'];
                                        }                                                                           
                                    ?>
                                    <td align="center" width="200px"><?php echo $descricao_riscoatv;?></td>
                                    <td align="center" width="270px">
                                        <a href="./update/update_categoriasatividades.php?codigo=<?php echo $codigo?>">
                                            <input type="button" class="button-alterar" value="Alterar">
                                        </a>                                        
                                        <a href="./delete/delete_categoriasatividadesPHP.php?codigo=<?php echo $codigo?>">
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
            <!--Inserir Novo Categorias de Atividades ao Ar Livre-->
            <button type="button" class='button' onclick="location.href='./insert/insert_categoriasatividades.php'">
                Inserir Categoria de Atividade ao Ar Livre
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
                        echo "<h4 class='advice'>Categoria de atividade inserida com sucesso!</h4>";
                    }else{
                        echo "<h4 class='advice'></h4>";
                    }
                }

                //Mensagem de Alteração
                if (isset($_GET['alterado'])){
                    $alterado = $_GET['alterado'];                        
                    if ($alterado == 1){                    
                        echo "<h4 class='advice'>Categoria de atividade alterada com sucesso!</h4>";
                    }else{
                        echo "<h4 class='advice'></h4>";
                    }
                }

                //Mensagem de Exclusão
                if (isset($_GET['excluido'])){
                    $excluido = $_GET['excluido'];                        
                    if ($excluido == 1){                    
                        echo "<h4 class='advice'>Categoria de atividade excluída com sucesso!</h4>";
                    }else{
                        echo "<h4 class='advice'></h4>";
                    }
                }

                //Mensagem de Erro
                if (isset($_GET['error'])){
                    $error = $_GET['error'];                        
                    if ($error == 1){                    
                        echo "<h4 class='advice'>Existem atividades ao ar livre cadastradas com esta categoria, impossível continuar!</h4>";
                    }else{
                        echo "<h4 class='advice'></h4>";
                    }
                }

            ?>
        </div>
       
    </center>
</body>
</html>