<nav class="flex">
    <button><img src="<?php echo $assets_path ?>/logOut.svg" alt="" onclick="location.href= '../../CONFIG/login/logout.php' "></button>
    <?php 
    //Verifica se é um Admin
    if ($_SESSION['TIPOUSUARIO'] == 1){?>
        <button><img src="<?php echo $assets_path ?>/admin.svg" alt="" onclick="location.href= '../admin/admin.php' "></button>   
    <?php 
    }?>                
    <button><img src="<?php echo $assets_path ?>/ButtonAddFilled.svg" alt=""></button>
    <button><img src="<?php echo $assets_path ?>/buttonPerfil.svg" alt=""></button>
</nav>