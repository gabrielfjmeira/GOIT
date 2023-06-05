<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');
        
    //Cria variáveis
    $razaoSocial = $_POST['txtRazaoSocial'];
    $fantasia    = $_POST['txtFantasia'];
    $email       = $_POST['txtEmail'];
    $cnpj        = $_POST['txtCNPJ'];                   
    $senha       = $_POST['txtSenha'];      

    //Verifica se a Fantasia ja Está Cadastrada
    $apelidoPraticante = "SELECT * FROM TABPRA WHERE TABPRA_Apelido = '$fantasia'";
    $apelidoPraticanteResultado = $mysqli->query($apelidoPraticante) or die("Falha na execução do código sql" . $mysqli->error);
    $qtdPraticanteResultado = $apelidoPraticanteResultado->num_rows;

    $apelidoInstrutor = "SELECT * FROM TABINS WHERE TABINS_Apelido = '$fantasia'";
    $apelidoInstrutorResultado = $mysqli->query($apelidoInstrutor) or die("Falha na execução do código sql" . $mysqli->error);
    $qtdInstrutorResultado = $apelidoInstrutorResultado->num_rows;

    $fantasiaResultado = "SELECT * FROM TABLOJ WHERE TABLOJ_Fantasia = '$fantasia'";
    $queryFantasiaResultado = $mysqli->query($fantasiaResultado) or die("Falha na execução do código sql" . $mysqli->error);
    $qtdFantasiaResultado = $queryFantasiaResultado->num_rows;

    $qtdApelidos = $qtdPraticanteResultado + $qtdInstrutorResultado + $qtdFantasiaResultado;

    //Verifica se já tem o CNPJ Cadastrado 
    $cnpjResultado = "SELECT * FROM TABLOJ WHERE TABLOJ_CNPJ = '$cnpj'";
    $querycnpjResultado = $mysqli->query($cnpjResultado) or die("Falha na execução do código sql" . $mysqli->error);
    $qtdCnpjResultado = $querycnpjResultado->num_rows;

    //Verifica se o email já está cadastrado            
    $emailResultado = "SELECT * FROM TABUSU WHERE TABUSU_Email = '$email'";
    $queryEmailResultado = $mysqli->query($emailResultado) or die("Falha na execução do código sql" . $mysqli->error);
    $qtdEmailResultado = $queryEmailResultado->num_rows;
    
    if($qtdApelidos >= 1 && $qtdCnpjResultado >= 1 && $qtdEmailResultado >= 1){//Fantasia - CNPJ - Email já cadastrados
        //Redireciona para o cadastramento de lojista com Erro
        header('Location: ./cadastro_lojista.php?error=007&razaoSocial='.$razaoSocial.'&fantasia='.$fantasia.'&email='.$email.'&cnpj='.$cnpj);
    }else if($qtdApelidos >= 1 && $qtdCnpjResultado >= 1 && $qtdEmailResultado < 1){ //Fantasia - CNPJ já cadastrados
        //Redireciona para o cadastramento de lojista com Erro
        header('Location: ./cadastro_lojista.php?error=006&razaoSocial='.$razaoSocial.'&fantasia='.$fantasia.'&email='.$email.'&cnpj='.$cnpj);
    }else if($qtdApelidos >= 1 && $qtdCnpjResultado < 1 && $qtdEmailResultado >= 1){ //Fantasia - Email já cadastrados
        //Redireciona para o cadastramento de lojista com Erro
        header('Location: ./cadastro_lojista.php?error=005&razaoSocial='.$razaoSocial.'&fantasia='.$fantasia.'&email='.$email.'&cnpj='.$cnpj);
    }else if($qtdApelidos < 1 && $qtdCnpjResultado >= 1 && $qtdEmailResultado >= 1){//CNPJ - Email já cadastrados
        //Redireciona para o cadastramento de lojista com Erro
        header('Location: ./cadastro_lojista.php?error=004&razaoSocial='.$razaoSocial.'&fantasia='.$fantasia.'&email='.$email.'&cnpj='.$cnpj);
    }else if($qtdApelidos < 1 && $qtdCnpjResultado < 1 && $qtdEmailResultado >= 1){ //Email já cadastrado
        //Redireciona para o cadastramento de lojista com Erro
        header('Location: ./cadastro_lojista.php?error=003&razaoSocial='.$razaoSocial.'&fantasia='.$fantasia.'&email='.$email.'&cnpj='.$cnpj);
    }else if($qtdApelidos < 1 && $qtdCnpjResultado >= 1 && $qtdEmailResultado < 1){ //CNPJ já cadastrado
        //Redireciona para o cadastramento de lojista com Erro
        header('Location: ./cadastro_lojista.php?error=002&razaoSocial='.$razaoSocial.'&fantasia='.$fantasia.'&email='.$email.'&cnpj='.$cnpj);
    }else if($qtdApelidos >= 1 && $qtdCnpjResultado < 1 && $qtdEmailResultado < 1){ //Fantasia já cadastrada
        //Redireciona para o cadastramento de lojista com Erro
        header('Location: ./cadastro_lojista.php?error=001&razaoSocial='.$razaoSocial.'&fantasia='.$fantasia.'&email='.$email.'&cnpj='.$cnpj);
    }else{
        //Criptografa a senha para popular no banco de dados
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        //insere no banco de dados
        $insertUser = "INSERT INTO TABUSU (TABUSU_Email, TABUSU_Senha, TIPUSU_Codigo, TABUSU_Created) VALUES ('$email', '$senhaCriptografada', 4, now())";
        $queryInsertUser = $mysqli->query($insertUser) or die("Falha na execução do código sql" . $mysqli->error);            

        $selectUsuario = "SELECT * FROM TABUSU WHERE TABUSU_Email = '$email'";
        $querySelectUsuario = $mysqli->query($selectUsuario) or die("Falha na execução do código sql" . $mysqli->error);
        $usuario = $querySelectUsuario->fetch_assoc();
        $codigoUsuario = $usuario['TABUSU_Codigo'];
       
        $insertLojista = "INSERT INTO TABLOJ (TABUSU_Codigo, TABLOJ_RazaoSocial, TABLOJ_Fantasia, TABLOJ_CNPJ, TABLOJ_Verificado, TABLOJ_Negado) VALUES ($codigoUsuario, '" . strtoupper($razaoSocial) . "', '$fantasia', '$cnpj', 0, 0)";                
        $queryInsertLojista = $mysqli->query($insertLojista) or die("Falha na execução do código sql" . $mysqli->error);                
        ?>
        <script>
            //Redireciona para o login
            alert("Cadastro enviado para análise!")
            location.href = "../../../index.php";
        </script>
        <?php
    }    
?>