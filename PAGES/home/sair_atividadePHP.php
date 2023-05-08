<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../index.php?error=4");
    }

    $atividade = $_GET['atividade'];
    $usuario   = $_SESSION['CODIGO'];

    //Delete do usuário na atividade    
    $deleteUsuarioAtividade = "DELETE FROM PARATV WHERE TABATV_Codigo = $atividade AND TABUSU_Codigo = $usuario";
    $queryDeleteUsuarioAtividade = $mysqli->query($deleteUsuarioAtividade) or die("Falha na execução do código sql" . $mysqli->error);    
    ?>
    <script>        
        window.history.back();
    </script>
