<?php
    session_start();

    $title = "Painel Admin";

    require '../Database/Conexao.php';
    require '../Class/UsuariosClass.php';
    require '../Class/NoticiasClass.php';
    
    include '../Includes/layout-cabecalho.php';

    if( !empty( $_SESSION['internit-login']) ){

        $id = $_SESSION['internit-login'];

        $usuarios_class = new Usuarios( $pdo );
        $usuarios = $usuarios_class->listar();

        // Definindo quantidade de usuarios
        $quantidade_usuarios = $usuarios->rowCount();
        // Definindo informações de usuarios
        $todos_usuarios = $usuarios->fetchAll();

        $usuario_logado = $usuarios_class->listar_por_id( $id );

        $noticias_class = new Noticias( $pdo );
        // Todas Noticias
        $quantidade_noticias = $noticias_class->todas_noticias()->rowCount();
        // Noticias em Destaque
        $quantidade_noticias_destaque = $noticias_class->noticias_em_destaque()->rowCount();;
        $noticias_destaque = $noticias_class->noticias_em_destaque()->fetchAll();

        if( !$usuario_logado['adm'] ) {
            header( 'Location: ../usuario/painel.php' );
            exit;
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

<div class="container pt-5 m-auto">

    <div class="mb-5 row justify-content-center justify-content-lg-start">

        <div class="col-lg-5 mb-4 mb-lg-0 w-auto">
            <h2>Painel Administrador</h2>
            <p >Olá, <?= $usuario_logado['nome'] ?>.  Bem vindo novamente.</p>
            <small><a class="text-decoration-none" href="./perfil.php">editar perfil</a></small>
        </div>


        <div class="col-lg d-flex gap-2 flex-wrap justify-content-center justify-content-lg-end">

            <div class="card text-bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header" style="border-bottom: none !important;">Total de Assinantes</div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <h2 class="fs-1 fw-normal text-center fst-italic"> <?= $quantidade_usuarios ?></h2>
                </div>
            </div>

            <div class="card mb-3" style="max-width: 18rem; background: #315d7b">
                <div class="card-header text-white" style="border-bottom: none !important;"> Total de Notícias </div>
                <div class="card-body text-white d-flex align-items-center justify-content-center">
                    <h2 class="fs-1 fw-normal fst-italic"><?= $quantidade_noticias ?></h2>
                </div>
            </div>
            
        </div>

    </div>

    <div class="card mb-4">
        <div class="card-header">Notícias em Destaque</div>
        <div class="card-body">
            <div class="d-flex gap-3 justify-content-end my-3">
                <a href="../noticias/todas.php" class="btn btn-sm btn-secondary text-white">Gerenciar notícias</a>
            </div>


            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td class="text-center">Imagem</td>
                        <td class="text-center">Título</td>
                        <td class="text-center">Resumo</td>
                        <td class="text-center">Data</td>                         
                        <td class="text-center"></td>                         
                    </tr>
                </thead>
                <tbody>
                    <?php foreach( $noticias_destaque as $noticia ): ?>

                        <tr>
                            <td class="text-center" style="vertical-align: middle;">
                                <img style="max-width: 80px;" src="../<?= $noticia['imagem'] ?>" alt="<?= $noticia['titulo'] ?>">
                            </td>
                            <td class="text-center" style="vertical-align: middle;"> <?= $noticia['titulo'] ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?= $noticia['resumo'] ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?= $noticia['data_criacao'] ?></td>
                            <td class="text-center" style="vertical-align: middle;">
                                <small>
                                    <a class="text-decoration-none" href="../noticias/info.php?id=<?= $noticia['id'] ?>"> Ver Noticia </a>
                                </small>
                            </td>
                        </tr>

                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <h5 class="my-5 text-center text-secondary">Sessão de usuários</h5>

    <div class="card">
        <div class="card-header">Listagem de todos os Assinantes</div>
        <div class="card-body">
            <div class="d-flex gap-3 justify-content-end my-3">
                <a href="../noticias/todas.php" class="btn btn-sm btn-secondary text-white">Gerenciar notícias</a>
            </div>


            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td class="text-center">Nome</td>
                        <td class="text-center">E-mail</td>
                        <td class="text-center">CPF</td>
                        <td class="text-center">Endereço</td>                         
                        <td class="text-center">Cidade</td>                         
                        <td class="text-center">UF</td>                         
                        <td class="text-center"></td>                         
                    </tr>
                </thead>
                <tbody>
                    <?php foreach( $todos_usuarios as $usuario ): ?>

                        <tr>
                            <td class="text-center" style="vertical-align: middle;"> <?= $usuario['nome'] ?> </td>
                            <td class="text-center" style="vertical-align: middle;"> <?= $usuario['email'] ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?= $usuario['cpf'] ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?= $usuario['endereco'] ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?= $usuario['cidade'] ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?= $usuario['uf'] ?></td>
                            <td class="text-center" style="vertical-align: middle;">
                                <small class="me-2">
                                    <a style="font-size:12px" class="text-decoration-none " href="./perfil.php?id=<?= $usuario['id'] ?>"> Editar </a>
                                </small>
                                <small>
                                    <a style="font-size:12px" class="text-decoration-none btn btn-danger btn-sm" href="../noticias/info.php?id=<?= $usuario['id'] ?>"> Excluir </a>
                                </small>
                            </td>
                        </tr>

                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php 
    include '../Includes/layout-rodape.php'; 
?>
