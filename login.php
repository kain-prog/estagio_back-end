<?php
    session_start();
    $title = "Login";

    require './Database/Conexao.php';
    require './Class/UsuariosClass.php';
    
    if( !empty($_SESSION['internit-login']) ){

        $id = $_SESSION['internit-login'];

        $usuario_logado = new Usuarios($pdo);
        $usuario_logado->listar_por_id( $id );

        if( $usuario['adm'] ){
            header( 'Location: ./adm/painel.php' );
            exit;

        }else{
            header( 'Location: ./usuario/painel.php' );
            exit;
        }
    }
    
    include './Includes/layout-cabecalho.php';

    if( !empty($_POST['login']) ){

        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);

        $usuarios = new Usuarios($pdo);
        $usuarios->login( $email, $senha );
    }

    if( !empty($_POST['logout'])){
        $usuarios = new Usuarios( $pdo );
        $usuarios->logout();
    
        header('Location: ../index.php');
        exit;        
    }
?>


<?php require './Components/MenuComponent.php' ?>

<div class="container pt-5 m-auto">

    <form method="POST" class="form-control shadow-sm m-auto py-5 bg-body-tertiary" style="max-width: 567px;">

        <div class="d-flex flex-column">
            <img src="./Assets/logo-internit.png" alt="Logo da empresa Internit" class="m-auto mb-4" />
            <p class="">Seja muito bem vindo!! </br>Faça o login abaixo para acessar a nossa plataforma.</p>
        </div>

        <div class="mb-3">
            <label for="email">E-mail:</label>
            <input type="text" class="form-control" name="email" id="email" style="box-shadow: none !important;" placeholder="exemplo@exemplo.com" required>
        </div>

        <div class="mb-3">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" name="senha" id="senha" style="box-shadow: none !important;" placeholder="*****" required>
        </div>

        <div class="mb-3">
            <input type="submit" class="btn w-100 py-3 text-white" name="login" style="background-color: #315d7b" value="Login">  
        </div>

        <hr />

        <p>
            Ainda não fez o cadastro? <a href="./registrar.php">clique aqui</a>
        </p>

    </form>

    <div class="d-flex justify-content-end w-100 m-auto mt-3" style="max-width: 567px;">
        <a class="text-decoration-none" href="./index.php">Página inicial</a>
    </div>

</div>


<?php 
    include './Includes/layout-rodape.php'; 
?>
