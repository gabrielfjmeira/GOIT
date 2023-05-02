<nav>
    <button onclick="location.href= '../../CONFIG/login/logout.php' ">
        <img src="<?php echo $assets_path ?>/logOut.svg" alt="" >
        <p style="display: ;">LogOut</p>
    </button>
    <?php 
    //Verifica se é um Admin
    if ($_SESSION['TIPOUSUARIO'] == 1){?>
        <button onclick="location.href= '../admin/admin.php' ">
            <img src="<?php echo $assets_path ?>/admin.svg" alt="" >
            <p style="display: ;">Painel do administrador</p>
        </button>   
    <?php 
    }?>                
    <button onclick="location.href ='../atividades_ao_ar_livre/insert/insert_atividade.php';">
        <img src="<?php echo $assets_path ?>/buttonNewPubli.svg" alt="">
        <p style="display: ;">Publicar</p>
    </button>
    <button>
        <img src="<?php echo $assets_path ?>/buttonPerfil.svg" alt="">
        <p style="display: ;">Perfil</p>
    </button>

</nav>