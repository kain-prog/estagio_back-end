<form method="POST" enctype="multipart/form-data" class="form-control shadow-sm m-auto pt-5 pb-3 px-4  bg-body-tertiary" style="max-width: 767px;">

    <div class="d-flex flex-column">
        <img src="../Assets/logo-internit.png" alt="Logo da empresa Internit" class="m-auto mb-2" />
        <p class="mb-3">Atualize a notícia <?= $noticia['titulo'] ?></p>
    </div>

    <div class="mb-3">
        <label for="titulo">Título:</label>
        <input type="text" class="form-control" name="titulo" id="titulo" style="box-shadow: none !important;" placeholder="Um novo titulo" value="<?= $noticia['titulo'] ?>" required>
    </div>


    <div class="mb-3">
        <label for="resumo">Resumo:</label>
        <input type="text" class="form-control" name="resumo" id="resumo" style="box-shadow: none !important;" placeholder="Resumo da notícia" value="<?= $noticia['resumo'] ?>" required>
    </div>

    <div class="mb-3">
        <label class="w-100" for="conteudo">Conteúdo:</label>
        <textarea class="form-control" name="conteudo" id="conteudo" cols="30" rows="10" style="box-shadow: none !important;" placeholder="Conteúdo da notícia" required><?= $noticia['conteudo'] ?></textarea>
    </div>

    <div class="row align-items-center mb-3">

        <div class="mb-3 mb-lg-0 col order-2 order-lg-0">
            <label for="imagem">Imagem:</label>
            <input type="file" name="imagem" id="imagem">
        </div>

        
        <div class="mb-4 mb-lg-3 col-4">
            <label for="data_criacao">Data de criação:</label>
            <input type="text" class="form-control" name="data_criacao" id="data_criacao" style="box-shadow: none !important;" placeholder="17/01/2024" value="<?= $noticia['data_criacao'] ?>" required>
        </div>
    </div>

    <div class="mb-4">
        <input type="submit" class="btn w-100 py-3 text-white" name="atualizar_noticia" value="Editar Notícia" style="background-color: #315d7b" />
    </div>

</form>

<?php if( $usuario_logado['adm'] ){ ?>

<div class="container w-100 my-5 d-flex justify-content-end">
    <a class="text-decoration-none" href="../noticias/todas.php">Voltar para o gerenciamento de notícias</a>
</div>

<?php } else { ?>

<div class="container w-100 my-5 d-flex justify-content-end">
    <a class="text-decoration-none" href="../noticias/todas.php">Voltar para todas as notícias</a>
</div>

<?php } ?>