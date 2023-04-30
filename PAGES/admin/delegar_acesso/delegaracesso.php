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

    //Carrega os Registros da Tabela de Instrutores e Lojistas que não estão verificados
    $instrutoresNaoVerificados = "SELECT * FROM TABUSU INNER JOIN TABINS ON TABUSU.TABUSU_Codigo = TABINS.TABUSU_Codigo WHERE TABINS.TABINS_Verificado = 0 ORDER BY TABUSU.TABUSU_Codigo ASC";
    $queryInstrutoresNaoVerificados = $mysqli->query($instrutoresNaoVerificados) or die("Falha na execução do código sql" . $mysqli->error);

    $lojistasNaoVerificados = "SELECT * FROM TABUSU INNER JOIN TABLOJ ON TABUSU.TABUSU_Codigo = TABLOJ.TABUSU_Codigo WHERE TABLOJ.TABLOJ_Verificado = 0 ORDER BY TABUSU.TABUSU_Codigo ASC";
    $queryLojistasNaoVerificados = $mysqli->query($lojistasNaoVerificados) or die("Falha na execução do código sql" . $mysqli->error);
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
            <h1>DELEGAR ACESSO A PLATAFORMA</h1>              
        </header>

        <!--Registros do Banco-->
        <div>
            <table>
                <thead>
                    <tr>
                        <th scope="col"   hidden>#</th>
                        <th scope="col"   width="200px">Nome/Razão Social</th> 
                        <th scope="col"   width="100px">Apelido/Fantasia</th>
                        <th scope='col'   width="200px">Cadastur/CNPJ</th>
                        <th scope="col"   width="100px">Solicitado Em</th>
                        <th scope="col"   width="270px">Ações</th>
                    </tr>                
                </thead>   
                <tbody>
                    <?php
                        if($queryInstrutoresNaoVerificados->num_rows > 0 || $queryLojistasNaoVerificados->num_rows > 0){   

                            //Imprime instrutores que solicitaram o acesso para a plataforma         
                            while($intrutorNaoVerificado = mysqli_fetch_assoc($queryInstrutoresNaoVerificados)){                           
                                $codigo = $intrutorNaoVerificado['TABUSU_Codigo'];
                                $nome = $intrutorNaoVerificado['TABINS_Nome'];
                                $apelido = $intrutorNaoVerificado['TABINS_Apelido'];
                                $cadastur = $intrutorNaoVerificado['TABINS_Cadastur'];
                                $solicitado = $intrutorNaoVerificado['TABUSU_Created'];?>

                                <tr>
                                    <td hidden><?php echo $codigo;?></td>
                                    <td align="center" width="200px"><?php echo $nome;?></td>                                                                        
                                    <td align="center" width="100px"><?php echo $apelido;?></td>
                                    <td align="center" width="200px"><?php echo $cadastur;?></td>
                                    <td align="center" width="100px"><?php echo $solicitado;?></td>
                                    <td align="center" width="270px">
                                        <a href="./delegar_acessoPHP.php?codigo=<?php echo $codigo?>&&tipo=1">
                                            <input type="button" class="button-alterar" value="Permitir">
                                        </a>                                        
                                        <a href="./negar_acessoPHP.php?codigo=<?php echo $codigo?>&&tipo=1">
                                            <input type="button" value="Negar">
                                        </a>                                    
                                    </td>
                                </tr>
                            <?php
                            }

                            //Imprime lojistas que solicitaram o acesso para a plataforma
                            while($lojistaNaoVerificado = mysqli_fetch_assoc($queryLojistasNaoVerificados)){                           
                                $codigo = $lojistaNaoVerificado['TABUSU_Codigo'];
                                $razaosocial = $lojistaNaoVerificado['TABLOJ_RazaoSocial'];
                                $fantasia = $lojistaNaoVerificado['TABLOJ_Fantasia'];
                                $cnpj = $lojistaNaoVerificado['TABLOJ_CNPJ'];
                                $solicitado = $lojistaNaoVerificado['TABUSU_Created'];?>

                                <tr>
                                    <td hidden><?php echo $codigo;?></td>
                                    <td align="center" width="200px"><?php echo $razaosocial;?></td>                                                                        
                                    <td align="center" width="100px"><?php echo $fantasia;?></td>
                                    <td align="center" width="200px"><?php echo $cnpj;?></td>
                                    <td align="center" width="100px"><?php echo $solicitado;?></td>
                                    <td align="center" width="270px">
                                        <a href="./delegar_acessoPHP.php?codigo=<?php echo $codigo?>&tipo=2">
                                            <input type="button" class="button-alterar" value="Permitir">
                                        </a>                                        
                                        <a href="./negar_acessoPHP.php?codigo=<?php echo $codigo?>&tipo=2">
                                            <input type="button" value="Negar">
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
            <!--Botão para voltar para a home do admin-->            
            <button onclick="window.location.href = '../admin.php';">
                Voltar ⬅
            </button>
        </div>    

        <div>
            <?php
                //Mensagem de acesso delegado
                if (isset($_GET['delegado'])){
                    $delegado = $_GET['delegado'];                        
                    if ($delegado == 1){                    
                        echo "<h4 class='advice'>Acesso delegado com sucesso!</h4>";
                    }
                }

                //Mensagem de acesso negado
                if (isset($_GET['negado'])){
                    $negado = $_GET['negado'];                        
                    if ($negado == 1){                    
                        echo "<h4 class='advice'>Acesso negado com sucesso!</h4>";
                    }
                }                
            ?>
        </div>
       
    </center>
</body>
</html>