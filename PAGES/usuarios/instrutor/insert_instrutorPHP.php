<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Define variável de Apelido
    $apelido = $_POST['txtApelido'];
    
    //Verifica se o Apelido ja Está Cadastrado
    $apelidoPraticante = "SELECT * FROM TABINS WHERE TABINS_Apelido = '$apelido'";
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
        $cadastur       = $_POST['txtCadastur'];

        //Criptografa a senha para popular no banco de dados
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        //insere no banco de dados
        $insertUsuario = "INSERT INTO TABUSU (TABUSU_Email, TABUSU_Senha, TIPUSU_Codigo) VALUES ('$email', '$senhaCriptografada', 3)";
        $queryInsertUsuario = $mysqli->query($insertUsuario) or die("Falha na execução do código sql" . $mysqli->error);            

        $selectUsuario = "SELECT * FROM TABUSU WHERE TABUSU_Email = '$email'";
        $querySelectUsuario = $mysqli->query($selectUsuario) or die("Falha na execução do código sql" . $mysqli->error);
        $usuario = $querySelectUsuario->fetch_assoc();
        $codigoUsuario = $usuario['TABUSU_Codigo'];

        $insertInstrutor = "INSERT INTO TABINS (TABUSU_Codigo, TABINS_Nome, TABINS_Apelido, TABINS_DataNascimento, TABINS_Sexo, TABINS_Cadastur, TABINS_Verificado) VALUES ($codigoUsuario, '$nome', '$apelido', '$dataNascimento', $sexo, $cadastur, 0)";
        $queryInsertInstrutor = $mysqli->query($insertInstrutor) or die("Falha na execução do código sql" . $mysqli->error);
       
        //Redireciona para o login
        header("Location: ../../../index.php?cadastrado=1");
    }

?>