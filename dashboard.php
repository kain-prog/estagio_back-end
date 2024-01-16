<?php

    session_start();

    $title = "Dashboard";

    require './Database/Conexao.php';
    require './Class/UsuariosClass.php';
    
    include './Includes/layout-cabecalho.php';

    if( !empty( $_SESSION['internit-login'] ) ){
        
        $id = $_SESSION['internit-login'];

        $usuarios_class = new Usuarios( $pdo );
        $usuario_logado = $usuarios_class->listar_por_id( $id );

        if( $usuario_logado['adm'] ) {
            header( 'Location: ./adm/painel.php' );
        }

        // listagem de produtos

        
    }else{
        header( 'Location: ./login.php' );
        exit;
    }

    if( !empty( $_POST['logout'] )){
        $usuarios = new Usuarios( $pdo );
        $usuarios->logout();
    
        header( 'Location: ./index.php' );
        exit;        
    }
?>

<?php require './Components/MenuComponent.php' ?>


<div class="container m-auto">
    <div class="my-5">
        
        <div class="row">
            <div class="col mb-4">
                <h1 class="text-center text-lg-start">Dashboard</h1>
            </div>

            <div class="col-lg d-flex gap-2 flex-wrap justify-content-center justify-content-lg-end mb-4">

                <div class="card text-bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header" style="border-bottom: none !important;">Produtos Ativos</div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <h2 class="fs-1 fw-normal text-center fst-italic"> <?= $quantidade_usuarios ?></h2>
                    </div>
                </div>

                <div class="card mb-3" style="max-width: 18rem; background: #315d7b">
                    <div class="card-header text-white" style="border-bottom: none !important;">Produtos Cadastrados</div>
                    <div class="card-body text-white d-flex align-items-center justify-content-center">
                        <h2 class="fs-1 fw-normal fst-italic">4</h2>
                    </div>
                </div>
            </div>

        </div>


        <div class="card">

            <div class="card-header">
                <h6 class="mb-0">Produtos Ativos</h6>
            </div>

            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td class="text-center">Imagem</td>
                            <td class="text-center">Nome</td>
                            <td class="text-center">Quantidade</td>
                            <td class="text-center">Valor</td>                      
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

        </div>

    </div>

</div>


<?php include './Includes/layout-rodape.php' ?>