<?php
    include('../../CONNECTIONS/connection.php');  
   
    if(isset($_POST['txtEmail']) || isset($_POST['txtSenha'])){
        
        $email = $mysqli->real_escape_string($_POST['txtEmail']);
        $senha = $mysqli->real_escape_string($_POST['txtSenha']);

        $login = "SELECT * FROM TABUSU WHERE TABUSU_Email = '$email'";
        $existeLogin = $mysqli->query($login) or die("Falha na execução do código sql" . $mysqli->error);
        
        if($existeLogin->num_rows == 1){
            
            $usuario = $existeLogin->fetch_assoc();
            if(password_verify($senha, $usuario['TABUSU_Senha'])){                
            
                if(!isset($_SESSION)){
                    session_start();
                }

                $_SESSION['CODIGO'] = $usuario['TABUSU_Codigo'];            
                $_SESSION['TIPO'] = $usuario['TIPUSU_Codigo'];
                
                header("Location: ../home/home.html");
            }else{
                header("Location: ../../index.php?error=002");
            }       
            
        }else{
            header("Location: ../../index.php?error=001");
        }              
    }    
?>