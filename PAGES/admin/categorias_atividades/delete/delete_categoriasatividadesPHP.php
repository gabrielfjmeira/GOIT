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
        
        //Verifica se Tem Atividades ao Ar Livre com Esta Categoria de Atividade ao Ar Livre
        $atividadesCategoria = "SELECT * FROM TABATV WHERE CATATV_Codigo = $codigo";
        $queryAtividadesCategoria = $mysqli->query($atividadesCategoria) or die("Falha na execução do código sql" . $mysqli->error);

        if ($queryAtividadesCategoria->num_rows == 0){
            $categoriaAtividade = "SELECT * FROM CATATV WHERE CATATV_Codigo = $codigo";
            $queryCategoriaAtividade = $mysqli->query($categoriaAtividade) or die("Falha na execução do código sql" . $mysqli->error);

            if ($queryCategoriaAtividade->num_rows == 1){

                $deleteCategoriaAtividade = "DELETE FROM CATATV WHERE CATATV_Codigo = $codigo";
                $queryDeleteCategoriaAtividade = $mysqli->query($deleteCategoriaAtividade) or die("Falha na execução do código sql" . $mysqli->error);
                header ("Location: ../categoriasatividades.php?excluido=1");

            }else{
                header ("Location: ../categoriasatividades.php");
            }
        }else{
            header ("Location: ../categoriasatividades.php?error=1");
        }    
    }else{
        header ("Location: ../categoriasatividades.php");
    }    
?>