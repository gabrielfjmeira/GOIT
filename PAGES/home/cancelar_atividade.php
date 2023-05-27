<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../index.php?error=4");
    }

    $atividade = $_GET['atividade'];    

    //Cancelamento da Atividade ao Ar Livre   
    $cancelarAtividade = "UPDATE TABATV SET TABATV_Cancelada= 1 WHERE TABATV_Codigo = " . $atividade . " AND TABUSU_Codigo = " . $_SESSION['CODIGO'] . ".;";        
    $queryCancelarAtividade = $mysqli->query($cancelarAtividade) or die("Falha na execução do código sql" . $mysqli->error);        

    //Se houver participantes na atividade, os inscritos serão avisados
    $participantesAtv = "SELECT * FROM PARATV WHERE TABATV_Codigo = " . $atividade . ";";
    $queryParticipantesAtv = $mysqli->query($participantesAtv) or die("Falha na execução do código sql" . $mysqli->error);        
    if($queryParticipantesAtv->num_rows > 0){?>
        <script>
            alert('Todos os participantes que estavam inscritos foram notificados sobre o cancelamento da atividade!');
            window.history.back();
        </script>
        <?php
    }else{?>
        <script>
            window.history.back();
        </script>
        <?php
    }
    ?>

 