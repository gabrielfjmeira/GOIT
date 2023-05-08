<?php     
    //Incluí conexão
    include('./CONNECTIONS/connection.php');     
    
    //Verifica se o Usuário está Logado
    if ($_SESSION['LOGGED'] == True){
        header ("Location: ./PAGES/home/home.php");
    }   

    $usuario = $_GET['usuario'];
    $tipoUsuario = $_GET['tipo'];
    if($tipoUsuario == 3){
        $updateInstrutor = "UPDATE TABINS SET TABINS_Negado=0 WHERE TABUSU_Codigo = $usuario";        
        $queryUpdateInstrutor = $mysqli->query($updateInstrutor) or die("Falha na execução do código sql" . $mysqli->error);           
    }else{
        $updateLojista = "UPDATE TABLOJ SET TABLOJ_Negado=0 WHERE TABUSU_Codigo = $usuario";        
        $queryUpdateLojista = $mysqli->query($updateLojista) or die("Falha na execução do código sql" . $mysqli->error); 
    }

    header ("Location: ./index.php");
?>