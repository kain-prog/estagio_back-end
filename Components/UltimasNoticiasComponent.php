<style>
    .image-thumb{
        object-fit: cover;
        object-position: left;
    }
</style>

<div class="carousel owl-carousel owl-loaded owl-drag ">
    <div class="owl-stage-outer">
        <div class="owl-stage d-flex" style="transform: translate3d(-4640px, 0px, 0px); transition: all 0.75s ease 0s; width: 8894px;">
           
            <?php foreach( $noticias_destaque as $noticia ): ?>

                <div class="owl-item px-3 px-lg-0" style="max-width: 548px; min-height: 160px;">
                    <a href="../noticias/info.php?id=<?= $noticia['id'] ?>" class="card h-100 text-decoration-none" style="min-height: 215px; transition: all ease 0.3s" onmouseover="this.style.scale = (1.02); this.style.background = '#e2e8ed';" onmouseout="this.style.scale = (1.0); this.style.background = 'none';" >
                        <div class="row g-0 h-100">
                            <div class="col-md-4">
                                <img src="../<?= $noticia['imagem'] ?>" class="image-thumb h-100 rounded-start text-center w-100" alt="<?= $noticia['titulo'] ?>" style="">
                            </div>
                            <div class="col-md-8 h-100">
                                <div class="card-body h-100">
                                    <h5 class="card-title"><?= $noticia['titulo'] ?></h5>
                                    <p class="card-text"><?= $noticia['resumo'] ?></p>
                                    <p class="card-text"><small class="text-body-secondary"> <?= $noticia['data_criacao'] ?> </small></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            <?php endforeach ?>

        </div>
    </div>
    <div class="owl-nav disabled">
    </div>
</div>