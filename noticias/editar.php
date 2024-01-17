<?php
    session_start();

    $title = "Editar Perfil";

    require '../Database/Conexao.php';
    require '../Class/UsuariosClass.php';
    require '../Class/NoticiasClass.php';
    
    include '../Includes/layout-cabecalho.php';

    if( !empty( $_SESSION['internit-login']) ){

        //id do usuário logado
        $id = $_SESSION['internit-login'];

        $usuarios_class = new Usuarios( $pdo );
        
        // Dados do usuário logado
        $usuario_logado = $usuarios_class->listar_por_id( $id );

        if( !empty( $_GET['id'] )){

            $noticias_class = new Noticias( $pdo );

            $id_noticia = $_GET['id'];
            $noticia = $noticias_class->listar_por_id( $id_noticia )->fetch();
        }

        if( !$usuario_logado['adm'] ){
            header( 'Location: ../usuario/painel.php' ); 
            
        }

        if( !empty( $_POST['atualizar_noticia'] )){

            $titulo = $_POST['titulo'] ;
            $resumo = $_POST['resumo'];
            $conteudo = $_POST['conteudo'];
            $imagem = $_FILES['imagem'];
            $data_criacao = $_POST['data_criacao'];
          
            $dados = array( 'titulo' => $titulo, 'resumo' => $resumo, 'conteudo' => $conteudo, 'imagem' => $imagem, 'data_criacao' => $data_criacao );
            $resultado = $noticias_class->atualizar_dados( $id_noticia, $dados );


            if( $resultado['sucesso'] ){
                header( 'Refresh: 0' );
                
            }  
        }


    }else {
        header( 'Location: ../login.php' ); 
        
    }

    if( !empty( $_POST['logout'] )){
        $usuarios = new Usuarios( $pdo );
        $usuarios->logout();
    
        header( 'Location: ../index.php' ); 
                
    }
?>

<?php require '../Components/MenuComponent.php' ?>


<div class="container m-auto">

    <h1 class="my-3 pb-3">Editar</h1>

    <?php require '../Components/FormEditarNoticiaComponent.php'; ?>

</div>


<?php 
    include '../Includes/layout-rodape.php'; 
?>