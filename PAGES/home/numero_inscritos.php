<?php   
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../index.php?error=4");
    } 

    $codigoAtv = $_POST['codigoatividade'];
    $sqlInscritos = "SELECT * FROM PARATV WHERE TABATV_Codigo = $codigoAtv";
    $querySqlInscritos = $mysqli->query($sqlInscritos) or die(mysql_error());
    $inscritos = $querySqlInscritos->num_rows + 1;

    print $inscritos;
                       
?>