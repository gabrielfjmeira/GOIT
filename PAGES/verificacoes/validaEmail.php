<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');
            
    //Verifica se o email já está cadastrado
    $email = $_GET['email'];
    $emailResultado = "SELECT * FROM TABUSU WHERE TABUSU_Email = '$email'";
    $queryEmailResultado = $mysqli->query($emailResultado) or die("Falha na execução do código sql" . $mysqli->error);
    $qtdEmailResultado = $queryEmailResultado->num_rows;

    if($qtdEmailResultado >= 1){
        $result = "Email já cadastrado!";
    }else{
        $result = "";
    }

    echo($result);

?>