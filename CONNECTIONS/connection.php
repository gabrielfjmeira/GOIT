<?php  

    //Conexão com o Banco
    $usuario = 'root';
    $senha = '';
    $database = 'goit_db';
    $host = 'localhost:3312';

    $mysqli = new mysqli($host, $usuario, $senha, $database);

    if($mysqli->error){
        die("Falha ao conectar ao banco de dados: ") . $mysqli->error;
    }

?>
