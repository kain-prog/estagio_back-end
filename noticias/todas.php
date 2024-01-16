<?php

    session_start();

    $title = "Todas as Notícias";

    require '../Database/Conexao.php';
    require '../Class/UsuariosClass.php';
    require '../Class/NoticiasClass.php';
    
    include '../Includes/layout-cabecalho.php';

    if( !empty( $_SESSION['internit-login'] ) ){
        
        $id = $_SESSION['internit-login'];

        $usuarios_class = new Usuarios( $pdo );
        $usuario_logado = $usuarios_class->listar_por_id( $id );

        $noticias_class = new Noticias( $pdo );
        // Todas Noticias
        $quantidade_noticias = $noticias_class->todas_noticias()->rowCount();
        $noticias = $noticias_class->todas_noticias()->fetchAll();


        if( !empty( $_GET['id'] && $_GET['editar'] ) ){
            $noticia_id = $_GET['id'];
            header( 'Location: ./teste.php?id=' . $noticia_id );
        }

        if( !empty( $_POST['id'] && $_POST['apagar'] ) ){
            $id_noticia = $_POST['id'];
            $destroy = $noticias_class->apagar_noticia( $id_noticia );

            if( $destroy ){
                header( 'Location: ./todas.php' );
            }
        }

        if( !empty( $_POST['id'] && $_POST['destacar'] )){
            $noticia_id = $_POST['id'];
            $destaque = $noticias_class->destacar_toggle( $noticia_id );

            if( $destaque ){
                header( 'Location: ./todas.php' );
            }
        }
        
    }else{
        header( 'Location: ../login.php' );
        exit;
    }

    if( !empty( $_POST['logout'] )){
        $usuarios = new Usuarios( $pdo );
        $usuarios->logout();
    
        header( 'Location: ../index.php' );
        exit;        
    }
?>

<?php require '../Components/MenuComponent.php' ?>


<div class="container m-auto">
    <div class="my-5">
        <h1 class="text-center">Todas as Notícias</h1>
        <p class="text-center">Fique por dentro de todas as novidades da nossa plataforma.</p>

        <?php if( $usuario_logado['adm'] ):  ?>

            <a class="btn mt-3 btn-sm text-white" href="./criar.php" style="background: #315d7b;" >Criar notícia</a>
            <hr />

        <?php endif ?>

    </div>

    <?php require '../Components/TodasNoticiasComponent.php' ?>  
</div>


<?php include '../Includes/layout-rodape.php' ?>