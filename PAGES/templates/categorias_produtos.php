<?php
    //Imprime as Categorias para Filtrar a Aplicação
    $categorias = "SELECT * FROM CATATV ORDER BY CATATV_Descricao ASC"; 
    $queryCategorias = $mysqli->query($categorias) or die(mysql_error());
    if(isset($_GET['categoriafiltrada'])){?>
        <button onclick="location.href='./produtos.php';" style="cursor: pointer;">Todas</button> 
        <?php
    }else{?>
        <button class="onPage" onclick="location.href='./produtos.php';" style="cursor: pointer;">Todas</button> 
        <?php
    }    
    while($categoria = mysqli_fetch_array($queryCategorias)){        
        $catatv_codigo = $categoria['CATATV_Codigo'];
        $catatv_descricao = $categoria['CATATV_Descricao'];               
        if(isset($_GET['categoriafiltrada']) && $_GET['categoriafiltrada'] == $catatv_codigo){?>        
            <button class="onPage" onclick="location.href ='./produtos.php?categoriafiltrada=<?php echo $catatv_codigo;?>';" style="cursor: pointer;"><?php echo $catatv_descricao;?></button>                                  
            <?php
        }else{?>
            <button onclick="location.href ='./produtos.php?categoriafiltrada=<?php echo $catatv_codigo;?>';" style="cursor: pointer;"><?php echo $catatv_descricao;?></button>
            <?php
        }       
    }
?>