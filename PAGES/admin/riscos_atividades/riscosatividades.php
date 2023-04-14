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

    //Carrega os Registros da Tabela de Riscos de Atividades
    $riscosAtividades = "SELECT * FROM TABRIS ORDER BY TABRIS_Codigo ASC;";
    $queryRiscosAtividades = $mysqli->query($riscosAtividades) or die("Falha na execução do código sql" . $mysqli->error);
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
            <h1>GERENCIAR RISCOS DE ATIVIDADES</h1>              
        </header>

        <!--Registros do Banco-->
        <div>
            <table>
                <thead>
                    <tr>
                        <th scope="col" hidden>#</th>
                        <th scope="col"   width="200px">Descrição</th> 
                        <th scope="col"   width="100px">Mínimo</th>
                        <th scope="col"   width="100px">Máximo</th>
                        <th scope="col"   width="200px">Recomenda-se Instrutor</th>
                        <th width='270px' width="270px">Ações</th>
                    </tr>                
                </thead>   
                <tbody>
                    <?php
                        if($queryRiscosAtividades->num_rows > 0){                  
                            while($riscosAtividades_data = mysqli_fetch_assoc($queryRiscosAtividades)){                           
                                $codigo = $riscosAtividades_data['TABRIS_Codigo'];?>

                                <tr>
                                    <td hidden><?php echo $riscosAtividades_data['TABRIS_Codigo']?></td>
                                    <td align="center" width="200px"><?php echo $riscosAtividades_data['TABRIS_Descricao']?></td>
                                    <td align="center" width="100px"><?php echo $riscosAtividades_data['TABRIS_Minimo']?></td>
                                    <td align="center" width="100px"><?php echo $riscosAtividades_data['TABRIS_Maximo']?></td>
                                    <?php
                                    if ($riscosAtividades_data['TABRIS_Instrutor'] == 1){?>
                                        <td align="center" width="200px">Sim</td>
                                    <?php    
                                    }else{?>
                                        <td align="center" width="200px">Não</td>
                                    <?php
                                    }?>
                                    <td align="center" width="270px">
                                        <a href="./update/update_riscosatividades.php?codigo=<?php echo $codigo?>">
                                            <input type="button" class="button-alterar" value="Alterar">
                                        </a>                                        
                                        <a href="./delete/riscosatividades_del_PHP.php?codigo=<?php echo $riscosAtividades_data['TABRIS_Codigo']?>">
                                            <input type="button" value="Excluir">
                                        </a>                                    
                                    </td>
                                </tr>
                            <?php
                            }
                        }else{?>
                            <tr>
                                <td class="font" colspan="5" align="center"> Sem registros no banco! </td>;
                            </tr>";
                        <?php
                        }
                    ?>
                </tbody>             
            </table>
        </div>        
        
        <div>
            <!--Inserir Novo Risco de Atividade-->
            <button type="button" class='button' onclick="location.href='./insert/insert_riscosatividades.php'">
                Inserir Risco de Atividade
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
                        echo "<h4 class='advice'>Risco de atividade inserido com sucesso!</h4>";
                    }else{
                        echo "<h4 class='advice'></h4>";
                    }
                }

                //Mensagem de Alteração
                if (isset($_GET['alterado'])){
                    $alterado = $_GET['alterado'];                        
                    if ($alterado == 1){                    
                        echo "<h4 class='advice'>Risco de atividade alterado com sucesso!</h4>";
                    }else{
                        echo "<h4 class='advice'></h4>";
                    }
                }
            ?>
        </div>
    </center>
</body>
</html>