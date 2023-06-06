<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../index.php?error=4");
    }
    
    //Excluí a o perfil se Receber seu Código    
    $codigo = $_SESSION['CODIGO'];               

    //Verifica se é inscrito em uma atividade ao ar livre
    $inscrito = "SELECT * FROM PARATV WHERE TABUSU_Codigo = $codigo";
    $queryInscrito = $mysqli->query($inscrito) or die("Falha na execução do código sql" . $mysqli->error);

    if($queryInscrito->num_rows > 0){                                      
        $deleteParticipacao = "DELETE FROM PARATV WHERE TABUSU_Codigo = $codigo";
        $queryDeleteParticipacao = $mysqli->query($deleteParticipacao) or die("Falha na execução do código sql" . $mysqli->error);           
    }

    //Verifica se o usuário tem atividades ao ar livre criadas
    $atividade = "SELECT * FROM TABATV WHERE TABUSU_Codigo = $codigo";
    $queryAtividade = $mysqli->query($atividade) or die("Falha na execução do código sql" . $mysqli->error);

    if($queryAtividade->num_rows > 0){
        while($atvData = mysqli_fetch_array($queryAtividade)){            
            $selectParticipacoesOutrosUsers = "SELECT * FROM PARATV WHERE TABATV_Codigo = " . $atvData['TABATV_Codigo'] . ";";
            $queryParticipacoesOutrosUsers = $mysqli->query($selectParticipacoesOutrosUsers) or die("Falha na execução do código sql" . $mysqli->error);
            if($queryParticipacoesOutrosUsers->num_rows > 0){
                $deleteParticipacoesOutrosUsers = "DELETE FROM PARATV WHERE TABATV_Codigo = " . $atvData['TABATV_Codigo'] . ";";
                $queryDeleteParticipacoesOutrosUsers = $mysqli->query($deleteParticipacoesOutrosUsers) or die("Falha na execução do código sql" . $mysqli->error);
            }
        }                                            
        $deleteAtividade = "DELETE FROM TABATV WHERE TABUSU_Codigo = $codigo";
        $queryDeleteAtividade = $mysqli->query($deleteAtividade) or die("Falha na execução do código sql" . $mysqli->error);           
    }
          
    //Apaga os dados cadastrais
    $deleteInstrutor = "DELETE FROM TABINS WHERE TABUSU_Codigo = $codigo";
    $queryDeleteInstrutor = $mysqli->query($deleteInstrutor) or die("Falha na execução do código sql" . $mysqli->error);  
    $deleteUsr = "DELETE FROM TABUSU WHERE TABUSU_Codigo = $codigo";
    $queryDeleteUsr = $mysqli->query($deleteUsr) or die("Falha na execução do código sql" . $mysqli->error);

    header ("Location: ../../../CONFIG/login/logout.php");
?>                             