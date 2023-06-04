<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../index.php?error=4");
    }
    
    //Cria variáveis
    if(isset($_POST['categoriaProduto'])){
        $usuario     = $_SESSION['CODIGO'];
        $nome        = $_POST['txtNome'];
        $valor       =  $_POST['nbrValor'];
        $categoria   = $_POST['categoriaProduto'];   
        $url         = $_POST['txtURL'];

        if (isset($_FILES['imgProduto']) && count($_FILES) > 0){        
            $arquivo = $_FILES['imgProduto'];                    
                    
            if($arquivo['size'] > 2097152){
                die("arquivo muito grande!! Max 2MB.");
            }

            if($arquivo['error']){
                ?>
                <script>
                    alert('Erro ao Publicar Anúncio, Tente Novamente!');
                    window.location.href = "./anuncio.php";  
                </script>
                <?php
            }
            $pasta = "./arquivos/";
            $nomeDoArquivo = $arquivo['name'];
            $novoNomeDoArquivo = uniqid();        
            $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));        
            $path = $pasta . $novoNomeDoArquivo. "." . $extensao;
            $deucerto = move_uploaded_file($arquivo["tmp_name"], $path);
            if($deucerto){
                //insere no banco de dados
                $insertProduto = "INSERT INTO TABPRO (TABPRO_Codigo, TABUSU_Codigo, TABPRO_Nome, TABPRO_Valor, TABPRO_Imagem, CATATV_Codigo, TABPRO_Url) VALUES (NULL, $usuario, '$nome', $valor, '$path', $categoria, '$url')";
                $queryInsertProduto = $mysqli->query($insertProduto) or die("Falha na execução do código sql" . $mysqli->error);
            }       
            
        }
    }else{
        header("Location: ./anuncio_insert.php?error=1");
    }           
?>
<!--Redireciona para a Página anterior-->
<script>
    alert('Anúncio Publicado com sucesso!');
    window.location.href = "./anuncio.php";  
</script>
