<?php foreach( $produtos as $produto ):  ?>

    <div class="d-flex justify-content-end m-auto gap-3" style="max-width: 780px;">
        <a class="text-decoration-none" href="../produtos/editar.php?id=<?= $produto['id'] ?> ">Editar produto</a>
        <form method="POST">
            <input type="hidden" name="id" value=" <?= $produto['id'] ?>" >
            <input class="nav-link text-danger" type="submit" name="excluir_produto" value="Excluir" style="font-weight:700">
        </form>
    </div>

    <a href="../produtos/info.php?id=<?= $produto['id'] ?>" class="card mt-3 mb-5 m-auto text-decoration-none" style="max-width: 780px; transition: all ease 0.3s" onmouseover="this.style.scale = (1.02); this.style.background = '#e2e8ed';" onmouseout="this.style.scale = (1.0); this.style.background = 'none';">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="../<?= $produto['imagem'] ?>" class="h-100 img-fluid rounded-start object-fit-cover" alt="<?= $produto['nome'] ?>">
            </div>
            <div class="col-md-7">
            <div class="card-body w-100 pe-0 pt-0">
                <div class="row w-100 pe-0 m-0">
                    <h5 class="card-title col-8 pt-3 ps-0 pe-3"><?= $produto['nome'] ?></h5>
                    <form class="col-4 p-0 pt-3 pt-lg-0 d-flex align-items-start justify-content-end" method="POST">
                        
                        <?php if( $produto['situacao'] != 1 ){ ?>

                            <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                            <input class="btn btn-sm btn-outline-success" type="submit" name="ativar" value="Ativar Produto">

                        <?php } else { ?>

                            <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                            <input class="btn btn-sm btn-outline-danger" type="submit" name="ativar" value="Desativar Produto">

                        <?php } ?>

                    </form>
                </div>
                <p class="card-text pe-2"><?= $produto['descricao'] ?></p>

                <div class="d-flex justify-content-between pe-3">
                    <small>
                        <p class="mb-1">
                            <strong class="text-secondary">Categoria: </strong> 
                            <?= $produto['nome_categoria'] ?>
                        </p>
                    </small>

                    <small>
                        <p class="mb-1">
                            <strong class="text-secondary">Código: </strong> 
                            <?= $produto['codigo'] ?>
                        </p>
                    </small>
                </div>

                <small>
                        <p class="mb-1">
                            <strong class="text-secondary">Quantidade: </strong> 
                            <span class="text-primary" style="font-weight: 500; font-size: 18px"><?= $produto['quantidade'] ?></span>
                        </p>
                </small>

                <small>
                        <p class="d-flex align-items-center gap-3 mb-0">
                            <strong class="text-secondary">Preço: </strong> 
                            <span class="text-success" style="font-weight: 800; font-style:italic;  font-size: 28px"><?= $produto['valor'] ?></span>
                        </p>
                </small>

            </div>
            </div>
        </div>
    </a>

<?php endforeach ?>