<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../index.php?error=4");
    }

    // //Verifica se é um Admin
    // if ($_SESSION['TIPOUSUARIO'] != 1){
    //     header ("Location: ../../home/home.php");
    // }

    //Definição de Variáveis
    $codigo = $_POST['nbrCodigo'];
    $titulo = $_POST['txtTitulo'];
    $descricao = $_POST['txtDescricao'];
    $categoria = $_POST['categoriaAtividade'];
    $localizacao = $_POST['txtLocalizacao'];
    $referencia = $_POST['txtReferencia'];
    $data = $_POST['dataAtividade'];
    $hora = $_POST['horaAtividade'];

    //Update no Banco de Dados
    $updateAtividade = "UPDATE TABATV SET TABATV_Titulo='$titulo', TABATV_Descricao='$descricao', CATATV_Codigo = $categoria, TABATV_Localizacao = '$localizacao', TABATV_Referencia = '$referencia', TABATV_Data='$data', TABATV_Hora='$hora' WHERE TABATV_Codigo = $codigo";
    $queryUpdateAtividade = $mysqli->query($updateAtividade) or die("Falha na execução do código sql" . $mysqli->error); 

    //Redireciona para a Página de Gerenciamento de Riscos de Atividades
    header("Location: ../../home/home.php");

?>