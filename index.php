<?php
    session_start();

    $title = "Página Inicial";

    require './Database/Conexao.php';
    require './Class/UsuariosClass.php';

    if( !empty( $_SESSION['internit-login'] ) ){
        
        $id = $_SESSION['internit-login'];

        $texto_intro = 

        $usuarios_class = new Usuarios( $pdo );
        $usuario_logado = $usuarios_class->listar_por_id( $id );
    }

    if( !empty($_POST['logout'])){
        $usuarios = new Usuarios( $pdo );
        $usuarios->logout();
    
        header('Location: ../index.php');
    }

    include './Includes/layout-cabecalho.php';
?>


<?php require './Components/MenuComponent.php' ?>

<div class="container pt-5 m-auto">

    <div class="mb-5">
        <h1>Seja bem vindo ao nosso site!</h1>
        
        <?php  if( empty( $_SESSION['internit-login'] )):  ?>

            <p><a href="./registrar.php">Cadastre-se aqui</a> ou faça o <a href="./login.php">Login</a> para navegar na nossa plataforma.</p>

        <?php endif ?>

    </div>

</div>


<?php 
    include './Includes/layout-rodape.php'; 
?>
