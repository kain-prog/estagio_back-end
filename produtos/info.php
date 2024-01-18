<?php

    session_start();

    require '../Database/Conexao.php';
    require '../Class/UsuariosClass.php';
    require '../Class/ProdutosClass.php';
    
    if( empty( $_GET['id']) ){
        echo "<script>alert( 'Não foi possível acessar esta página' )</script>";
        header( 'Location: ../login.php' );
        
    }

    if( !empty( $_SESSION['internit-login'] ) ){

        $id = $_SESSION['internit-login'];
        $usuarios_class = new Usuarios( $pdo );
        $usuario_logado = $usuarios_class->listar_por_id( $id );

        $id_produto = $_GET['id'];
        $produtos_class = new Produtos( $pdo );
        $produto = $produtos_class->listar_produto_por_id( $id_produto )->fetch();

        if( $produto['usuario_id'] != $usuario_logado['id'] ){
            echo "<script>alert( 'Não foi possível acessar esta página' )</script>";
            header( 'Location: ../login.php' );
            
        }

        if( !empty( $_POST['id'] && $_POST['ativar'] )){

            $ativar = $produtos_class->ativar_toggle( $id_produto );

            if( $ativar['sucesso'] ) {
                header( 'Refresh: 0' );
                
            };
        }
        
        if( !empty( $_POST['excluir_produto'] )){

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

    $title = "Produto - " . $produto['nome'];

    include '../Includes/layout-cabecalho.php';
?>

<?php require '../Components/MenuComponent.php' ?>


<div class="container m-auto mt-5 pt-5">

    <?php require '../Components/ProdutoComponent.php' ?>

</div>


<?php include '../Includes/layout-rodape.php' ?>
