<?php
//Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Define variável de Apelido
    $apelido = $_GET['apelido'];    

    //Verifica se o Apelido ja Está Cadastrado
    $apelidoPraticante = "SELECT * FROM TABPRA WHERE TABPRA_Apelido = '" . $apelido ."';";
    $apelidoPraticanteResultado = $mysqli->query($apelidoPraticante) or die("Falha na execução do código sql" . $mysqli->error);
    $qtdPraticanteResultado = $apelidoPraticanteResultado->num_rows;

    $apelidoInstrutor = "SELECT * FROM TABINS WHERE TABINS_Apelido = '" . $apelido . "';";
    $apelidoInstrutorResultado = $mysqli->query($apelidoInstrutor) or die("Falha na execução do código sql" . $mysqli->error);
    $qtdInstrutorResultado = $apelidoInstrutorResultado->num_rows;

    $fantasiaLoja = "SELECT * FROM TABLOJ WHERE TABLOJ_Fantasia = '" . $apelido . "';";
    $fantasiaLojaResultado = $mysqli->query($fantasiaLoja) or die("Falha na execução do código sql" . $mysqli->error);
    $qtdLojaResultado = $fantasiaLojaResultado->num_rows;

    $qtdApelidos = $qtdPraticanteResultado + $qtdInstrutorResultado + $qtdLojaResultado;
    
    if($qtdApelidos >= 1){
        $result = "Apelido já cadastrado!";
    }else{
        $result = "";
    }
    
    echo($result);
    
?>   