<?php
    session_start();

    $title = "Painel Usuário";

    require '../Database/Conexao.php';
    require '../Class/UsuariosClass.php';
    require '../Class/NoticiasClass.php';
    
    include '../Includes/layout-cabecalho.php';

    if( !empty( $_SESSION['internit-login'] ) ){

        $id = $_SESSION['internit-login'];

        $usuarios_class = new Usuarios( $pdo );
        $usuario_logado = $usuarios_class->listar_por_id( $id );

        $noticias_class = new Noticias( $pdo );
        // Todas Noticias
        $quantidade_noticias = $noticias_class->todas_noticias()->rowCount();
        // Noticias em Destaque
        $quantidade_noticias_destaque = $noticias_class->noticias_em_destaque()->rowCount();;
        $noticias_destaque = $noticias_class->noticias_em_destaque()->fetchAll();

        if( $usuario_logado['adm'] ){
            header( 'Location: ../adm/painel.php' );
            
        }
        
    }else{
        header( 'Location: ../login.php' );
        
    }

    if( !empty( $_POST['logout'] )){
        $usuarios = new Usuarios( $pdo );
        $usuarios->logout();
    
        header( 'Location: ../index.php' );
                
    }

    if( !empty( $_POST['ver_noticias'] )){
        header( 'Location: ../noticias/todas.php' );
              
    }
?>

<?php require '../Components/MenuComponent.php' ?>

<div class="container pt-5 m-auto">

<div class="mb-5 row justify-content-center justify-content-lg-start">
        <div class="col-lg-4 mb-3 mb-md-0 flex-column w-auto">
            <h2>Painel de Assinantes</h2>
            <p>Olá, <?= $usuario_logado['nome'] ?>.  Bem vindo novamente.</p>
        </div>

        <div class="col-lg-8 d-flex flex-wrap justify-content-center align-items-center justify-content-lg-end">
                
            <div class="w-auto">
                <div class="mt-3 w-100 d-flex justify-content-between align-items-center">

                    <h5 class="text-secondary opacity-75"><?= $usuario_logado['nome'] ?></h5>

                    <small><a class="text-decoration-none" href="./perfil.php">Editar perfil</a></small>

                </div>

                <p class="mb-1 text-secondary opacity-75">Email: <?= $usuario_logado['email'] ?></p>
               
                <div class="d-flex mb-1" style="gap: 3.8rem">
                    <p class="mb-0 text-secondary opacity-75">Cidade: <?= $usuario_logado['cidade'] ?></p>
                    <p class="mb-0 text-secondary opacity-75">UF: <?= $usuario_logado['uf'] ?></p>
                </div>

                <p class="mb-5 text-secondary opacity-75">CPF: <?= $usuario_logado['cpf'] ?></p>

                <a class="btn text-white w-100" href="../dashboard.php" style="background: #315d7b">Ir para Dashboard</a>
            </div>

        </div>

    </div>

    <hr class="my-5" >

</div>

<div class="container m-auto">
    <h6 class="mb-3">Confira as últimas notícias: </h6>
</div>

<?php require '../Components/UltimasNoticiasComponent.php' ?>

<div class="container w-100 d-flex justify-content-end">
    <form method="POST">
        <input class="nav-link text-primary" type="submit" name="ver_noticias" value="Veja mais notícias">
    </form>
</div>


<?php 
    include '../Includes/layout-rodape.php'; 
?>
