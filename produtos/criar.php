<?php
    session_start();

    $title = "Editar Produto";

    require '../Database/Conexao.php';
    require '../Class/UsuariosClass.php';
    require '../Class/ProdutosClass.php';
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

        // Categorias
        $categorias_class = new Categorias( $pdo );
        $todas_categorias_usuario = $categorias_class->listar_categorias_usuario( $usuario_logado['id'] )->fetchAll();

        if( !empty( $_POST['criar_produto'] )){

            if( !$_POST['categoria'] ){

                echo "<script>alert('Não é possível criar um produto sem uma categoria selecionada.');</script>" ;
                header( 'Refresh: 0' );
                return;
            }

            $categoria_selecionada = $categorias_class->listar_categoria_por_id( $_POST['categoria'] )->fetch();

            $nome = $_POST['nome'] ;
            $descricao = $_POST['descricao'];
            $codigo = $_POST['codigo'];
            $categoria = $_POST['categoria'];
            $situacao = $_POST['situacao'];
            $valor = $_POST['valor'];
            $quantidade = $_POST['quantidade'];
            $imagem = $_FILES['imagem'];
            $usuario_id = $usuario_logado['id'];
          
            $dados = array( 'nome' => $nome, 'descricao' => $descricao, 'codigo' => $codigo,
            'categoria' => $categoria, 'situacao' => $situacao, 'valor' => $valor, 'quantidade' => $quantidade,
            'imagem' => $imagem, 'usuario_id' => $usuario_id, 'categoria_selecionada' => $categoria_selecionada );
            
            $produtos_class = new Produtos( $pdo );
            $resultado = $produtos_class->criar_produto( $dados );

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

    <h1 class="my-3 pb-3">Criar Produto</h1>

    <a class="btn btn-sm text-white mb-3" style="background: #315d7b" href="../categorias/criar.php">Criar Categorias</a>

    <?php require '../Components/FormCriarProdutoComponent.php'; ?>

</div>


<?php 
    include '../Includes/layout-rodape.php'; 
?>