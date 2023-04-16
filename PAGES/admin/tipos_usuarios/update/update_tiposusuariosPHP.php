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
    $admin = $_POST['selAdmin'];    

    //Update no Banco de Dados
    $updateTipoUsuario = "UPDATE TIPUSU SET TIPUSU_Descricao='$descricao', TIPUSU_Administrador = $admin WHERE TIPUSU_Codigo = $codigo;";

    $queryUpdateTipoUsuario = $mysqli->query($updateTipoUsuario) or die("Falha na execução do código sql" . $mysqli->error); 

    //Redireciona para a Página de Gerenciamento de Tipos de Usuários
    header("Location: ../tiposusuarios.php?alterado=1");

?>