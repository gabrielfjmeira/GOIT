<?php
    include('../../CONNECTIONS/connection.php');  
       
    $_SESSION ['LOGGED'] = $_SESSION ['LOGGED'] || False;

    //Verifica o Login
    if(isset($_POST['txtEmail']) || isset($_POST['txtSenha'])){
        
        $email = $mysqli->real_escape_string($_POST['txtEmail']);
        $senha = $mysqli->real_escape_string($_POST['txtSenha']);

        $login = "SELECT * FROM TABUSU WHERE TABUSU_Email = '$email'";
        $existeLogin = $mysqli->query($login) or die("Falha na execução do código sql" . $mysqli->error);
        
        //Verifica se o registro existe no banco
        if($existeLogin->num_rows == 1){
            
            $usuario = $existeLogin->fetch_assoc();
            if(password_verify($senha, $usuario['TABUSU_Senha'])){                
                
                $codigoUsuario = $usuario['TABUSU_Codigo'];                
                $tipoUsuario   = $usuario['TIPUSU_Codigo'];                

                //Verifica se o Instrutor tem Acesso na Plataforma
                if ($tipoUsuario == 3){

                    $instrutorVerificado = "SELECT * FROM TABINS WHERE TABUSU_Codigo = $codigoUsuario";
                    $queryInstutorVerificado = $mysqli->query($instrutorVerificado) or die("Falha na execução do código sql" . $mysqli->error);

                    $instrutor = $queryInstutorVerificado->fetch_assoc();

                    $verificado = $instrutor['TABINS_Verificado'];

                    if($verificado == 1){                      
                                              
                        $_SESSION['CODIGO'] =  $codigoUsuario;            
                        $_SESSION['TIPOUSUARIO']  = $tipoUsuario;
                        $_SESSION ['LOGGED'] = True;
                        
                        $instrutor = "SELECT * FROM TABINS WHERE TABUSU_Codigo = " . $_SESSION['CODIGO'];
                        $queryInstrutor = $mysqli->query($instrutor) or die(mysql_error());
                        $instrutor_data = mysqli_fetch_array($queryInstrutor);
                        $_SESSION['Apelido'] = $instrutor_data['TABINS_Apelido'];                               
                        
                        header("Location: ../../PAGES/home/home.php");
                    } else{
                        header("Location: ../../index.php?error=003");                        
                    }
                    
                } else if($tipoUsuario == 4){ //Verifica se o Lojista tem acesso na plataforma

                    $lojistaVerificado = "SELECT * FROM TABLOJ WHERE TABUSU_Codigo = $codigoUsuario";
                    $queryLojistaVerificado = $mysqli->query($lojistaVerificado) or die("Falha na execução do código sql" . $mysqli->error);

                    $lojista = $queryLojistaVerificado->fetch_assoc();

                    $verificado = $lojista['TABLOJ_Verificado'];

                    if($verificado == 1){                       
                        
                        $_SESSION['CODIGO'] = $codigoUsuario;            
                        $_SESSION['TIPOUSUARIO']  = $tipoUsuario;
                        $_SESSION ['LOGGED'] = True;
                        
                        $lojista = "SELECT * FROM TABLOJ WHERE TABUSU_Codigo = " . $_SESSION['CODIGO'];
                        $queryLojista = $mysqli->query($lojista) or die(mysql_error());
                        $lojista_data = mysqli_fetch_array($queryLojista);
                        $_SESSION['Apelido'] = $lojista_data['TABLOJ_Fantasia'];                                               
                        
                        header("Location: ../../PAGES/home/home.php");
                    } else{
                        header("Location: ../../index.php?error=003");                        
                    }

                } else{ //Redireciona demais usuários
                    
                    $_SESSION['CODIGO'] = $codigoUsuario;            
                    $_SESSION['TIPOUSUARIO']  = $tipoUsuario;
                    $_SESSION ['LOGGED'] = True;
                    if($_SESSION['TIPOUSUARIO'] == 1){
                        //Administrador 
                        $_SESSION['Apelido'] = "Admin";                            
                    }else{
                        //Praticante                    
                        $praticante = "SELECT * FROM TABPRA WHERE TABUSU_Codigo = " . $_SESSION['CODIGO'];
                        $queryPraticante = $mysqli->query($praticante) or die(mysql_error());                                       
                        $praticante_data = mysqli_fetch_array($queryPraticante);
                        $_SESSION['Apelido'] = $praticante_data['TABPRA_Apelido'];                                                            
                    }
                    header("Location: ../../PAGES/home/home.php");
                }
                
            }else{
                header("Location: ../../index.php?error=002");                
            }       
            
        }else{
            header("Location: ../../index.php?error=001");            
        }               
    
    }   

    
?>