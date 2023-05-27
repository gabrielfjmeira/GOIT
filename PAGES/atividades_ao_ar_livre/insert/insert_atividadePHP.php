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
    $descricao   = nl2br($_POST['txtDescricao']);
    $categoria   = $_POST['categoriaAtividade'];
    $localizacao = $_POST['txtLocalizacao'];
    $referencia  = $_POST['txtReferencia'];
    $inscritos   = $_POST['nbrInscritos'];
    $data        = $_POST['dataAtividade'];
    $hora        = $_POST['horaAtividade'] ;       

    if (isset($_FILES['imgAtividade']) && count($_FILES) > 0){        
        $arquivo = $_FILES['imgAtividade'];                    
                
        if($arquivo['size'] > 2097152){
            die("arquivo muito grande!! Max 2MB.");
        }

        if($arquivo['error']){
            //insere no banco de dados
            $insertAtividade = "INSERT INTO TABATV (TABATV_Codigo, TABUSU_Codigo, TABATV_Titulo, TABATV_Descricao, CATATV_Codigo, TABATV_Localizacao, TABATV_Referencia, TABATV_Inscritos, TABATV_Data, TABATV_Hora, TABATV_Cancelada, TABATV_Created) VALUES (NULL, $usuario, '$titulo', '$descricao', $categoria, '$localizacao', '$referencia', $inscritos, '$data', '$hora', 0, now())";
            $queryInsertAtividade = $mysqli->query($insertAtividade) or die("Falha na execução do código sql" . $mysqli->error);
        }

        $pasta = "../arquivos/";
        $nomeDoArquivo = $arquivo['name'];
        $novoNomeDoArquivo = uniqid();        
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));        
        $path = $pasta . $novoNomeDoArquivo. "." . $extensao;
        $deucerto = move_uploaded_file($arquivo["tmp_name"], $path);
        if($deucerto){
            //insere no banco de dados
            $insertAtividade = "INSERT INTO TABATV (TABATV_Codigo, TABUSU_Codigo, TABATV_Titulo, TABATV_Descricao, TABATV_Imagem, CATATV_Codigo, TABATV_Localizacao, TABATV_Referencia, TABATV_Inscritos, TABATV_Data, TABATV_Hora, TABATV_Cancelada, TABATV_Created) VALUES (NULL, $usuario, '$titulo', '$descricao', '$path', $categoria, '$localizacao', '$referencia', $inscritos, '$data', '$hora', 0, now())";
            $queryInsertAtividade = $mysqli->query($insertAtividade) or die("Falha na execução do código sql" . $mysqli->error);
        }       
        
    }else{
        //insere no banco de dados
        $insertAtividade = "INSERT INTO TABATV (TABATV_Codigo, TABUSU_Codigo, TABATV_Titulo, TABATV_Descricao, CATATV_Codigo, TABATV_Localizacao, TABATV_Referencia, TABATV_Inscritos, TABATV_Data, TABATV_Hora, TABATV_Cancelada, TABATV_Created) VALUES (NULL, $usuario, '$titulo', '$descricao', $categoria, '$localizacao', '$referencia', $inscritos, '$data', '$hora', 0, now())";
        $queryInsertAtividade = $mysqli->query($insertAtividade) or die("Falha na execução do código sql" . $mysqli->error);    
    }         

    //Verifica se é recomendado o auxílio de instrutores na atividade ao ar livre
    $sqlUsuario = "SELECT * FROM TABUSU WHERE TABUSU_Codigo = $usuario";
    $querySqlUsuario = $mysqli->query($sqlUsuario) or die("Falha na execução do código sql" . $mysqli->error);           
    $usuarioData = mysqli_fetch_array($querySqlUsuario);  
    $tipoUsuario = $usuarioData['TIPUSU_Codigo'];        

    $sqlCategoria = "SELECT * FROM CATATV WHERE CATATV_Codigo = $categoria";
    $querySqlCategoria = $mysqli->query($sqlCategoria) or die("Falha na execução do código sql" . $mysqli->error);    
    $categoriaData = mysqli_fetch_array($querySqlCategoria);  
    $risco = $categoriaData['TABRIS_Codigo'];

    $sqlRisco = "SELECT * FROM TABRIS WHERE TABRIS_Codigo = $risco";
    $querySqlRisco = $mysqli->query($sqlRisco) or die("Falha na execução do código sql" . $mysqli->error); 
    $riscoData = mysqli_fetch_array($querySqlRisco);     
    $recomendaInstrutor = $riscoData['TABRIS_Instrutor'];

    if($recomendaInstrutor == 1){
        if($tipoUsuario == 3){
            //Verifica se o instrutor é dessa categoria
            $sqlInstutor = "SELECT * FROM TABINS WHERE TABUSU_Codigo = $usuario";
            $querySqlInstutor = $mysqli->query($sqlInstutor) or die("Falha na execução do código sql" . $mysqli->error);           
            $instrutorData = mysqli_fetch_array($querySqlInstutor);  
            $categoriaInstrutor = $instrutorData['CATATV_Codigo'];
            if($categoriaInstrutor == $categoria){?>
                <!--Redireciona para a Página anterior-->
                <script>
                    alert('Atividade ao ar livre criada com sucesso!');
                    window.location.href = "../../home/home.php";  
                </script>
            <?php
            }else{?>
                <!--Redireciona para a Página anterior-->
                <script>
                    alert('Atividade ao ar livre criada com sucesso! Recomenda-se o auxílio de um instrutor da área!');
                    window.location.href = "../../home/home.php";  
                </script>
            <?php
            }
        }else{?>            
            <!--Redireciona para a Página anterior-->
            <script>
                alert('Atividade ao ar livre criada com sucesso! Recomenda-se o auxílio de um instrutor da área!');
                window.location.href = "../../home/home.php";  
            </script>
        <?php
        }
    }else{?>
        <!--Redireciona para a Página anterior-->
        <script>                
            alert('Atividade ao ar livre criada com sucesso!');
            window.location.href = "../../home/home.php";  
        </script> 
    <?php
    }       
?>  