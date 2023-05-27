<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../index.php?error=4");
    } 
    
    //Excluí a Atividade se Receber seu Código
    if (isset($_GET['codigo'])){
        $codigo = $_GET['codigo'];               

        $deleteProduto = "DELETE FROM TABPRO WHERE TABPRO_Codigo = $codigo";
        $queryDeleteProduto = $mysqli->query($deleteProduto) or die("Falha na execução do código sql" . $mysqli->error);
        header ("Location: ./anuncio.php");
    } else {
        header ("Location: ./anuncio.php");
    }
?>
