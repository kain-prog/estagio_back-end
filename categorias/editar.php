<?php
    session_start();

    $title = "Editar Produto";

    require '../Database/Conexao.php';
    require '../Class/UsuariosClass.php';
    require '../Class/CategoriasClass.php';
    
    include '../Includes/layout-cabecalho.php';

    if( !empty( $_SESSION['internit-login']) ){

        if( $usuario_logado['adm'] ){
            header( 'Location: ../usuario/painel.php' ); 
            exit;
        }

        //id do usuário logado
        $id = $_SESSION['internit-login'];

        $usuarios_class = new Usuarios( $pdo );

        // Dados do usuário logado
        $usuario_logado = $usuarios_class->listar_por_id( $id );

        if( !empty( $_GET['id'] )){

            $categorias_class = new Categorias( $pdo );

            $id_categoria = $_GET['id'];
            $categoria = $categorias_class->listar_categoria_por_id( $id_categoria )->fetch();

            if( $categoria['usuario_id'] != $usuario_logado['id'] ){
                echo "<script>alert( 'Não foi possível acessar esta página' )</script>";
                header( 'Location: ../login.php' );
                exit;
            }
        
        }

        if( !empty( $_POST['atualizar_categoria'] )){

            $categoria_id = $_GET['id'];
            $nome_categoria = $_POST['nome_categoria'] ;
            $codigo_categoria = $_POST['codigo_categoria'];
          
            $dados = array( 'nome_categoria' => $nome_categoria, 'codigo_categoria' => $codigo_categoria, 'usuario_id' => $usuario_logado['id'] );
        
            $resultado = $categorias_class->editar_categoria($categoria_id, $dados );

            if( $resultado['sucesso'] ){
                header( 'Refresh: 0' );
                exit;
            }  
        }


    }else {
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

    <h1 class="my-3 pb-3">Criar Categoria</h1>

    <?php require '../Components/FormEditarCategoriaComponent.php' ?>

</div>


<?php 
    include '../Includes/layout-rodape.php'; 
?>