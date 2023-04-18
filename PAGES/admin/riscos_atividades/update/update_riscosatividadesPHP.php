<?php
    //Incluí Conexão
    include('../../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../../index.php?error=4");
    }

    //Verifica se é um Admin
    if ($_SESSION['TIPOUSUARIO'] != 1){
        header ("Location: ../../../home/home.php");
    }

    //Definição de Variáveis
    $codigo = $_POST['nbrCodigo'];
    $descricao = $_POST['txtDescricao'];
    $minimo = $_POST['nbrMinimo'];
    $maximo = $_POST['nbrMaximo'];
    $instrutor = $_POST['selInstrutor'];

    //Update no Banco de Dados
    $updateRiscoAtividade = "UPDATE TABRIS SET TABRIS_Descricao='$descricao', TABRIS_Minimo = $minimo, TABRIS_Maximo = $maximo, TABRIS_Instrutor = $instrutor WHERE TABRIS_Codigo = $codigo;";
    $queryUpdateRiscoAtividade = $mysqli->query($updateRiscoAtividade) or die("Falha na execução do código sql" . $mysqli->error); 

    //Redireciona para a Página de Gerenciamento de Riscos de Atividades
    header("Location: ../riscosatividades.php?alterado=1");

?>