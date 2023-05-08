<nav>
    <img src="<?php echo $assets_path ?>/logoBlack.png" alt="Go It logotipo">
    <button onclick="location.href= '../../CONFIG/login/logout.php' ">
        <img src="<?php echo $assets_path ?>/logOut.svg" alt="" >
        <p>LogOut</p>
    </button>
    <?php 
    //Verifica se é um Admin
    if ($_SESSION['TIPOUSUARIO'] == 1){?>
        <button onclick="location.href= '../admin/admin.php' ">
            <img src="<?php echo $assets_path ?>/admin.svg" alt="" >
            <p>Painel do administrador</p>
        </button>   
    <?php 
    }else{?>
        <button hidden></button>
    <?php
    }?>                    
    <button onclick="location.href ='../atividades_ao_ar_livre/insert/insert_atividade.php';">
        <img src="<?php echo $assets_path ?>/buttonNewPubli.svg" alt="">
        <p>Publicar</p>
    </button>
    <button onclick="location.href ='../perfil/perfil.php';">     
    <?php        
        $sqlUser = "SELECT * FROM TABUSU WHERE TABUSU_Codigo = " . $_SESSION['CODIGO'];            
        $querySqlUser = $mysqli->query($sqlUser) or die("Falha na execução do código sql" . $mysqli->error);
        $userData = mysqli_fetch_array($querySqlUser);
        if(is_null($userData['TABUSU_Icon'])){?>
            <img src="<?php echo $assets_path ?>/buttonPerfil.svg" alt="">
            <p><?php echo $_SESSION['Apelido'];?></p>  
        <?php
        }else{
            if(substr($userData['TABUSU_Icon'], -4) == ".jpg" || substr($userData['TABUSU_Icon'], -4) == ".png" ){
                $nomeImagem = substr($userData['TABUSU_Icon'], -17);
            }else{
                $nomeImagem = substr($userData['TABUSU_Icon'], -18);
            };  
            ?>
            <img src="../../perfil/arquivos/<?php echo $nomeImagem;?>" alt="">
            <p><?php echo $_SESSION['Apelido'];?></p> 
        <?php
        }           
        ?>                       
    </button>

</nav>