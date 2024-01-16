<style>
    .todas-noticias{
        width: 525px;
        height: 170px;
        min-height: 170px;
    }
    .imagem-noticias{
        width: 100%;
    }
    @media(max-width: 991px){
        .todas-noticias{
            height: 100%;
            width: 100%;
        }
    }
</style>

<div class="row gap-3 justify-content-center container m-auto">
    <?php foreach( $noticias as $noticia ): ?>

    <a href="../noticias/info.php?id=<?= $noticia['id'] ?>" class="card txt-decoration-none todas-noticias text-decoration-none" style="transition: all ease 0.3s" onmouseover="this.style.scale = (1.02); this.style.background = '#e2e8ed';" onmouseout="this.style.scale = (1.0); this.style.background = 'none';" >
        <div class="row h-100">
            <div class="col-md-4 h-100">
                <img src="../<?= $noticia['imagem'] ?>" class="h-100 rounded-start text-center imagem-noticias" alt="<?= $noticia['titulo'] ?>" style="object-fit: cover; object-position: left;">
            </div>
            <div class="col-md-8 h-100">
                <div class="card-body px-0 h-100">

                    <div class="d-flex justify-content-between">
                        <h5 class="card-title"><?= $noticia['titulo'] ?></h5>

                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $noticia['id'] ?>">
                            
                            <?php if( $usuario_logado['adm'] ): ?>

                                <?php if( $noticia['destaque'] ){ ?>

                                    <input class="btn btn-sm text-white" name="destacar" type="submit" value="Remover Destaque" style="font-size: 10px; background: #315d7b">

                                <?php }else { ?>

                                    <input class="btn btn-primary btn-sm" name="destacar" type="submit" value="Destacar" style="font-size: 10px;">

                                <?php } ?>

                            <?php endif ?>

                        </form>

                    </div>

                    <p class="card-text"><?= $noticia['resumo'] ?></p>
                    <p class="card-text"><small class="text-body-secondary"> <?= $noticia['data_criacao'] ?> </small></p>

                    <div class="d-flex py-3 py-lg-0 justify-content-end gap-2">
                    <?php if( $usuario_logado['adm'] ): ?>
                        <form method="GET">
                            <input type="hidden" name="id" value="<?= $noticia['id'] ?>">
                            <input class="btn btn-secondary btn-sm" type="submit" name="editar" value="Editar">
                        </form>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $noticia['id'] ?>">
                            <input class="btn btn-danger btn-sm" name="apagar" type="submit" value="Apagar">
                        </form>
                    <?php endif ?>
                </div>

                </div>

                

            </div>
        </div>
        
    </a>
    <?php endforeach ?>
</div>
