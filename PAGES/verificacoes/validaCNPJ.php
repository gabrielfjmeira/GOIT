<?php
//Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Define variável de Apelido
    $cnpj = $_GET['cnpj'];
    
    //Verifica se já tem o CNPJ Cadastrado              
    $cnpjResultado = "SELECT * FROM TABLOJ WHERE TABLOJ_CNPJ = '$cnpj'";
    $querycnpjResultado = $mysqli->query($cnpjResultado) or die("Falha na execução do código sql" . $mysqli->error);
    $qtdCnpjResultado = $querycnpjResultado->num_rows;   
        
    if($qtdCnpjResultado >= 1){
        $result = "CNPJ já cadastrado!";
    }else{
        $result = "";
    }
    
    echo($result);
    
?>   