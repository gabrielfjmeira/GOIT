<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');            
    
    //Cria variáveis        
    $senha          = $_POST['txtSenha'];
    $nome           = strtoupper($_POST['txtNome']);            
    $dataNascimento = $_POST['dataNascimento'];
    $sexo           = $_POST['sexo'];
    $apelido        = $_POST['txtApelido']
    $email          = $_POST['txtEmail']

    //Criptografa a senha para popular no banco de dados
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    //insere no banco de dados
    $insertUsuario = "INSERT INTO TABUSU (TABUSU_Email, TABUSU_Senha, TIPUSU_Codigo, TABUSU_Created) VALUES ('$email', '$senhaCriptografada', 2, now())";
    $queryInsertUsuario = $mysqli->query($insertUsuario) or die("Falha na execução do código sql" . $mysqli->error);            

    $selectUsuario = "SELECT * FROM TABUSU WHERE TABUSU_Email = '$email'";
    $querySelectUsuario = $mysqli->query($selectUsuario) or die("Falha na execução do código sql" . $mysqli->error);
    $usuario = $querySelectUsuario->fetch_assoc();
    $codigoUsuario = $usuario['TABUSU_Codigo'];

    $insertPraticante = "INSERT INTO TABPRA (TABUSU_Codigo, TABPRA_Nome, TABPRA_Apelido, TABPRA_DataNascimento, TABPRA_Sexo) VALUES ($codigoUsuario, '$nome', '$apelido', '$dataNascimento', $sexo)";
    $queryInsertPraticante = $mysqli->query($insertPraticante) or die("Falha na execução do código sql" . $mysqli->error);
    ?>
    <script>
        //Redireciona para o login
        alert("Cadastro realizado com sucesso!")
        location.href = "../../../index.php";
    </script>
    <?php        
?>