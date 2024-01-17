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

        if( !empty( $_POST['criar_categoria'] )){


            $nome_categoria = $_POST['nome_categoria'] ;
            $codigo_categoria = $_POST['codigo_categoria'];
          
            $dados = array( 'nome_categoria' => $nome_categoria, 'codigo_categoria' => $codigo_categoria, 'usuario_id' => $usuario_logado['id'] );
            
            $categorias_class = new Categorias( $pdo );
            $resultado = $categorias_class->criar_categoria( $dados );

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

    <?php require '../Components/FormCriarCategoriaComponent.php'; ?>

</div>


<?php 
    include '../Includes/layout-rodape.php'; 
?>