<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../index.php?error=4");
    }

    if(isset($_POST['txtEmail'])){
        //Define variável de Apelido
        $fantasia = $_POST['txtFantasia'];

        $fantasiaAtual = "SELECT * FROM TABLOJ WHERE TABUSU_Codigo = " . $_SESSION['CODIGO'];
        $queryFantasiaAtual = $mysqli->query($fantasiaAtual) or die("Falha na execução do código sql" . $mysqli->error);
        $fantasia_data = mysqli_fetch_assoc($queryFantasiaAtual);
        $fantasiaCadastrada = $fantasia_data['TABLOJ_Fantasia'];

        $codigo = $_SESSION['CODIGO'];
        
        if($fantasiaCadastrada != $fantasia){
            //Verifica se o Apelido ja Está Cadastrado
            $apelidoPraticante = "SELECT * FROM TABPRA WHERE TABPRA_Apelido = '$fantasia'";
            $apelidoPraticanteResultado = $mysqli->query($apelidoPraticante) or die("Falha na execução do código sql" . $mysqli->error);
            $qtdPraticanteResultado = $apelidoPraticanteResultado->num_rows;

            $apelidoInstrutor = "SELECT * FROM TABINS WHERE TABINS_Apelido = '$fantasia'";
            $apelidoInstrutorResultado = $mysqli->query($apelidoInstrutor) or die("Falha na execução do código sql" . $mysqli->error);
            $qtdInstrutorResultado = $apelidoInstrutorResultado->num_rows;

            $fantasiaLoja = "SELECT * FROM TABLOJ WHERE TABLOJ_Fantasia = '$fantasia'";
            $fantasiaLojaResultado = $mysqli->query($fantasiaLoja) or die("Falha na execução do código sql" . $mysqli->error);
            $qtdLojaResultado = $fantasiaLojaResultado->num_rows;

            $qtdApelidos = $qtdPraticanteResultado + $qtdInstrutorResultado + $qtdLojaResultado;

            if($qtdApelidos < 1){           
                
                //Verifica se o Email já está cadastrado            
                $emailAtual = "SELECT * FROM TABUSU WHERE TABUSU_Codigo = " . $_SESSION['CODIGO'];
                $queryEmailAtual = $mysqli->query($emailAtual) or die("Falha na execução do código sql" . $mysqli->error);
                $email_data = mysqli_fetch_assoc($queryEmailAtual);
                $emailCadastrado = $email_data['TABUSU_Email'];

                //Cria variáveis                         
                $email          = $_POST['txtEmail'];                               

                if($emailCadastrado != $email){
                    $emailResultado = "SELECT * FROM TABUSU WHERE TABUSU_Email = '$email'";
                    $queryEmailResultado = $mysqli->query($emailResultado) or die("Falha na execução do código sql" . $mysqli->error);
                    $qtdEmailResultado = $queryEmailResultado->num_rows;
                    if($qtdEmailResultado < 1){                       
                        if (isset($_FILES['imgPerfil']) && count($_FILES) > 0){        
                            $arquivo = $_FILES['imgPerfil'];                    
                                    
                            if($arquivo['size'] > 2097152){
                                die("arquivo muito grande!! Max 2MB.");
                            }
                    
                            if($arquivo['error']){
                                //Update no banco de dados
                                $updateUsr = "UPDATE TABUSU SET TABUSU_Email='$email' WHERE TABUSU_Codigo = $codigo";        
                                $queryUpdateUsr = $mysqli->query($updateUsr) or die("Falha na execução do código sql" . $mysqli->error);           
                                $updateLojista = "UPDATE TABLOJ SET TABLOJ_Fantasia='$fantasia' WHERE TABUSU_Codigo = $codigo";        
                                $queryUpdateLojista = $mysqli->query($updateLojista) or die("Falha na execução do código sql" . $mysqli->error);  
                            }                   
                    
                            $pasta = "../../perfil/arquivos/";
                            $nomeDoArquivo = $arquivo['name'];
                            $novoNomeDoArquivo = uniqid();        
                            $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));        
                            $path = $pasta . $novoNomeDoArquivo. "." . $extensao;
                            $deucerto = move_uploaded_file($arquivo["tmp_name"], $path);
                            if($deucerto){                        
                                //Update no banco de dados
                                $updateUsr = "UPDATE TABUSU SET TABUSU_Email='$email', TABUSU_Icon = '$path' WHERE TABUSU_Codigo = $codigo";        
                                $queryUpdateUsr = $mysqli->query($updateUsr) or die("Falha na execução do código sql" . $mysqli->error);           
                                $updateLojista = "UPDATE TABLOJ SET TABLOJ_Fantasia='$fantasia' WHERE TABUSU_Codigo = $codigo";        
                                $queryUpdateInstrutor = $mysqli->query($updateInstrutor) or die("Falha na execução do código sql" . $mysqli->error);      
                            }
                        }else{                    
                            //Update no banco de dados
                            $updateUsr = "UPDATE TABUSU SET TABUSU_Email='$email' WHERE TABUSU_Codigo = $codigo";        
                            $queryUpdateUsr = $mysqli->query($updateUsr) or die("Falha na execução do código sql" . $mysqli->error);           
                            $updateLojista = "UPDATE TABLOJ SET TABLOJ_Fantasia='$fantasia' WHERE TABUSU_Codigo = $codigo";        
                            $queryUpdateInstrutor = $mysqli->query($updateLojista) or die("Falha na execução do código sql" . $mysqli->error); 
                        }                              
                        ?>
                        <script>
                            //Redireciona para o login
                            alert("Perfil alterado com sucesso!")
                            location.href = "../../perfil/perfil.php";
                        </script>
                        <?php                
                    }else{
                        header('Location: ./update_lojista.php?error=002');  
                    }            
                }else{
                    if (isset($_FILES['imgPerfil']) && count($_FILES) > 0){        
                        $arquivo = $_FILES['imgPerfil'];                    
                                
                        if($arquivo['size'] > 2097152){
                            die("arquivo muito grande!! Max 2MB.");
                        }
                
                        if($arquivo['error']){
                            //Update no banco de dados
                            $updateUsr = "UPDATE TABUSU SET TABUSU_Email='$email' WHERE TABUSU_Codigo = $codigo";        
                            $queryUpdateUsr = $mysqli->query($updateUsr) or die("Falha na execução do código sql" . $mysqli->error);           
                            $updateLojista = "UPDATE TABLOJ SET TABLOJ_Fantasia='$fantasia' WHERE TABUSU_Codigo = $codigo";        
                            $queryUpdateLojista = $mysqli->query($updateLojista) or die("Falha na execução do código sql" . $mysqli->error);
                            ?>
                            <script>
                                //Redireciona para o login
                                alert("Perfil alterado com sucesso!")
                                location.href = "../../perfil/perfil.php";
                            </script>
                            <?php  
                        }                   
                
                        $pasta = "../../perfil/arquivos/";
                        $nomeDoArquivo = $arquivo['name'];
                        $novoNomeDoArquivo = uniqid();        
                        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));        
                        $path = $pasta . $novoNomeDoArquivo. "." . $extensao;
                        $deucerto = move_uploaded_file($arquivo["tmp_name"], $path);
                        if($deucerto){                        
                            //Update no banco de dados
                            $updateUsr = "UPDATE TABUSU SET TABUSU_Email='$email', TABUSU_Icon = '$path' WHERE TABUSU_Codigo = $codigo";        
                            $queryUpdateUsr = $mysqli->query($updateUsr) or die("Falha na execução do código sql" . $mysqli->error);           
                            $updateLojista = "UPDATE TABLOJ SET TABLOJ_Fantasia='$fantasia' WHERE TABUSU_Codigo = $codigo";        
                            $queryUpdateLojista = $mysqli->query($updateLojista) or die("Falha na execução do código sql" . $mysqli->error);    
                            ?>
                            <script>
                                //Redireciona para o login
                                alert("Perfil alterado com sucesso!")
                                location.href = "../../perfil/perfil.php";
                            </script>
                            <?php  
                        }
                    }else{                    
                        //Update no banco de dados
                        $updateUsr = "UPDATE TABUSU SET TABUSU_Email='$email' WHERE TABUSU_Codigo = $codigo";        
                        $queryUpdateUsr = $mysqli->query($updateUsr) or die("Falha na execução do código sql" . $mysqli->error);           
                        $updateLojista = "UPDATE TABLOJ SET TABLOJ_Fantasia='$fantasia' WHERE TABUSU_Codigo = $codigo";        
                        $queryUpdateLojista = $mysqli->query($updateLojista) or die("Falha na execução do código sql" . $mysqli->error); 
                        ?>
                        <script>
                            //Redireciona para o login
                            alert("Perfil alterado com sucesso!")
                            location.href = "../../perfil/perfil.php";
                        </script>
                        <?php
                    }     
                }                   
            } else{        
                header('Location: ./update_lojista.php?error=001');        
            }
        }else{            
            //Verifica se o Email já está cadastrado            
            $emailAtual = "SELECT * FROM TABUSU WHERE TABUSU_Codigo = " . $_SESSION['CODIGO'];
            $queryEmailAtual = $mysqli->query($emailAtual) or die("Falha na execução do código sql" . $mysqli->error);
            $email_data = mysqli_fetch_assoc($queryEmailAtual);
            $emailCadastrado = $email_data['TABUSU_Email'];

            //Cria variáveis                         
            $email          = $_POST['txtEmail'];                          
            
            if($emailCadastrado != $email){      
                if (isset($_FILES['imgPerfil']) && count($_FILES) > 0){        
                    $arquivo = $_FILES['imgPerfil'];                    
                            
                    if($arquivo['size'] > 2097152){
                        die("arquivo muito grande!! Max 2MB.");
                    }
            
                    if($arquivo['error']){
                        //Update no banco de dados
                        $updateUsr = "UPDATE TABUSU SET TABUSU_Email='$email' WHERE TABUSU_Codigo = $codigo";        
                        $queryUpdateUsr = $mysqli->query($updateUsr) or die("Falha na execução do código sql" . $mysqli->error);           
                        $updateLojista = "UPDATE TABLOJ SET TABLOJ_Fantasia='$fantasia' WHERE TABUSU_Codigo = $codigo";        
                        $queryUpdateLojista = $mysqli->query($updateLojista) or die("Falha na execução do código sql" . $mysqli->error);  
                        ?>
                        <script>
                            //Redireciona para o login
                            alert("Perfil alterado com sucesso!")
                            location.href = "../../perfil/perfil.php";
                        </script>
                        <?php
                    }                   
            
                    $pasta = "../../perfil/arquivos/";
                    $nomeDoArquivo = $arquivo['name'];
                    $novoNomeDoArquivo = uniqid();        
                    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));        
                    $path = $pasta . $novoNomeDoArquivo. "." . $extensao;
                    $deucerto = move_uploaded_file($arquivo["tmp_name"], $path);
                    if($deucerto){                        
                        //Update no banco de dados
                        $updateUsr = "UPDATE TABUSU SET TABUSU_Email='$email', TABUSU_Icon = '$path' WHERE TABUSU_Codigo = $codigo";        
                        $queryUpdateUsr = $mysqli->query($updateUsr) or die("Falha na execução do código sql" . $mysqli->error);           
                        $updateLojista = "UPDATE TABLOJ SET TABLOJ_Fantasia='$fantasia' WHERE TABUSU_Codigo = $codigo";        
                        $queryUpdateLojista = $mysqli->query($updateLojista) or die("Falha na execução do código sql" . $mysqli->error);  
                        ?>
                        <script>
                            //Redireciona para o login
                            alert("Perfil alterado com sucesso!")
                            location.href = "../../perfil/perfil.php";
                        </script>
                        <?php    
                    }
                }else{                    
                    //Update no banco de dados
                    $updateUsr = "UPDATE TABUSU SET TABUSU_Email='$email' WHERE TABUSU_Codigo = $codigo";        
                    $queryUpdateUsr = $mysqli->query($updateUsr) or die("Falha na execução do código sql" . $mysqli->error);           
                    $updateLojista = "UPDATE TABLOJ SET TABLOJ_Fantasia='$fantasia' WHERE TABUSU_Codigo = $codigo";        
                    $queryUpdateLojista = $mysqli->query($updateLojista) or die("Falha na execução do código sql" . $mysqli->error); 
                    ?>
                    <script>
                        //Redireciona para o login
                        alert("Perfil alterado com sucesso!")
                        location.href = "../../perfil/perfil.php";
                    </script>
                    <?php
                }   
            }else{
                if (isset($_FILES['imgPerfil']) && count($_FILES) > 0){        
                    $arquivo = $_FILES['imgPerfil'];                    
                            
                    if($arquivo['size'] > 2097152){
                        die("arquivo muito grande!! Max 2MB.");
                    }
            
                    if($arquivo['error']){
                        //Update no banco de dados
                        $updateUsr = "UPDATE TABUSU SET TABUSU_Email='$email' WHERE TABUSU_Codigo = $codigo";        
                        $queryUpdateUsr = $mysqli->query($updateUsr) or die("Falha na execução do código sql" . $mysqli->error);           
                        $updateLojista = "UPDATE TABLOJ SET TABLOJ_Fantasia='$fantasia' WHERE TABUSU_Codigo = $codigo";        
                        $queryUpdateLojista = $mysqli->query($updateLojista) or die("Falha na execução do código sql" . $mysqli->error);  
                        ?>
                        <script>
                            //Redireciona para o login
                            alert("Perfil alterado com sucesso!")
                            location.href = "../../perfil/perfil.php";
                        </script>
                        <?php
                    }                   
            
                    $pasta = "../../perfil/arquivos/";
                    $nomeDoArquivo = $arquivo['name'];
                    $novoNomeDoArquivo = uniqid();        
                    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));        
                    $path = $pasta . $novoNomeDoArquivo. "." . $extensao;
                    $deucerto = move_uploaded_file($arquivo["tmp_name"], $path);
                    if($deucerto){                        
                        //Update no banco de dados
                        $updateUsr = "UPDATE TABUSU SET TABUSU_Email='$email', TABUSU_Icon = '$path' WHERE TABUSU_Codigo = $codigo";        
                        $queryUpdateUsr = $mysqli->query($updateUsr) or die("Falha na execução do código sql" . $mysqli->error);           
                        $updateLojista = "UPDATE TABLOJ SET TABLOJ_Fantasia = '$fantasia' WHERE TABUSU_Codigo = $codigo";        
                        $queryUpdateLojista = $mysqli->query($updateLojista) or die("Falha na execução do código sql" . $mysqli->error); 
                        ?>
                        <script>
                            //Redireciona para o login
                            alert("Perfil alterado com sucesso!")
                            location.href = "../../perfil/perfil.php";
                        </script>
                        <?php     
                    }
                }else{                    
                    //Update no banco de dados
                    $updateUsr = "UPDATE TABUSU SET TABUSU_Email='$email' WHERE TABUSU_Codigo = $codigo";        
                    $queryUpdateUsr = $mysqli->query($updateUsr) or die("Falha na execução do código sql" . $mysqli->error);           
                    $updateLojista = "UPDATE TABLOJ SET TABLOJ_Fantasia='$fantasia' WHERE TABUSU_Codigo = $codigo";        
                    $queryUpdateLojista = $mysqli->query($updateLojista) or die("Falha na execução do código sql" . $mysqli->error); 
                    ?>
                    <script>
                        //Redireciona para o login
                        alert("Perfil alterado com sucesso!")
                        location.href = "../../perfil/perfil.php";
                    </script>
                    <?php
                }            
            }
        }
    }else{
        header ("Location: ./update_lojista.php");
    }  
?>