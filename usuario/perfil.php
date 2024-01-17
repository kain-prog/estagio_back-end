<?php
    session_start();

    $title = "Editar Perfil";

    require '../Database/Conexao.php';
    require '../Class/UsuariosClass.php';
    
    include '../Includes/layout-cabecalho.php';

    if( !empty( $_SESSION['internit-login']) ){

        //id do usuário logado
        $id = $_SESSION['internit-login'];

        $usuarios_class = new Usuarios( $pdo );

        // Dados do usuário logado
        $usuario_logado = $usuarios_class->listar_por_id( $id );
        $usuario_input = $usuario_logado;

        if( $usuario_logado['adm'] ) {
            header( 'Location: ../adm/perfil.php' ); 
            
        }

    }else {
        header( 'Location: ../login.php' ); 
        
    }

    if( !empty( $_POST['logout'] )){
        $usuarios = new Usuarios( $pdo );
        $usuarios->logout();
    
        header( 'Location: ../index.php' ); 
                
    }

    if( isset( $_POST['atualizar'] )){

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

        $usuarios = new Usuarios( $pdo );
        $retorno = $usuarios->atualizar_dados( $id, $dados );

        if( $retorno['sucesso'] ){
            header('Refresh: 0');
            
        }
    }
?>

<?php require '../Components/MenuComponent.php' ?>


<div class="container m-auto">

    <h1 class="my-3 pb-3">Meu Perfil</h1>

    <?php require '../Components/FormEditarPerfilComponent.php' ?>

</div>


<?php 
    include '../Includes/layout-rodape.php'; 
?>