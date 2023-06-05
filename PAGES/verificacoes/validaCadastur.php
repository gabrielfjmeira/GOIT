<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Define variável de Apelido
    $cadastur = $_GET['cadastur'];
    
    //Verifica se o Cadastur já está cadastrado    
    $cadasturResultado = "SELECT * FROM TABINS WHERE TABINS_Cadastur = '$cadastur'";
    $queryCadasturResultado = $mysqli->query($cadasturResultado) or die("Falha na execução do código sql" . $mysqli->error);
    $qtdCadasturResultado = $queryCadasturResultado->num_rows;
            
    if($qtdCadasturResultado >= 1){
        $result = "Cadastur já cadastrado!";
    }else{
        $result = "";
    }
    
    echo($result);
    
?>