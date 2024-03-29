<?php

    session_start();

    require '../Database/Conexao.php';
    require '../Class/UsuariosClass.php';
    require '../Class/NoticiasClass.php';
    
    if( !empty( $_SESSION['internit-login'] ) ){

        $id = $_SESSION['internit-login'];
        $usuarios_class = new Usuarios( $pdo );
        $usuario_logado = $usuarios_class->listar_por_id( $id );

        $id_noticia = $_GET['id'];
        $noticias_class = new Noticias( $pdo );
        $noticia = $noticias_class->listar_por_id( $id_noticia )->fetch();


    }else{
        header( 'Location: ../login.php' );
        
    }

    if( !empty( $_POST['logout'] )){
        $usuarios = new Usuarios( $pdo );
        $usuarios->logout();
    
        header( 'Location: ../index.php' );
                
    }

    if( empty( $_GET['id']) ){
        echo "<script>alert( 'Não foi possível acessar esta página' )</script>";
        header( 'Location: ../index.php' );
        
    }

    $title = "Noticia - " . $noticia['titulo'];

    include '../Includes/layout-cabecalho.php';
?>

<?php require '../Components/MenuComponent.php' ?>


<div class="container m-auto">

    <?php require '../Components/NoticiaComponent.php' ?>

</div>


<?php include '../Includes/layout-rodape.php' ?>