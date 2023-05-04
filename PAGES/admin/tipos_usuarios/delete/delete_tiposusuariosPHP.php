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

    //Verifica se Recebeu um Código para Excluir
    if (isset($_GET['codigo'])){
        $codigo = $_GET['codigo'];

        //Verifica se Tem Usuários Cadastrados com este tipo
        $usuariosTipo = "SELECT * FROM TABUSU WHERE TIPUSU_Codigo = $codigo";
        $queryUsuariosTipo = $mysqli->query($usuariosTipo) or die("Falha na execução do código sql" . $mysqli->error);

        if ($queryUsuariosTipo->num_rows == 0){
        
            $tipoUsuario = "SELECT * FROM TIPUSU WHERE TIPUSU_Codigo = $codigo";
            $queryTipoUsuario = $mysqli->query($tipoUsuario) or die("Falha na execução do código sql" . $mysqli->error);

            if ($queryTipoUsuario->num_rows == 1){

                $deleteTipoUsuario = "DELETE FROM TIPUSU WHERE TIPUSU_Codigo = $codigo";
                $queryDeleteTipoUsuario = $mysqli->query($deleteTipoUsuario) or die("Falha na execução do código sql" . $mysqli->error);
                header ("Location: ../tiposusuarios.php?excluido=1");

            }else{
                header ("Location: ../tiposusuarios.php");
            }

        }else{
            header ("Location: ../tiposusuarios.php?error=1");
        }
        
    }else{
        header ("Location: ../tiposusuarios.php");
    }    
?>