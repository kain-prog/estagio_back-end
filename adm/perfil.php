<?php
    session_start();

    $title = "Editar Perfil";

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

        if( !$usuario_logado['adm'] ) return header(' Location: ../usuario/painel.php ');


    }else {
        header( 'Location: ../login.php' );
        exit;
    }

    if( !empty( $_POST['logout'] )){
        $usuarios = new Usuarios( $pdo );
        $usuarios->logout();
    
        header('Location: ../index.php');
        exit;        
    }
?>

<?php require '../Components/MenuComponent.php' ?>


<div class="container m-auto">

    <h1 class="my-3 pb-3">Meu Perfil</h1>

    <?php require '../Components/FormEditarPerfilComponent.php'; ?>

</div>


<?php 
    include './Includes/layout-rodape.php'; 
?>