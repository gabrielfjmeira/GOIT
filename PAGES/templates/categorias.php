<?php
    //Imprime as Categorias para Filtrar a Aplicação
    $categorias = "SELECT * FROM CATATV ORDER BY CATATV_Descricao ASC"; 
    $queryCategorias = $mysqli->query($categorias) or die(mysql_error());?>      
    <button class="onPage" onclick="location.reload();">Todas</button> 
    <?php
    while($categoria = mysqli_fetch_array($queryCategorias)){
        
        $catatv_codigo = $categoria['CATATV_Codigo'];
        $catatv_descricao = $categoria['CATATV_Descricao'];?>
        <button onclick="location.href ='../categorias/categorias_home.php?categoriafiltrada=<?php echo $catatv_codigo;?>';"><?php echo $catatv_descricao;?></button>                                                                                        
    <?php    
    }
?>