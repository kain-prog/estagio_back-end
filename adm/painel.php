<?php
    session_start();

    $title = "Painel Admin";

    require '../Database/Conexao.php';
    require '../Class/UsuariosClass.php';
    
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
                <div class="card-header text-white" style="border-bottom: none !important;"> Total de Notícias</div>
                <div class="card-body text-white d-flex align-items-center justify-content-center">
                    <h2 class="fs-1 fw-normal fst-italic">4</h2>
                </div>
            </div>
            
        </div>

    </div>


    <div class="card">
        <div class="card-header">Notícias em Destaque</div>
        <div class="card-body">

            <div class="d-flex gap-3 justify-content-end my-3">
                <a href="#" class="btn btn-sm text-white" style="background: #315d7b">Nova notícia</a>
                <a href="#" class="btn btn-sm btn-secondary text-white">Gerenciar notícias</a>
            </div>


            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td class="text-center">Imagem</td>
                        <td class="text-center">Título</td>
                        <td class="text-center">Resumo</td>
                        <td class="text-center">Conteúdo</td>
                        <td class="text-center">Data</td>                         
                        <td class="text-center">Ações</td>                         
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-footer py-2 d-flex justify-content-end px-4">
            <a href="../noticias/todas.php" class="text-decoration-none">Todas as notícias</a>
        </div>
    </div>



</div>


<?php 
    include '../Includes/layout-rodape.php'; 
?>
