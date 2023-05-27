<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../index.php?error=4");
    } 

    //Definição de Variáveis
    $codigo = $_POST['codProduto'];
    $nome = $_POST['txtNome'];
    $descricao = nl2br($_POST['txtDescricao']);    
    $categoria = $_POST['categoriaProduto'];
    $url = $_POST['txtURL'];

    if (isset($_FILES['imgProduto']) && count($_FILES) > 0){        
        $arquivo = $_FILES['imgProduto'];                    
                    
        if($arquivo['size'] > 2097152){
            die("arquivo muito grande!! Max 2MB.");
        }

        if($arquivo['error']){
            //Update no banco de dados
            $updateProduto = "UPDATE TABPRO SET TABPRO_Nome='$nome', TABPRO_Descricao='$descricao', CATATV_Codigo = $categoria, TABPRO_Url='$url' WHERE TABPRO_Codigo = $codigo";        
            $queryUpdateProduto = $mysqli->query($updateProduto) or die("Falha na execução do código sql" . $mysqli->error);           
        }                   

        $pasta = "./arquivos/";
        $nomeDoArquivo = $arquivo['name'];
        $novoNomeDoArquivo = uniqid();        
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));        
        $path = $pasta . $novoNomeDoArquivo. "." . $extensao;
        $deucerto = move_uploaded_file($arquivo["tmp_name"], $path);
        if($deucerto){
            //Update no banco de dados
            $updateProduto = "UPDATE TABPRO SET TABPRO_Nome='$nome', TABPRO_Descricao='$descricao', TABPRO_Imagem = '$path', CATATV_Codigo = $categoria, TABPRO_Url='$url' WHERE TABPRO_Codigo = $codigo";        
            $queryUpdateProduto = $mysqli->query($updateProduto) or die("Falha na execução do código sql" . $mysqli->error);      
        }
    }else{  
        //Update no banco de dados
        $updateProduto = "UPDATE TABPRO SET TABPRO_Nome='$nome', TABPRO_Descricao='$descricao', CATATV_Codigo = $categoria, TABPRO_Url='$url' WHERE TABPRO_Codigo = $codigo";        
        $queryUpdateProduto = $mysqli->query($updateProduto) or die("Falha na execução do código sql" . $mysqli->error);    
    }
?>                         

<!--Redireciona para a Página anterior-->
<script>
    alert('Anúncio atualizado com sucesso!');
    window.location.href = "./anuncio.php";  
</script>