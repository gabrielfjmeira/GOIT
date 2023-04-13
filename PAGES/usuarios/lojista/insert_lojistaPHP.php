<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');
          
    //Cria variáveis
    $email       = $_POST['txtEmail'];
    $senha       = $_POST['txtSenha'];
    $razaoSocial = $_POST['txtRazaoSocial'];            
    $fantasia    = $_POST['txtFantasia'];
    $cnpj        = $_POST['CNPJ'];

    //Criptografa a senha para popular no banco de dados
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    //insere no banco de dados
    $insertLojista = "INSERT INTO TABUSU (TABUSU_Email, TABUSU_Senha, TIPUSU_Codigo) VALUES ('$email', '$senhaCriptografada', 4)";
    $queryInsertLojista = $mysqli->query($insertLojista) or die("Falha na execução do código sql" . $mysqli->error);            

    $selectUsuario = "SELECT * FROM TABUSU WHERE TABUSU_Email = '$email'";
    $querySelectUsuario = $mysqli->query($selectUsuario) or die("Falha na execução do código sql" . $mysqli->error);
    $usuario = $querySelectUsuario->fetch_assoc();
    $codigoUsuario = $usuario['TABUSU_Codigo'];

    $insertLojista = "INSERT INTO TABLOJ (TABUSU_Codigo, TABLOJ_RazaoSocial, TABLOJ_Fantasia, TABLOJ_CNPJ, TABLOJ_Verificado) VALUES ($codigoUsuario, '$razaoSocial', '$fantasia', $cnpj, 0)";
    $queryInsertLojista = $mysqli->query($insertLojista) or die("Falha na execução do código sql" . $mysqli->error);
    
    //Redireciona para o login
    header("Location: ../../../index.php?cadastrado=001");    

?>