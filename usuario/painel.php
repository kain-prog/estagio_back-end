<?php
    session_start();

    $title = "Painel Usuário";

    require '../Database/Conexao.php';
    require '../Class/UsuariosClass.php';
    
    include '../Includes/layout-cabecalho.php';

    if( !empty( $_SESSION['internit-login'] ) ){

        $id = $_SESSION['internit-login'];

        $usuarios = new Usuarios( $pdo );
        $usuario_logado = $usuarios->listar_por_id( $id );

        if( $usuario_logado['adm'] ){
            header( 'Location: ../adm/painel.php' );
            exit;
        }
        
    }else{
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
        <div class="col-lg-4 mb-3 mb-md-0 mt-auto">
            <h2 class="">Painel de Assinantes</h2>
            <p class="">Olá, <?= $usuario_logado['nome'] ?>.  Bem vindo novamente.</p>
           
            <div class="mt-3 d-flex justify-content-between">
                <a href="#">Editar perfil</a>
           
            </div>
        </div>


        <div class="col-lg-8 d-flex flex-column gap-2 flex-wrap align-items-center align-items-lg-end">
                
            <p class="mb-1">Email: <?= $usuario_logado['email'] ?></p>
            <div class="d-flex gap-4 mb-1">
                <p>Cidade: <?= $usuario_logado['cidade'] ?></p>
                <p>UF: <?= $usuario_logado['uf'] ?></p>
            </div>
            <p class="mb-1">CPF: <?= $usuario_logado['cpf'] ?></p>

        </div>

    </div>

    <hr class="my-5" >

    <div class="row m-auto">

        <?php require('../Components/NoticiasComponent.php')  ?>

    </div>

</div>


<?php 
    include './Includes/layout-rodape.php'; 
?>
