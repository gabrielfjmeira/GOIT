<?php

    include('../../CONNECTIONS/connection.php');       
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/style.css">
    <title>GO🐐IT | A Social Adventure</title>
</head>
<body>
    <section class="header">
        <center>
            <h1>GO🐐IT | A Social Adventure</h1>
            <button onclick="window.location.href = './selecao_tipoUsuario.php'">
                Voltar ⬅
            </button> 
        </center>
    </section>

    <section class="form">
        <form id="formCadastroPraticante" name="formCadastroPraticante" action="./insert_praticantePHP.php" method="POST" onsubmit="return formCadastroPraticanteOnSubmit();">
            <center>
                <h1>Cadastro de Praticante</h1>
                
                <label>Nome: </label>
                <input type="text" id="txtNome" name="txtNome" placeholder="Nome" class="input" required/><br><br>
                
                <label>Apelido: </label>
                <input type="text" id="txtApelido" name="txtApelido" placeholder="Apelido" class="input" onchange="formCadastroPraticanteOnSubmit();" required/><p id="errorApelido"></p><br>
                
                <label>Data de Nascimento: </label>
                <input type="date" id="dataNascimento" name="dataNascimento" placeholder="Data de Nascimento" class="input" required/><br><br>

                <label>Sexo:</label>
                <input type="radio" id="sexo_m" name="sexo" value="sexo_m" required>
                <label>Masculino</label>
                <input type="radio" id="sexo_f" name="sexo" value="sexo_f" required>
                <label>Feminino</label>
                <input type="radio" id="sexo_o" name="sexo" value="sexo_o" required>
                <label>Outro</label><br><br>

                <label>Email: </label>
                <input type="text" id="txtEmail" name="txtEmail" placeholder="Email" class="input" required/><br><br>

                <label>Senha: </label>
                <input type="text" id="txtSenha" name="txtSenha" placeholder="Senha" class="input" required/><br><br>

                <label>Confirme sua Senha: </label>
                <input type="text" id="txtSenhaConfirmada" name="txtSenhaConfirmada" placeholder="Confirme sua Senha" class="input" required/><br><br>

                <button type="submit"> Entrar </button>
                <p> Já possuí Login? <a href="../../index.html">Realizar Login</a></p> 
            </center>
        </form>

        <script>
            function formCadastroPraticanteOnSubmit(){                    
                var apelido = document.getElementById('txtApelido');
                var errorApelido = document.getElementById('errorApelido');
                var dataNascimento = document.getElementById('dataNascimento');
                var dtDOB = new Date(dataNascimento);
                var dtCurrent = new Date();                
                var txtEmail = document.getElementById('txtEmail');
                var txtSenha = document.getElementById('txtSenha');
                var txtSenhaConfirmada = document.getElementById('txtSenhaConfirmada');

                const reEmail = /^[a-z]\w*@\w{4}.*\.\w{2,4}$/;           
                   
                if (apelido.value.length > 0){
                    <?php                
                        $apelidoUsuario = "SELECT * FROM TABUSU WHERE TABUSU_Apelido = '"?>apelido.value<?php"';"
                        $resultadosApelido = $mysqli->query($apelidoUsuario) or die("Falha na execução do código sql" . $mysqli->error);
                        $qtdresultadosApelido = $resultadosApelido->num_rows;
                        if ($qtdresultadosApelido > 1){?>                                                        
                            errorApelido.innerHTML = "Apelido Já Utilizado";
                        <?php                                
                        } else{?>                        
                            errorApelido.innerHTML = "Apelido Disponível";
                        <?php    
                        }
                    ?>
                }
                
                if (dtDOB - dtCurrent < 0){
                    alert('Data de Nascimento inválida!');
                    dataNascimento.focus();
                    return false;
                }

                if (!reEmail.test(txtEmail.value)) {
                    alert('Digite um Email válido!');
                    txtEmail.focus();
                    return false;
                }            
                
                if (txtSenha.value.length < 7 || txtSenha.value.length > 20){
                    alert('Senha deve possuir no mínimo 7 e no máximo 20 caracteres!');
                    txtSenha.focus();
                    return false;
                } 
                
                if (txtSenha != txtSenhaConfirmada){
                    alert('Senhas não coincidem');
                    txtSenhaConfirmada.focus();
                    return false;
                }
                
                return true;
            }
            
        </script>
    </section>
</body>
</html>