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
    $risco = $_POST['riscoAtividade'];    

    //Update no Banco de Dados
    $updateCategoriaAtividade = "UPDATE CATATV SET CATATV_Descricao='$descricao', TABRIS_Codigo = $risco WHERE CATATV_Codigo = $codigo;";
    $queryUpdateCategoriaAtividade = $mysqli->query($updateCategoriaAtividade) or die("Falha na execução do código sql" . $mysqli->error); 

    //Redireciona para a Página de Gerenciamento de Categorias de Atividaes
    header("Location: ../categoriasatividades.php?alterado=1");

?>