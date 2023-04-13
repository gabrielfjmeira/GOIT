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
                        $_SESSION['TIPO']   =  $tipoUsuario;
                        $_SESSION ['LOGGED'] = True;
                        
                        header("Location: ../home/home.php");
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
                        $_SESSION['TIPO']   = $tipoUsuario;
                        $_SESSION ['LOGGED'] = True;
                        
                        header("Location: ../home/home.php");
                    } else{
                        header("Location: ../../index.php?error=003");                        
                    }

                } else{ //Redireciona demais usuários
                    
                    $_SESSION['CODIGO'] = $codigoUsuario;            
                    $_SESSION['TIPO']   = $tipoUsuario;
                    $_SESSION ['LOGGED'] = True;
                    
                    header("Location: ../home/home.php");
                }
                
            }else{
                header("Location: ../../index.php?error=002");                
            }       
            
        }else{
            header("Location: ../../index.php?error=001");            
        }              
    }    
?>