<?php

    session_start();

    $title = "Dashboard";

    require './Database/Conexao.php';
    require './Class/UsuariosClass.php';
    require './Class/ProdutosClass.php';
    require './Class/CategoriasClass.php';
    
    include './Includes/layout-cabecalho.php';

    if( !empty( $_SESSION['internit-login'] ) ){
        
        $id = $_SESSION['internit-login'];

        $usuarios_class = new Usuarios( $pdo );
        $usuario_logado = $usuarios_class->listar_por_id( $id );

        if( $usuario_logado['adm'] ) {
            header( 'Location: ./adm/painel.php' );
        }

        // listagem de categorias
        $categorias_class = new Categorias( $pdo );
        $quantidade_categorias = $categorias_class->listar_categorias_usuario( $usuario_logado['id'] )->rowCount();
        $todas_categorias = $categorias_class->listar_categorias_usuario( $usuario_logado['id'] )->fetchAll();

        // listagem de produtos
        $produtos_class = new Produtos( $pdo );
        $quantidade_produtos_ativos = $produtos_class->listar_todos_produtos_ativos( $id )->rowCount();
        $quantidade_produtos_cadastrados = $produtos_class->listar_todos_produtos_do_usuario( $id )->rowCount();

        if( $quantidade_produtos_ativos != 0 ){
            $todos_produtos_ativos = $produtos_class->listar_todos_produtos_ativos( $id )->fetchAll();
        }

        
    }else{
        header( 'Location: ./login.php' );
        exit;
    }

    if( !empty( $_POST['logout'] )){
        $usuarios = new Usuarios( $pdo );
        $usuarios->logout();
    
        header( 'Location: ./index.php' );
        exit;        
    }

    if( !empty( $_POST['apagar_categoria'] )){

        $categoria_id = $_POST['id'];
        $retorno = $categorias_class->excluir_categoria( $categoria_id );

        if( $retorno['sucesso'] ){
            header( 'Refresh: 0');
            exit;
        }

    }
?>

<?php require './Components/MenuComponent.php' ?>


<div class="container m-auto">
    <div class="my-5">
        
        <div class="row">
            <div class="col mb-4">
                <h1 class="text-center text-lg-start">Dashboard</h1>
            </div>

            <div class="col-lg d-flex gap-2 flex-wrap justify-content-center justify-content-lg-end mb-4">

                <div class="card text-bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header" style="border-bottom: none !important;">Produtos Ativos</div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <h2 class="fs-1 fw-normal text-center fst-italic"> <?= $quantidade_produtos_ativos ?> </h2>
                    </div>
                </div>

                <div class="card mb-3" style="max-width: 18rem; background: #315d7b">
                    <div class="card-header text-white" style="border-bottom: none !important;">Produtos Cadastrados</div>
                    <div class="card-body text-white d-flex align-items-center justify-content-center">
                        <h2 class="fs-1 fw-normal fst-italic"> <?= $quantidade_produtos_cadastrados ?> </h2>
                    </div>
                </div>
            </div>

        </div>


        <div class="card">

            <div class="card-header">
                <h6 class="mb-0">Produtos Ativos</h6>
            </div>

            <div class="card-body">
                <div class="d-flex gap-3 justify-content-end my-3">
                    <a href="./produtos/criar.php" class="btn btn-sm text-white" style="background:#315d7b">Criar Produto</a>
                    <a href="../produtos/todos.php" class="btn btn-sm btn-secondary text-white">Gerenciar Produtos</a>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td class="text-center" style="vertical-align: middle;">Imagem</td>
                            <td class="text-center" style="vertical-align: middle;">Nome</td>
                            <td class="text-center" style="vertical-align: middle;">Quantidade</td>
                            <td class="text-center" style="vertical-align: middle;">Valor</td>                                   
                            <td class="text-center" style="vertical-align: middle;"></td>                      
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $todos_produtos_ativos as $produto ): ?>

                            <tr>
                                <td class="text-center">
                                    <img class="h-100 object-fit-cover" src="./<?= $produto['imagem'] ?>" alt="<?= $produto['nome'] ?>" style="max-width: 235px; vertical-align: middle;">
                                </td>
                                <td class="text-center" style="vertical-align: middle;"> <?= $produto['nome'] ?> </td>
                                <td class="text-center" style="vertical-align: middle;"> <?= $produto['quantidade'] ?> </td>   
                                <td class="text-center" style="vertical-align: middle;"> <?= $produto['valor'] ?> </td>  
                                <td class="text-center" style="vertical-align: middle;">
                                    <a class="text-decoration-none" href="./produtos/info.php?id=<?= $produto['id'] ?>">Ver produto</a>
                                </td>
                            </tr>

                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

        </div>

        <h5 class="my-5 text-center text-secondary">Listagem de categorias</h5>

        <div class="card">

            <div class="card-header">
                <h6 class="mb-0">Categorias -<span class="text-success" style="font-weight: 600; font-style: italic"> <?= $quantidade_produtos_cadastrados ?> </span></h6>
            </div>

            <div class="card-body">
                <div class="d-flex gap-3 justify-content-end my-3">
                    <a href="./categorias/criar.php" class="btn btn-sm text-white" style="background:#315d7b">Adicionar Categoria</a>
                </div>

                <table class="table table-striped table-hover overflow-scroll">
                    <thead>
                        <tr>
                            <td class="text-center">Nome</td>
                            <td class="text-center">Código</td>                      
                            <td class="text-center"></td>                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $todas_categorias as $categoria ): ?>

                            <tr>
                                <td class="text-center" style="vertical-align: middle;"> <?= $categoria['nome_categoria'] ?> </td>
                                <td class="text-center" style="vertical-align: middle;"> <?= $categoria['codigo_categoria'] ?></td>
                                <td class="text-center" style="vertical-align: middle;">

                                    <div class="d-flex gap-3 justify-content-center align-items-center">
                                        <small>
                                            <a style="font-size:12px font-weight: 700" class="text-decoration-none " href="../categorias/editar.php?id=<?= $categoria['categoria_id'] ?>"> Editar </a>
                                        </small>

                                        <small>
                                            <form method="POST">
                                                <input type="hidden" name="id" value="<?= $categoria['categoria_id'] ?>">
                                                <input class="nav-link text-danger" name="apagar_categoria" type="submit" value="Apagar" style="font-size:12px; font-weight: 700">
                                            </form>
                                        </small>
                                    </div>
                                
                                </td>
                            </tr>

                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</div>


<?php include './Includes/layout-rodape.php' ?>