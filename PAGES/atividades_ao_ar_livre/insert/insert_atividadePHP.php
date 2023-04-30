<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../index.php?error=4");
    }

    //Verifica se é um Admin
    if ($_SESSION['TIPOUSUARIO'] != 1){
        header ("Location: ../home/home.php");
    }

    //Cria variáveis
    $usuario     = $_SESSION['CODIGO'];
    $titulo      = $_POST['txtTitulo'];
    $descricao   = $_POST['txtDescricao'];
    $categoria   = $_POST['categoriaAtividade'];
    $localizacao = $_POST['txtLocalizacao'];
    $referencia  = $_POST['txtReferencia'];
    $data        = $_POST['dataAtividade'];
    $hora        = $_POST['horaAtividade'] ;   
    
    if(isset($_FILES['imgAtividade'])){

        //insere no banco de dados
        $imagem = addslashes(file_get_contents($_FILES['imgAtividade']['tmp_name'])); // Prepara para salvar em BD        
        $insertAtividade = "INSERT INTO TABATV (TABATV_Codigo, TABUSU_Codigo, TABATV_Titulo, TABATV_Descricao, TABATV_Imagem, CATATV_Codigo, TABATV_Localizacao, TABATV_Referencia, TABATV_Data, TABATV_Hora, TABATV_Created) VALUES (NULL, $usuario, '$titulo', '$descricao', '$imagem', $categoria, '$localizacao', '$referencia', '$data', '$hora', now())";
        $queryInsertAtividade = $mysqli->query($insertAtividade) or die("Falha na execução do código sql" . $mysqli->error); 

    }else{
        //insere no banco de dados
        $insertAtividade = "INSERT INTO TABATV (TABATV_Codigo, TABUSU_Codigo, TABATV_Titulo, TABATV_Descricao, CATATV_Codigo, TABATV_Localizacao, TABATV_Referencia, TABATV_Data, TABATV_Hora, TABATV_Created) VALUES (NULL, $usuario, '$titulo', '$descricao', $categoria, '$localizacao', '$referencia', '$data', '$hora', now())";
        $queryInsertAtividade = $mysqli->query($insertAtividade) or die("Falha na execução do código sql" . $mysqli->error); 
    }    
    
    //Redireciona para a Página de Home
    header("Location: ../../home/home.php");
?>