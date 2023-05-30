<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../index.php?error=4");
    }
    
    //Excluí a o perfil se Receber seu Código    
    $codigo = $_SESSION['CODIGO'];               

    //Excluí os anúncios do lojista
    $anuncio = "SELECT * FROM TABPRO WHERE TABUSU_Codigo = $codigo";
    $queryAnuncio = $mysqli->query($anuncio) or die("Falha na execução do código sql" . $mysqli->error);

    if($queryAnuncio->num_rows > 0){                                      
        $deleteAnuncio = "DELETE FROM TABPRO WHERE TABUSU_Codigo = $codigo";
        $queryDeleteAnuncio = $mysqli->query($deleteAnuncio) or die("Falha na execução do código sql" . $mysqli->error);           
    }

    //Verifica se o usuário tem atividades ao ar livre criadas
    $atividade = "SELECT * FROM TABATV WHERE TABUSU_Codigo = $codigo";
    $queryAtividade = $mysqli->query($atividade) or die("Falha na execução do código sql" . $mysqli->error);

    if($queryAtividade->num_rows > 0){                                      
        $deleteAtividade = "DELETE FROM TABATV WHERE TABUSU_Codigo = $codigo";
        $queryDeleteAtividade = $mysqli->query($deleteAtividade) or die("Falha na execução do código sql" . $mysqli->error);           
    }
          
    //Apaga os dados cadastrais
    $deleteLojista = "DELETE FROM TABLOJ WHERE TABUSU_Codigo = $codigo";
    $queryDeleteLojista = $mysqli->query($deleteLojista) or die("Falha na execução do código sql" . $mysqli->error);  
    $deleteUsr = "DELETE FROM TABUSU WHERE TABUSU_Codigo = $codigo";
    $queryDeleteUsr = $mysqli->query($deleteUsr) or die("Falha na execução do código sql" . $mysqli->error);

    header ("Location: ../../../CONFIG/login/logout.php");
?>                             