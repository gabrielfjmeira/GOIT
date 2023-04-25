<nav class="flex">
    <button><img src="<?php echo $assets_path ?>/logOut.svg" alt="" onclick="location.href= '../../CONFIG/login/logout.php' "></button>
    <?php 
    //Verifica se é um Admin
    if ($_SESSION['TIPOUSUARIO'] == 1){?>
        <button><img src="<?php echo $assets_path ?>/admin.svg" alt="" onclick="location.href= '../admin/admin.php' "></button>   
    <?php 
    }?>                
    <button><img src="<?php echo $assets_path ?>/buttonNewPubli.svg" alt="" onclick="location.href ='../atividades_ao_ar_livre/insert/insert_atividade.php';"></button>
    <button><img src="<?php echo $assets_path ?>/buttonPerfil.svg" alt=""></button>
</nav>