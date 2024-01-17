<?php
    session_start();

    $title = "Editar Produto";

    require '../Database/Conexao.php';
    require '../Class/UsuariosClass.php';
    require '../Class/ProdutosClass.php';

    if( !empty( $_SESSION['internit-login']) ){

        //id do usuário logado
        $id = $_SESSION['internit-login'];

        $usuarios_class = new Usuarios( $pdo );
        
        // Dados do usuário logado
        $usuario_logado = $usuarios_class->listar_por_id( $id );

        if( !empty( $_GET['id'] )){

            $produtos_class = new Produtos( $pdo );

            $id_produto = $_GET['id'];
            $produto = $produtos_class->listar_produto_por_id( $id_produto )->fetch();

            if( $produto['usuario_id'] != $usuario_logado['id'] ){
                echo "<script>alert( 'Não foi possível acessar esta página' )</script>";
                header( 'Location: ../login.php' );
                
            }
        
        }

        if( $usuario_logado['adm'] ){
            header( 'Location: ../usuario/painel.php' ); 
            
        }

        if( !empty( $_POST['atualizar_produto'] )){

            $nome = $_POST['nome'] ;
            $descricao = $_POST['descricao'];
            $codigo = $_POST['codigo'];
            $codigo_categoria = $_POST['codigo_categoria'];
            $situacao = $_POST['situacao'];
            $valor = $_POST['valor'];
            $quantidade = $_POST['quantidade'];
            $imagem = $_FILES['imagem'];
          
            $dados = array( 'nome' => $nome, 'descricao' => $descricao, 'codigo' => $codigo,
            'codigo_categoria' => $codigo_categoria, 'situacao' => $situacao, 'valor' => $valor, 'quantidade' => $quantidade,'imagem' => $imagem, );

            $resultado = $produtos_class->atualizar_dados( $id_produto, $dados );

            if( $resultado['sucesso'] ){
                header( 'Refresh: 0' );
                
            }  
        }


    }else {
        header( 'Location: ../login.php' ); 
        
    }

    if( !empty( $_POST['logout'] )){
        $usuarios = new Usuarios( $pdo );
        $usuarios->logout();
    
        header( 'Location: ../index.php' ); 
                
    }
        
    include '../Includes/layout-cabecalho.php';
?>

<?php require '../Components/MenuComponent.php' ?>


<div class="container m-auto">

    <h1 class="my-3 pb-3">Editar Produto</h1>

    <?php require '../Components/FormEditarProdutoComponent.php'; ?>

</div>


<?php 
    include '../Includes/layout-rodape.php'; 
?>