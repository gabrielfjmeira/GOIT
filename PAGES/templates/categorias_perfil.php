<?php
    //Imprime as Categorias para Filtrar a Aplicação
    $categorias = "SELECT * FROM CATATV ORDER BY CATATV_Descricao ASC"; 
    $queryCategorias = $mysqli->query($categorias) or die(mysql_error());?>    
    <button class="onPage" onclick="location.href ='../perfil/perfil.php';" style="cursor: pointer;">Todas</button> 
    <?php
    while($categoria = mysqli_fetch_array($queryCategorias)){
        
        $catatv_codigo = $categoria['CATATV_Codigo'];
        $catatv_descricao = $categoria['CATATV_Descricao'];?>
        <?php if($catatv_codigo == $categoriafiltrada){?>
            <button class="onPage" onclick="location.href ='../categorias/categorias_perfil.php?categoriafiltrada=<?php echo $catatv_codigo;?>&codperfil=<?php echo $_SESSION['CODIGO'];?>'; mudarEstiloButtonTodas();" style="cursor: pointer;"><?php echo $catatv_descricao;?></button>                                                                                        
        <?php
        }else{?>
            <button onclick="location.href ='../categorias/categorias_perfil.php?categoriafiltrada=<?php echo $catatv_codigo;?>&codperfil=<?php echo $_SESSION['CODIGO'];?>';" style="cursor: pointer;"><?php echo $catatv_descricao;?></button>                                                                                        
        <?php   
        }               
    }
?>