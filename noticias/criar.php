<?php

    session_start();

    $title = "Criar Notícia";

    require '../Database/Conexao.php';
    require '../Class/UsuariosClass.php';
    require '../Class/NoticiasClass.php';
    
    if( !empty( $_SESSION['internit-login']) ){

        $id = $_SESSION['internit-login'];

        $usuarios_class = new Usuarios( $pdo );
        $usuario_logado = $usuarios_class->listar_por_id( $id );

        if( !$usuario_logado['adm'] ) {
            header( 'Location: ../usuario/painel.php' );

        }


    }else {
        header( 'Location: ../login.php' );
    }

    if( !empty( $_POST['logout'] )){
        $usuarios = new Usuarios( $pdo );
        $usuarios->logout();
    
        header( 'Location: ../index.php' );        
    }

    if( !empty( $_POST['criar_noticia'] )){

        $titulo = $_POST['titulo'];
        $resumo = $_POST['resumo'];
        $conteudo = $_POST['conteudo'];
        $imagem = $_FILES['imagem'];
        $data_criacao = $_POST['data_criacao'];

        $dados = array( 'titulo' => $titulo, 'resumo' => $resumo, 'conteudo' => $conteudo, 'imagem' => $imagem, 'data_criacao' => $data_criacao );

        $noticias = new Noticias( $pdo );
        $retorno = $noticias->criar_noticia( $dados, $id );

        if( $retorno['sucesso'] ){
            header('Refresh: 0');

        }

    }

    include '../Includes/layout-cabecalho.php';
?>

<?php require '../Components/MenuComponent.php' ?>

<div class="container m-auto">

    <div class="my-4">
        <h3>Nova Notícia</h3>
    </div>

    <form method="POST" enctype="multipart/form-data" class="form-control shadow-sm m-auto pt-5 pb-3 px-4  bg-body-tertiary" style="max-width: 767px;">

        <div class="d-flex flex-column">
            <img src="../Assets/logo-internit.png" alt="Logo da empresa Internit" class="m-auto mb-2" />
            <p class="mb-3">Cadastre uma nova notícia.</p>
        </div>

        <div class="mb-3">
            <label for="titulo">Título:</label>
            <input type="text" class="form-control" name="titulo" id="titulo" style="box-shadow: none !important;" placeholder="Um novo titulo" required>
        </div>


        <div class="mb-3">
            <label for="resumo">Resumo:</label>
            <input type="text" class="form-control" name="resumo" id="resumo" style="box-shadow: none !important;" placeholder="Resumo da notícia" required>
        </div>
    
        <div class="mb-3">
            <label class="w-100" for="conteudo">Conteúdo:</label>
            <textarea class="form-control" name="conteudo" id="conteudo" cols="30" rows="10" style="box-shadow: none !important;" placeholder="Conteúdo da notícia" required></textarea>
        </div>
        
        <div class="row align-items-center mb-3">

            <div class="mb-3 mb-lg-0 col order-2 order-lg-0">
                <label for="imagem">Imagem:</label>
                <input type="file" name="imagem" id="imagem">
            </div>

            
            <div class="mb-4 mb-lg-3 col-4">
                <label for="data_criacao">Data de criação:</label>
                <input type="text" class="form-control" name="data_criacao" id="data_criacao" style="box-shadow: none !important;" placeholder="17/01/2024" required>
            </div>
        </div>

        <div class="mb-4">
            <input type="submit" class="btn w-100 py-3 text-white" name="criar_noticia" value="Criar Notícia" style="background-color: #315d7b" />
        </div>

    </form>

    <?php if( $usuario_logado['adm']){  ?>

        <div class="d-flex justify-content-end w-100 m-auto mt-3 mb-5" style="max-width: 767px;">
            <a class="text-decoration-none" href="../noticias/todas.php">gerenciamento de notícias</a>
        </div>

    <?php } else { ?>

        <div class="d-flex justify-content-end w-100 m-auto mt-3 mb-5" style="max-width: 767px;">
            <a class="text-decoration-none" href="../noticias/todas.php">Ver todas as notícias</a>
        </div>

    <?php } ?>

</div>


<?php 
    include '../Includes/layout-rodape.php'; 
?>