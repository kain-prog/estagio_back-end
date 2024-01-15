<div class="my-5">
    <h1 class="text-center"> <?= $noticia['titulo'] ?> </h1>
    <p class="text-center"> <?= $noticia['resumo'] ?> </p>
</div>

<div class="m-auto d-flex flex-column mb-3" style="max-width: 750px;">
    <img class="my-3 m-auto" src="../<?= $noticia['imagem'] ?>" alt="" style="max-width: 450px;" >
    <p class="w-100 text-end card-text"><small class="text-body-secondary"> <?= $noticia['data_criacao'] ?> </small></p>
</div>

<div class="m-auto w-100" style="max-width: 750px;">
    <p><?= $noticia['conteudo'] ?></p>
</div>

<div class="container w-100 d-flex justify-content-end">
    <a class="text-decoration-none" href="../noticias/todas.php">Voltar para todas as notícias</a>
</div>