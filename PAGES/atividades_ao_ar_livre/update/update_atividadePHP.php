<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../index.php?error=4");
    } 

    //Definição de Variáveis
    $codigo = $_POST['nbrCodigo'];
    $titulo = $_POST['txtTitulo'];
    $descricao = $_POST['txtDescricao'];    
    $categoria = $_POST['categoriaAtividade'];
    $localizacao = $_POST['txtLocalizacao'];
    $referencia = $_POST['txtReferencia'];
    $data = $_POST['dataAtividade'];
    $hora = $_POST['horaAtividade'];

    if (isset($_FILES['imgAtividade']) && count($_FILES) > 0){        
        $arquivo = $_FILES['imgAtividade'];                    
                
        if($arquivo['size'] > 2097152){
            die("arquivo muito grande!! Max 2MB.");
        }

        if($arquivo['error']){
            //Update no banco de dados
            $updateAtividade = "UPDATE TABATV SET TABATV_Titulo='$titulo', TABATV_Descricao='$descricao', CATATV_Codigo = $categoria, TABATV_Localizacao = '$localizacao', TABATV_Referencia = '$referencia', TABATV_Data='$data', TABATV_Hora='$hora' WHERE TABATV_Codigo = $codigo";        
            $queryUpdateAtividade = $mysqli->query($updateAtividade) or die("Falha na execução do código sql" . $mysqli->error);           }       
        }

        $pasta = "../arquivos/";
        $nomeDoArquivo = $arquivo['name'];
        $novoNomeDoArquivo = uniqid();        
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));        
        $path = $pasta . $novoNomeDoArquivo. "." . $extensao;
        $deucerto = move_uploaded_file($arquivo["tmp_name"], $path);
        if($deucerto){
            //Update no banco de dados
            $updateAtividade = "UPDATE TABATV SET TABATV_Titulo='$titulo', TABATV_Descricao='$descricao', TABATV_Imagem = '$path', CATATV_Codigo = $categoria, TABATV_Localizacao = '$localizacao', TABATV_Referencia = '$referencia', TABATV_Data='$data', TABATV_Hora='$hora' WHERE TABATV_Codigo = $codigo";        
            $queryUpdateAtividade = $mysqli->query($updateAtividade) or die("Falha na execução do código sql" . $mysqli->error);       
        
    }else{
        //Update no banco de dados
        $updateAtividade = "UPDATE TABATV SET TABATV_Titulo='$titulo', TABATV_Descricao='$descricao', CATATV_Codigo = $categoria, TABATV_Localizacao = '$localizacao', TABATV_Referencia = '$referencia', TABATV_Data='$data', TABATV_Hora='$hora' WHERE TABATV_Codigo = $codigo";        
        $queryUpdateAtividade = $mysqli->query($updateAtividade) or die("Falha na execução do código sql" . $mysqli->error);    
    }                            

    //Redireciona para a Página de Gerenciamento de Riscos de Atividades
    header("Location: ../../home/home.php");

?>