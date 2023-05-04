<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../index.php?error=4");
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
            <button onclick="window.location.href = '../home/home.php'">
                Voltar ⬅
            </button> 
        </center>
    </section>
             
    <?php

    if(isset($_GET['atividade'])){            
        
        $codigo = $_GET['atividade'];

        //Imprime Atividade ao Ar Livre
        $atividade = "SELECT * FROM TABATV WHERE TABATV_Codigo = $codigo";      
        $queryAtividade = $mysqli->query($atividade) or die(mysql_error());
        $atividade_data = mysqli_fetch_array($queryAtividade);

        if ($queryAtividade->num_rows == 1){?>
            <center>
                <div class="publicacao_extendida">
                    <h1><?php echo $atividade_data['TABATV_Titulo'];?></h1>  
                    <h2>Data: <?php echo $atividade_data['TABATV_Data'];?> &nbsp;&nbsp;&nbsp; Hora: <?php echo $atividade_data['TABATV_Hora'];?></h2>
                    <h2>Localização: <?php echo $atividade_data['TABATV_Localizacao'];?></h2>                    
                    <h2>Referência: <?php echo $atividade_data['TABATV_Referencia'];?></h2>                        
                    <h2>Descrição: </h2>                    
                    <h3><?php echo $atividade_data['TABATV_Descricao'];?></h3>                        
                    
                    
                    <h2>Atividade Criada Por <?php
                    
                        //Carrega o apelido/fantasia do Criador da Atividade ao Ar Livre
                        $usuario = $atividade_data['TABUSU_Codigo'];
                        $registroUsuario = "SELECT * FROM TABUSU WHERE TABUSU_Codigo = $usuario";                       
                        $queryRegistroUsuario = $mysqli->query($registroUsuario) or die(mysql_error());
                        $usuario_data = mysqli_fetch_array($queryRegistroUsuario);
                        $tipousuario = $usuario_data['TIPUSU_Codigo'];

                        switch($tipousuario){
                            //Administrador
                            case 1:
                                echo "Administrador";
                                break;                        
                            //Praticante
                            case 2:
                                $praticante = "SELECT * FROM TABPRA WHERE TABUSU_Codigo = $usuario";
                                $queryPraticante = $mysqli->query($praticante) or die(mysql_error());
                                $praticante_data = mysqli_fetch_array($queryPraticante);
                                echo $praticante_data['TABPRA_Apelido'];
                                break;                        
                            //Instrutor                        
                            case 3:
                                $instrutor = "SELECT * FROM TABINS WHERE TABUSU_Codigo = $usuario";
                                $queryInstrutor = $mysqli->query($instrutor) or die(mysql_error());
                                $instrutor_data = mysqli_fetch_array($queryInstrutor);
                                echo $instrutor_data['TABINS_Apelido'];
                                break;                        
                            //Lojista
                            case 4:
                                $lojista = "SELECT * FROM TABLOJ WHERE TABUSU_Codigo = $usuario";
                                $queryLojista = $mysqli->query($lojista) or die(mysql_error());
                                $lojista_data = mysqli_fetch_array($queryLojista);
                                echo $lojista_data['TABLOJ_Fantasia'];
                                break;                        
                        }
                    
                    ?></h2>
                </div>   
            </center>
        <?php
        }else{
            header ("Location: ../home/home.php");
        }       
    
    }else{
        header ("Location: ../home/home.php");
    }?>                                                   

</body>
</html>