<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../index.php?error=4");
    }

    $atividade = $_GET['atividade'];
    $usuario   = $_SESSION['CODIGO'];

    //Inserção do usuário na atividade    
    $insertUsuarioAtividade = "INSERT INTO PARATV (TABATV_Codigo, TABUSU_Codigo, PARATV_Created) VALUES ($atividade, $usuario, now())";
    $queryInsertUsuarioAtividade = $mysqli->query($insertUsuarioAtividade) or die("Falha na execução do código sql" . $mysqli->error);    
    ?>
    <script>
        alert('Inscrição realizada com sucesso!');
        window.history.back();
    </script>

