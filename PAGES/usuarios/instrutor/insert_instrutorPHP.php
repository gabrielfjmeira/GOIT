<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Define variável de Apelido
    $apelido = $_POST['txtApelido'];
    
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
        
        //Verifica se o Cadastur já está cadastrado
        $cadastur = $_POST['txtCadastur'];
        $cadasturResultado = "SELECT * FROM TABINS WHERE TABINS_Cadastur = '$cadastur'";
        $queryCadasturResultado = $mysqli->query($cadasturResultado) or die("Falha na execução do código sql" . $mysqli->error);
        $qtdCadasturResultado = $queryCadasturResultado->num_rows;

        if($qtdCadasturResultado < 1){

            //Verifica se o Email já está cadastrado
            $email = $_POST['txtEmail'];
            $emailResultado = "SELECT * FROM TABUSU WHERE TABUSU_Email = '$email'";
            $queryEmailResultado = $mysqli->query($emailResultado) or die("Falha na execução do código sql" . $mysqli->error);
            $qtdEmailResultado = $queryEmailResultado->num_rows;

            if($qtdEmailResultado < 1){

                //Cria variáveis            
                $senha          = $_POST['txtSenha'];
                $nome           = $_POST['txtNome'];            
                $dataNascimento = $_POST['dataNascimento'];
                $sexo           = $_POST['sexo'];
                        
                //Criptografa a senha para popular no banco de dados
                $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

                //insere no banco de dados
                $insertUsuario = "INSERT INTO TABUSU (TABUSU_Email, TABUSU_Senha, TIPUSU_Codigo, TABUSU_Created) VALUES ('$email', '$senhaCriptografada', 3, now())";
                $queryInsertUsuario = $mysqli->query($insertUsuario) or die("Falha na execução do código sql" . $mysqli->error);            

                $selectUsuario = "SELECT * FROM TABUSU WHERE TABUSU_Email = '$email'";
                $querySelectUsuario = $mysqli->query($selectUsuario) or die("Falha na execução do código sql" . $mysqli->error);
                $usuario = $querySelectUsuario->fetch_assoc();
                $codigoUsuario = $usuario['TABUSU_Codigo'];

                $insertInstrutor = "INSERT INTO TABINS (TABUSU_Codigo, TABINS_Nome, TABINS_Apelido, TABINS_DataNascimento, TABINS_Sexo, TABINS_Cadastur, TABINS_Verificado) VALUES ($codigoUsuario, '$nome', '$apelido', '$dataNascimento', $sexo, '$cadastur', 0)";
                $queryInsertInstrutor = $mysqli->query($insertInstrutor) or die("Falha na execução do código sql" . $mysqli->error);
            
                //Redireciona para o login
                header("Location: ../../../index.php?cadastrado=1");
            }else{
                header('Location: ./cadastro_instrutor.php?error=003');  
            }            
        }else{
            header('Location: ./cadastro_instrutor.php?error=002');  
        }        
    } else{        
        header('Location: ./cadastro_instrutor.php?error=001');        
    }

?>