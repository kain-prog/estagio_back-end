<?php
    session_start();

    $title = "Registrar";

    require './Database/Conexao.php';
    require './Class/UsuariosClass.php';
    
    include './Includes/layout-cabecalho.php';

    if( !empty( $_SESSION['internit-login' ])){

        $id = $_SESSION['internit-login'];
        var_dump($id);

        $usuario_logado = new Usuarios( $pdo );
        $usuario_logado->listar_por_id( $id );

        if($usuario['adm']){
            header( 'Location: ./adm/painel.php' );
            exit;

        }else{
            header( 'Location: ./usuario/painel.php' );
            exit;
        }
    }

    if( !empty( $_POST['registrar']) ){

        $nome = $_POST['nome'] ;
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $endereco = $_POST['endereco'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];
        $senha_atual = $_POST['senha_atual'];
        $senha = $_POST['senha'] ;
        $confirmacao_senha = $_POST['confirmacao_senha'];

        $dados = array(  'nome' => $nome, 'cpf' => $cpf, 'email' => $email, 'endereco' => $endereco, 'cidade' => $cidade, 'uf' => $uf,
        'senha_atual' => $senha_atual, 'senha' => $senha, 'confirmacao_senha' => $confirmacao_senha );

        $usuario = new Usuarios( $pdo );
        $usuario->registrar( $dados );
    }

?>


<?php require './Components/MenuComponent.php' ?>

<div class="container pt-5 m-auto">

    <form method="POST" class="form-control shadow-sm m-auto pt-5 pb-3 px-4  bg-body-tertiary" style="max-width: 767px;">

        <div class="d-flex flex-column">
            <img src="./Assets/logo-internit.png" alt="Logo da empresa Internit" class="m-auto mb-4" />
            <p class="">Seja muito bem vindo!! </br>Faça o seu registro abaixo para ter os primeiros passos com a nossa plataforma.</p>
        </div>

        <div class="mb-3">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nome" style="box-shadow: none !important;" placeholder="Jonh Doe" required>
        </div>

        <div class="row ">

            <div class="mb-3 col-5">
                <label for="cpf">CPF:</label>
                <input type="tel" class="form-control" name="cpf" id="cpf" style="box-shadow: none !important;" placeholder="12345678901" maxlength="11" required>
            </div>

            
            <div class="mb-3 col">
                <label for="email">E-mail:</label>
                <input type="text" class="form-control" name="email" id="email" style="box-shadow: none !important;" placeholder="exemplo@exemplo.com" required>
            </div>

        </div>

        <div class="mb-3">
            <label for="endereco">Endereço:</label>
            <input type="text" class="form-control" name="endereco" id="endereco" style="box-shadow: none !important;" placeholder="Rua Sérgio Amado, 155" required>
        </div>
    
        
        <div class="row">
            <div class="mb-3 col">
                <label for="cidade">Cidade:</label>
                <input type="text" class="form-control" name="cidade" id="cidade" style="box-shadow: none !important;" placeholder="Niterói" required>
            </div>

            
            <div class="mb-3 col-3">
                <label for="uf">UF:</label>
                <input type="text" class="form-control" name="uf" id="uf" style="box-shadow: none !important;" placeholder="RJ" maxlength="2" required>
            </div>
        </div>

        
        <div class="mb-3">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" name="senha" id="senha" style="box-shadow: none !important;" placeholder="******" required>
        </div>

        <div class="mb-3">
            <label for="confirmacao_senha">Confirme a sua senha:</label>
            <input type="password" class="form-control" name="confirmacao_senha" id="confirmacao_senha" style="box-shadow: none !important;" placeholder="******" required>
        </div>


        <div class="mb-4">
            <input type="submit" class="btn w-100 py-3 text-white" name="registrar" value="Criar Conta" style="background-color: #315d7b" />
        </div>

        <hr />

        <p class="mt-2">
            Já foi registrado ? <a href="./login.php">clique aqui</a> para logar na nossa plataforma.
        </p>

    </form>

    <div class="d-flex justify-content-end w-100 m-auto mt-3 mb-5" style="max-width: 767px;">
        <a class="text-decoration-none" href="./index.php">Página inicial</a>
    </div>


</div>


<?php 
    include './Includes/layout-rodape.php'; 
?>
