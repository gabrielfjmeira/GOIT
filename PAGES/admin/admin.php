<?php
    //Incluí Conexão
    include('../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../index.php?error=4");
    }

    //Verifica se é um Admin
    if ($_SESSION['TIPOUSUARIO'] != 1){
        header ("Location: ../home/home.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Configurações-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Título da Página-->
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body>
    
    <!--Cabeçalho-->    
    <header>        
        <h1>ADMINISTRAÇÃO</h1>        
        <button onclick="window.location.href = '../home/home.php';">
            Voltar ⬅
        </button>
    </header>

    <br><br>

    <!--Menu de Tabelas para o Administrador Gerenciar-->
    <div>    
        <button onclick="window.location.href = './delegar_acesso/delegaracesso.php';">
            Delegar Acesso
        </button> 

        <button onclick="window.location.href = './tipos_usuarios/tiposusuarios.php';">
            Tipos de Usuários
        </button>
        
        <button onclick="window.location.href = './riscos_atividades/riscosatividades.php';">
            Riscos de Atividades ao Ar Livre
        </button>                

        <button onclick="window.location.href = './categorias_atividades/categoriasatividades.php';">
            Categorias de Atividades ao Ar Livre
        </button>         
    </div>
    
</body>
</html>