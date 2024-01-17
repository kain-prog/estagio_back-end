<?php

    session_start();

    $title = "Dashboard";

    require './Database/Conexao.php';
    require './Class/UsuariosClass.php';
    require './Class/ProdutosClass.php';
    
    include './Includes/layout-cabecalho.php';

    if( !empty( $_SESSION['internit-login'] ) ){
        
        $id = $_SESSION['internit-login'];

        $usuarios_class = new Usuarios( $pdo );
        $usuario_logado = $usuarios_class->listar_por_id( $id );

        if( $usuario_logado['adm'] ) {
            header( 'Location: ./adm/painel.php' );
        }

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
                    <a href="#" class="btn btn-sm text-white" style="background:#315d7b">Criar Produtos</a>
                    <a href="../produtos/todos.php" class="btn btn-sm btn-secondary text-white">Gerenciar Produtos</a>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td class="text-center">Imagem</td>
                            <td class="text-center">Nome</td>
                            <td class="text-center">Quantidade</td>
                            <td class="text-center">Valor</td>                                   
                            <td class="text-center"></td>                      
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $todos_produtos_ativos as $produto ): ?>

                            <tr>
                                <td class="text-center">
                                    <img src="./Uploads/Produtos/<?= $produto['usuario_id'] ?>/<?= $produto['imagem'] ?>" alt="<?= $produto['nome'] ?>">
                                </td>
                                <td class="text-center"> <?= $produto['nome'] ?> </td>
                                <td class="text-center"> <?= $produto['quantidade'] ?> </td>   
                                <td class="text-center"> <?= $produto['valor'] ?> </td>  
                                <td class="d-flex justify-content-center">
                                    <a class="text-decoration-none" href="./produtos/info.php?id=<?= $produto['id'] ?>">Ver produto</a>
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