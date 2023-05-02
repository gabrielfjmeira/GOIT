<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../index.php?error=4");
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

    if (isset($_FILES['imgAtividade'])){
        $arquivo = $_FILES['imgAtividade'];            
        
        if($arquivo['error']){
          //insere no banco de dados
          $insertAtividade = "INSERT INTO TABATV (TABATV_Codigo, TABUSU_Codigo, TABATV_Titulo, TABATV_Descricao, CATATV_Codigo, TABATV_Localizacao, TABATV_Referencia, TABATV_Data, TABATV_Hora, TABATV_Created) VALUES (NULL, $usuario, '$titulo', '$descricao', $categoria, '$localizacao', '$referencia', '$data', '$hora', now())";
          $queryInsertAtividade = $mysqli->query($insertAtividade) or die("Falha na execução do código sql" . $mysqli->error);
        }
        
        if($arquivo['size'] > 2097152){
            die("arquivo muito grande!! Max 2MB.");
        }

        $pasta = "../arquivos/";
        $nomeDoArquivo = $arquivo['name'];
        $novoNomeDoArquivo = uniqid();        
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));        
        $path = $pasta . $novoNomeDoArquivo. "." . $extensao;
        $deucerto = move_uploaded_file($arquivo["tmp_name"], $path);
        if($deucerto){
            //insere no banco de dados
            $insertAtividade = "INSERT INTO TABATV (TABATV_Codigo, TABUSU_Codigo, TABATV_Titulo, TABATV_Descricao, TABATV_Imagem, CATATV_Codigo, TABATV_Localizacao, TABATV_Referencia, TABATV_Data, TABATV_Hora, TABATV_Created) VALUES (NULL, $usuario, '$titulo', '$descricao', '$path', $categoria, '$localizacao', '$referencia', '$data', '$hora', now())";
            $queryInsertAtividade = $mysqli->query($insertAtividade) or die("Falha na execução do código sql" . $mysqli->error);
        }       
        
    }    
      
    //Redireciona para a Página de Home
    header("Location: ../../home/home.php");
?>