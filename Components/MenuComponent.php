<?php

  if( !empty( $_SESSION['internit-login'] )){
    $id = $_SESSION['internit-login'];

    $usuario = new Usuarios( $pdo );
    $usuario_logado = $usuario->listar_por_id( $id );
  }

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
  <div class="container d-flex space-between">
    <a href="../index.php" class="navbar-brand">Internit</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">

        <?php if( !isset($_SESSION['internit-login']) ){  ?>

            <li class="nav-item">
                <a class="nav-link <?= $title === 'Login' ? "active" : "" ?>" aria-current="page" href="../login.php">Login</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $title === 'Registrar' ? "active" : "" ?>" href="../registrar.php">Registrar</a>
            </li>

        <?php }else{ ?>

            <?php if( !$usuario_logado['adm'] ){ ?>

              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../usuario/painel.php">Meu Painel</a>
              </li>
            
            <?php } else { ?>

              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../adm/painel.php">Meu Painel</a>
              </li>

            <?php } ?>

            <li class="nav-item">
                <form method="POST">
                  <input type="submit" name="logout" class="nav-link text-danger" value="Sair">
                </form>
            </li>

        <?php } ?>
      </ul>
    </div>
  </div>
</nav>