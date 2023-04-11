<?php

    include('../../../CONNECTIONS/connection.php');

    
    $apelido = $_POST['txtApelido'];
    
    $apelidoPraticante = "SELECT * FROM TABPRA WHERE TABPRA_Apelido = '$apelido'";
    $apelidoPraticanteResultado = $mysqli->query($apelidoPraticante) or die("Falha na execução do código sql" . $mysqli->error);
    $qtdPraticanteResultado = $apelidoPraticanteResultado->num_rows;

    $apelidoInstrutor = "SELECT * FROM TABINS WHERE TABINS_Apelido = '$apelido'";
    $apelidoInstrutorResultado = $mysqli->query($apelidoInstrutor) or die("Falha na execução do código sql" . $mysqli->error);
    $qtdInstrutorResultado = $apelidoInstrutorResultado->num_rows;

    $qtdApelidos = $qtdPraticanteResultado + $qtdInstrutorResultado;

    if($qtdApelidos > 0){
        header('Location: ./cadastro_praticante.php?error=001');
    } else{
        
        //Cria variáveis
        $email          = $_POST['txtEmail'];
        $senha          = $_POST['txtSenha'];
        $nome           = $_POST['txtNome'];            
        $dataNascimento = $_POST['dataNascimento'];
        $sexo           = $_POST['sexo'];

        //Criptografa a senha para popular no banco de dados
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        //insere no banco de dados
        $insertUsuario = "INSERT INTO TABUSU (TABUSU_Email, TABUSU_Senha, TIPUSU_Codigo) VALUES ('$email', '$senhaCriptografada', 2)";
        $queryInsertUsuario = $mysqli->query($insertUsuario) or die("Falha na execução do código sql" . $mysqli->error);            

        $selectUsuario = "SELECT * FROM TABUSU WHERE TABUSU_Email = '$email'";
        $querySelectUsuario = $mysqli->query($selectUsuario) or die("Falha na execução do código sql" . $mysqli->error);
        $usuario = $querySelectUsuario->fetch_assoc();
        $codigoUsuario = $usuario['TABUSU_Codigo'];

        $insertPraticante = "INSERT INTO TABPRA (TABUSU_Codigo, TABPRA_Nome, TABPRA_Apelido, TABPRA_DataNascimento, TABPRA_Sexo) VALUES ($codigoUsuario, '$nome', '$apelido', '$dataNascimento', $sexo)";
        $queryInsertPraticante = $mysqli->query($insertPraticante) or die("Falha na execução do código sql" . $mysqli->error);
       
        //Redireciona para o login
        header("Location: ../../../index.php?cadastrado=1");
    }

?>