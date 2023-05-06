<?php
    //Incluí Conexão
    include('../../../CONNECTIONS/connection.php');

    //Verifica Login
    if (!$_SESSION['LOGGED']){
        header ("Location: ../../../index.php?error=4");
    }
    
    //Excluí a Atividade se Receber seu Código
    if (isset($_GET['codigo'])){
        $codigo = $_GET['codigo'];               
    
        //Verifica se tem inscritos na atividade ao ar livre
        $inscritos = "SELECT * FROM PARATV WHERE TABATV_Codigo = $codigo";
        $queryInscritos = $mysqli->query($inscritos) or die("Falha na execução do código sql" . $mysqli->error);

        if($queryInscritos->num_rows == 0){
            $atividade = "SELECT * FROM TABATV WHERE TABATV_Codigo = $codigo";
            $queryAtividade = $mysqli->query($atividade) or die("Falha na execução do código sql" . $mysqli->error);

            if ($queryAtividade->num_rows == 1){                                
                $deleteAtividade = "DELETE FROM TABATV WHERE TABATV_Codigo = $codigo";
                $queryDeleteAtividade = $mysqli->query($deleteAtividade) or die("Falha na execução do código sql" . $mysqli->error);
                header ("Location: ../../home/home.php");

            }else{
                header ("Location: ../../home/home.php");
            }
        }else{?>
            <!--Redireciona para a Página anterior-->
            <script>
                alert('Atividade ao ar livre não pode ser apagada pois possuí incritos!');
                window.location.href = "../../home/home.php";  
            </script>
        <?php
        }               
    }else{
        header ("Location: ../../home/home.php");
    }    
?>                         

    <!--Redireciona para a Página anterior-->
    <script>
        alert('Atividade ao ar livre apagada com sucesso!');
        window.location.href = "../../home/home.php";        
    </script>