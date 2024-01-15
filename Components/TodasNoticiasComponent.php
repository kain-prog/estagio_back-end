<style>
    .todas-noticias{
        width: 560px;
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

<div class="row gap-4 container m-auto">
    <?php foreach( $noticias as $noticia ): ?>

    <a href="../noticias/info.php?id=<?= $noticia['id'] ?>" class="card txt-decoration-none todas-noticias text-decoration-none" style="transition: all ease 0.3s" onmouseover="this.style.scale = (1.02); this.style.background = '#e2e8ed';" onmouseout="this.style.scale = (1.0); this.style.background = 'none';" >
        <div class="row h-100">
            <div class="col-md-4 h-100">
                <img src="../<?= $noticia['imagem'] ?>" class="h-100 rounded-start text-center imagem-noticias" alt="<?= $noticia['titulo'] ?>" style="">
            </div>
            <div class="col-md-8 h-100">
                <div class="card-body">
                    <h5 class="card-title"><?= $noticia['titulo'] ?></h5>
                    <p class="card-text"><?= $noticia['resumo'] ?></p>
                    <p class="card-text"><small class="text-body-secondary"> <?= $noticia['data_criacao'] ?> </small></p>
                </div>
            </div>
        </div>
    </a>

    <?php endforeach ?>
</div>
