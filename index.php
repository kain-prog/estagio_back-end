<?php
    session_start();

    $title = "Página Inicial";

    require './Database/Conexao.php';
    require './Class/UsuariosClass.php';
    
    include './Includes/layout-cabecalho.php';

    if( !empty($_POST['logout'])){
        $usuarios = new Usuarios( $pdo );
        $usuarios->logout();
    
        header('Location: ../index.php');
        exit;        
    }
?>


<?php require './Components/MenuComponent.php' ?>

<div class="container pt-5 m-auto">

    <div class="mb-5">
        <h1>Seja bem vindo ao nosso site!</h1>
        <p>Confira abaixo as últimas notícias da nossa plataforma!</p>
    </div>

    <div class="row m-auto">

        



    </div>
</div>


<?php 
    include './Includes/layout-rodape.php'; 
?>