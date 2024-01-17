<?php

    session_start();

    require '../Database/Conexao.php';
    require '../Class/UsuariosClass.php';
    require '../Class/ProdutosClass.php';
    
    if( !empty( $_SESSION['internit-login'] ) ){

        $id = $_SESSION['internit-login'];
        $usuarios_class = new Usuarios( $pdo );
        $usuario_logado = $usuarios_class->listar_por_id( $id );

        $produtos_class = new Produtos( $pdo );
        $produtos = $produtos_class->listar_todos_produtos_do_usuario( $usuario_logado['id'] )->fetchAll();

        if( !empty( $_POST['id'] && $_POST['ativar'] )){

            $id_produto = $_POST['id'];
            $ativar = $produtos_class->ativar_toggle( $id_produto );

            if( $ativar['sucesso'] ) {
                header( 'Refresh: 0' );
                
            };
        }
        
        if( !empty( $_POST['id'] && $_POST['excluir_produto'] )){

            $id_produto = $_POST['id'];
            $ativar = $produtos_class->excluir_produto( $id_produto );

            if( $ativar['sucesso'] ) {
                header( 'Refresh: 0' );
                
            };
        }


    }else{
        header( 'Location: ../login.php' );
        
    }

    if( !empty( $_POST['logout'] )){
        $usuarios = new Usuarios( $pdo );
        $usuarios->logout();
    
        header( 'Location: ../index.php' );
                
    }

    $title = "Listagem de Produtos";

    include '../Includes/layout-cabecalho.php';
?>

<?php require '../Components/MenuComponent.php' ?>


<div class="container m-auto mt-5 pt-5">

    <?php require '../Components/TodosProdutosComponent.php' ?>

</div>


<?php include '../Includes/layout-rodape.php' ?>