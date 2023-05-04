<nav>
    <img src="<?php echo $assets_path ?>/logoBlack.png" alt="Go It logotipo">
    <button onclick="location.href= '../../../CONFIG/login/logout.php' ">
        <img src="<?php echo $assets_path ?>/logOut.svg" alt="" >
        <p>LogOut</p>
    </button>
    <?php 
    //Verifica se é um Admin
    if ($_SESSION['TIPOUSUARIO'] == 1){?>
        <button onclick="location.href= '../../admin/admin.php' ">
            <img src="<?php echo $assets_path ?>/admin.svg" alt="" >
            <p>Painel do administrador</p>
        </button>   
    <?php 
    }?>                
    <button onclick="">
        <img src="<?php echo $assets_path ?>/buttonNewPubliFilled.svg" alt="">
        <p>Publicar</p>
    </button>
    <button onclick="">
        <img src="<?php echo $assets_path ?>/buttonPerfil.svg" alt="">
        <p><?php echo $_SESSION['Apelido'];?></p>
    </button>

</nav>