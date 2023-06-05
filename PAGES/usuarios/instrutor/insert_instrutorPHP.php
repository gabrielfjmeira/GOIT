<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Cria variáveis                
    $nome           = $_POST['txtNome'];            
    $apelido        = $_POST['txtApelido'];
    $dataNascimento = $_POST['dataNascimento'];    
    $sexo           = $_POST['sexo'];    
    $cadastur       = $_POST['txtCadastur'];
    $email          = $_POST['txtEmail'];
    $senha          = $_POST['txtSenha'];

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

    //Verifica se o Cadastur já está cadastrado        
    $cadasturResultado = "SELECT * FROM TABINS WHERE TABINS_Cadastur = '$cadastur'";
    $queryCadasturResultado = $mysqli->query($cadasturResultado) or die("Falha na execução do código sql" . $mysqli->error);
    $qtdCadasturResultado = $queryCadasturResultado->num_rows;

    //Verifica se o Email já está cadastrado                
    $emailResultado = "SELECT * FROM TABUSU WHERE TABUSU_Email = '$email'";
    $queryEmailResultado = $mysqli->query($emailResultado) or die("Falha na execução do código sql" . $mysqli->error);
    $qtdEmailResultado = $queryEmailResultado->num_rows;

    //Verifica Categoria
    if(isset($_POST['catInstrutor'])){        
        $catInstrutor   = $_POST['catInstrutor'];               

        if($qtdApelidos >= 1 && $qtdCadasturResultado >= 1 && $qtdEmailResultado >= 1){//Apelido - Cadastur - Email já cadastrados
            //Redireciona para o cadastramento de instrutor com Erro
            header('Location: ./cadastro_instrutor.php?error=007&nome='.$nome.'&apelido='.$apelido.'&dataNascimento='.$dataNascimento.'&sexo='.$sexo.'&cadastur='.$cadastur.'&email='.$email.'&categoria='.$catInstrutor);
        }else if($qtdApelidos >= 1 && $qtdCadasturResultado >= 1 && $qtdEmailResultado < 1){//Apelido - Cadastur já cadastrados
            //Redireciona para o cadastramento de instrutor com Erro
            header('Location: ./cadastro_instrutor.php?error=006&nome='.$nome.'&apelido='.$apelido.'&dataNascimento='.$dataNascimento.'&sexo='.$sexo.'&cadastur='.$cadastur.'&email='.$email.'&categoria='.$catInstrutor);
        }else if($qtdApelidos >= 1 && $qtdCadasturResultado < 1 && $qtdEmailResultado >= 1){//Apelido - Email já cadastrados
            //Redireciona para o cadastramento de instrutor com Erro
            header('Location: ./cadastro_instrutor.php?error=005&nome='.$nome.'&apelido='.$apelido.'&dataNascimento='.$dataNascimento.'&sexo='.$sexo.'&cadastur='.$cadastur.'&email='.$email.'&categoria='.$catInstrutor);
        }else if($qtdApelidos < 1 && $qtdCadasturResultado >= 1 && $qtdEmailResultado >= 1){//Cadastur - Email já cadastrados
            //Redireciona para o cadastramento de instrutor com Erro
            header('Location: ./cadastro_instrutor.php?error=004&nome='.$nome.'&apelido='.$apelido.'&dataNascimento='.$dataNascimento.'&sexo='.$sexo.'&cadastur='.$cadastur.'&email='.$email.'&categoria='.$catInstrutor);
        }else if($qtdApelidos < 1 && $qtdCadasturResultado >= 1 && $qtdEmailResultado < 1){//Cadastur já cadastrado
            //Redireciona para o cadastramento de instrutor com Erro
            header('Location: ./cadastro_instrutor.php?error=003&nome='.$nome.'&apelido='.$apelido.'&dataNascimento='.$dataNascimento.'&sexo='.$sexo.'&cadastur='.$cadastur.'&email='.$email.'&categoria='.$catInstrutor);
        }else if($qtdApelidos < 1 && $qtdCadasturResultado < 1 && $qtdEmailResultado >= 1){//Email já cadastrado
            //Redireciona para o cadastramento de instrutor com Erro
            header('Location: ./cadastro_instrutor.php?error=002&nome='.$nome.'&apelido='.$apelido.'&dataNascimento='.$dataNascimento.'&sexo='.$sexo.'&cadastur='.$cadastur.'&email='.$email.'&categoria='.$catInstrutor);
        }else if($qtdApelidos >= 1 && $qtdCadasturResultado < 1 && $qtdEmailResultado < 1){//Apelido já cadastrado
            //Redireciona para o cadastramento de instrutor com Erro
            header('Location: ./cadastro_instrutor.php?error=001&nome='.$nome.'&apelido='.$apelido.'&dataNascimento='.$dataNascimento.'&sexo='.$sexo.'&cadastur='.$cadastur.'&email='.$email.'&categoria='.$catInstrutor);
        }else{
            //Criptografa a senha para popular no banco de dados
            $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

            //insere no banco de dados
            $insertUsuario = "INSERT INTO TABUSU (TABUSU_Email, TABUSU_Senha, TIPUSU_Codigo, TABUSU_Created) VALUES ('$email', '$senhaCriptografada', 3, now())";
            $queryInsertUsuario = $mysqli->query($insertUsuario) or die("Falha na execução do código sql" . $mysqli->error);            

            $selectUsuario = "SELECT * FROM TABUSU WHERE TABUSU_Email = '$email'";
            $querySelectUsuario = $mysqli->query($selectUsuario) or die("Falha na execução do código sql" . $mysqli->error);
            $usuario = $querySelectUsuario->fetch_assoc();
            $codigoUsuario = $usuario['TABUSU_Codigo'];

            $insertInstrutor = "INSERT INTO TABINS (TABUSU_Codigo, TABINS_Nome, TABINS_Apelido, TABINS_DataNascimento, TABINS_Sexo, TABINS_Cadastur, CATATV_Codigo, TABINS_Verificado, TABINS_Negado) VALUES ($codigoUsuario, '" . strtoupper($nome) . "', '$apelido', '$dataNascimento', $sexo, '$cadastur', $catInstrutor, 0, 0)";
            $queryInsertInstrutor = $mysqli->query($insertInstrutor) or die("Falha na execução do código sql" . $mysqli->error);
            ?>
            <script>
                //Redireciona para o login
                alert("Cadastro enviado para análise!")
                location.href = "../../../index.php";
            </script>
            <?php
        }
    }else{
        //Redireciona para o cadastramento de instrutor com Erro
        header('Location: ./cadastro_instrutor.php?error=8&nome='.$nome.'&apelido='.$apelido.'&dataNascimento='.$dataNascimento.'&sexo='.$sexo.'&cadastur='.$cadastur.'&email='.$email);
    }
?>