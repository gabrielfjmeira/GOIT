<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../index.php?error=4");
    }
    
    //Define variável de Apelido
    $apelido = $_POST['txtApelido'];

    $apelidoAtual = "SELECT * FROM TABPRA WHERE TABUSU_Codigo = " . $_SESSION['CODIGO'];
    $queryApelidoAtual = $mysqli->query($apelidoAtual) or die("Falha na execução do código sql" . $mysqli->error);
    $apelido_data = mysqli_fetch_assoc($queryApelidoAtual);
    $apelidoCadastrado = $apelido_data['TABPRA_Apelido'];

    $codigo = $_SESSION['CODIGO'];
    
    if($apelidoCadastrado != $apelido){
        //Verifica se o Apelido ja Está Cadastrado
        $apelidoPraticante = "SELECT * FROM TABPRA WHERE TABPRA_Apelido = '$apelido'";
        $apelidoPraticanteResultado = $mysqli->query($apelidoPraticante) or die("Falha na execução do código sql" . $mysqli->error);
        $qtdPraticanteResultado = $apelidoPraticanteResultado->num_rows;

        $apelidoInstrutor = "SELECT * FROM TABINS WHERE TABINS_Apelido = '$apelido'";
        $apelidoInstrutorResultado = $mysqli->query($apelidoInstrutor) or die("Falha na execução do código sql" . $mysqli->error);
        $qtdInstrutorResultado = $apelidoInstrutorResultado->num_rows;

        $fantasiaLoja = "SELECT * FROM TABLOJ WHERE TABLOJ_Fantasia = '$apelido'";
        $fantasiaLojaResultado = $mysqli->query($fantasiaLoja) or die("Falha na execução do código sql" . $mysqli->error);
        $qtdLojaResultado = $fantasiaLojaResultado->num_rows;

        $qtdApelidos = $qtdPraticanteResultado + $qtdInstrutorResultado + $qtdLojaResultado;

        if($qtdApelidos < 1){                                   

            //Cria variáveis                                     
            $nome           = strtoupper($_POST['txtNome']);            
            $dataNascimento = $_POST['dataNascimento'];               
            
            if (isset($_FILES['imgPerfil']) && count($_FILES) > 0){        
                $arquivo = $_FILES['imgPerfil'];                    
                        
                if($arquivo['size'] > 2097152){
                    die("arquivo muito grande!! Max 2MB.");
                }
        
                if($arquivo['error']){
                    //Update no banco de dados                    
                    $updatePraticante = "UPDATE TABPRA SET TABPRA_Nome='$nome', TABPRA_Apelido='$apelido', TABPRA_DataNascimento='$dataNascimento' WHERE TABUSU_Codigo = $codigo";        
                    $queryUpdatePraticante = $mysqli->query($updatePraticante) or die("Falha na execução do código sql" . $mysqli->error);                     
                }                   
        
                $pasta = "../../perfil/arquivos/";
                $nomeDoArquivo = $arquivo['name'];
                $novoNomeDoArquivo = uniqid();        
                $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));        
                $path = $pasta . $novoNomeDoArquivo. "." . $extensao;
                $deucerto = move_uploaded_file($arquivo["tmp_name"], $path);
                if($deucerto){                        
                    //Update no banco de dados
                    $updateUsr = "UPDATE TABUSU SET TABUSU_Icon = '$path' WHERE TABUSU_Codigo = $codigo";        
                    $queryUpdateUsr = $mysqli->query($updateUsr) or die("Falha na execução do código sql" . $mysqli->error);           
                    $updatePraticante = "UPDATE TABPRA SET TABPRA_Nome='$nome', TABPRA_Apelido='$apelido', TABPRA_DataNascimento='$dataNascimento' WHERE TABUSU_Codigo = $codigo";        
                    $queryUpdatePraticante = $mysqli->query($updatePraticante) or die("Falha na execução do código sql" . $mysqli->error);                         
                }
            }else{                    
                //Update no banco de dados                
                $updatePraticante = "UPDATE TABPRA SET TABPRA_Nome='$nome', TABPRA_Apelido='$apelido', TABPRA_DataNascimento='$dataNascimento' WHERE TABUSU_Codigo = $codigo";        
                $queryUpdatePraticante = $mysqli->query($updatePraticante) or die("Falha na execução do código sql" . $mysqli->error);                
            }     

            $_SESSION['APELIDO'] = $apelido;

            ?>
            <script>
                //Redireciona para o login
                alert("Perfil alterado com sucesso!")
                location.href = "../../perfil/perfil.php";
            </script>
            <?php 
                               
        } else{        
            header('Location: ./update_praticante.php?error=001');        
        }
    }else{                    

        //Cria variáveis                                 
        $nome           = strtoupper($_POST['txtNome']);                     
        $dataNascimento = $_POST['dataNascimento'];  
        
        if (isset($_FILES['imgPerfil']) && count($_FILES) > 0){        
            $arquivo = $_FILES['imgPerfil'];                    
                    
            if($arquivo['size'] > 2097152){
                die("arquivo muito grande!! Max 2MB.");
            }
    
            if($arquivo['error']){
                //Update no banco de dados                
                $updatePraticante = "UPDATE TABPRA SET TABPRA_Nome='$nome', TABPRA_Apelido='$apelido', TABPRA_DataNascimento='$dataNascimento' WHERE TABUSU_Codigo = $codigo";        
                $queryUpdatePraticante = $mysqli->query($updatePraticante) or die("Falha na execução do código sql" . $mysqli->error);                
            }                   
    
            $pasta = "../../perfil/arquivos/";
            $nomeDoArquivo = $arquivo['name'];
            $novoNomeDoArquivo = uniqid();        
            $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));        
            $path = $pasta . $novoNomeDoArquivo. "." . $extensao;
            $deucerto = move_uploaded_file($arquivo["tmp_name"], $path);
            if($deucerto){                        
                //Update no banco de dados
                $updateUsr = "UPDATE TABUSU SET TABUSU_Icon = '$path' WHERE TABUSU_Codigo = $codigo";        
                $queryUpdateUsr = $mysqli->query($updateUsr) or die("Falha na execução do código sql" . $mysqli->error);           
                $updatePraticante = "UPDATE TABPRA SET TABPRA_Nome='$nome', TABPRA_Apelido='$apelido', TABPRA_DataNascimento='$dataNascimento' WHERE TABUSU_Codigo = $codigo";        
                $queryUpdatePraticante = $mysqli->query($updatePraticante) or die("Falha na execução do código sql" . $mysqli->error);                    
            }
        }else{                    
            //Update no banco de dados                      
            $updatePraticante = "UPDATE TABPRA SET TABPRA_Nome='$nome', TABPRA_Apelido='$apelido', TABPRA_DataNascimento='$dataNascimento' WHERE TABUSU_Codigo = $codigo";        
            $queryUpdatePraticante = $mysqli->query($updatePraticante) or die("Falha na execução do código sql" . $mysqli->error);            
        }        

        $_SESSION['APELIDO'] = $apelido;

        ?>
        <script>
            //Redireciona para o login
            alert("Perfil alterado com sucesso!")
            location.href = "../../perfil/perfil.php";
        </script>
        <?php
    }
?>