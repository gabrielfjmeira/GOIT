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
    <!--Conteúdo-->    
    <h1>HOME</h1>
    <?php
        if ($_SESSION['TIPOUSUARIO'] == 1){
            include('../templates/headers/header_adm.html');
        } else{
            include('../templates/headers/header_users.html');
        }          
    
        //Imprime Atividades ao Ar Livre
        $atividades = "SELECT * FROM TABATV ORDER BY TABATV_Data ASC";      
        $queryAtividades = $mysqli->query($atividades) or die(mysql_error());

        if ($queryAtividades->num_rows > 0){
            while($atividade = mysqli_fetch_array($queryAtividades)){?>
                <div class="publicacao">
                    <h3><?php echo $atividade['TABATV_Titulo'];?></h3>            
                    <h4>Data: <?php echo $atividade['TABATV_Data'];?></h4>
                    <h4>Hora: <?php echo $atividade['TABATV_Hora'];?></h4>
                    <h4>Localização: <?php echo $atividade['TABATV_Localizacao'];?></h4>
                    <br>
                    <h5>Atividade Criada Por <?php
                    
                        //Carrega o apelido/fantasia do Criador da Atividade ao Ar Livre
                        $usuario = $_SESSION['CODIGO'];
                        $tipousuario = $_SESSION['TIPOUSUARIO'];
    
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
                    
                    ?></h5>
                </div><?php               
            }                       
        }else{?>
            <div>
                <h3>Sem Atividades Ao Ar Livre Cadastradas!</h3>
            </div>            
        <?php 
        }?>                                                   

</body>
</html>