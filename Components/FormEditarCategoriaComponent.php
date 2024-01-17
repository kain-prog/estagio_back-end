<form method="POST" class="form-control shadow-sm m-auto pt-4 pb-3 px-4  bg-body-tertiary" style="max-width: 767px;">
    
    <div class="d-flex gap-2 align-items-center mb-4 ">
        <img src="../Assets/logo-internit.png" alt="Logo da empresa Internit" class="mb-0" style="max-width: 30px" />
        <p class="mb-0">- Edite a categoria <?= $categoria['nome_categoria'] ?> abaixo:</p>
    </div>

    <div class="row align-items-center justify-content-between mb-5 gap-3">

        <div class="col-md-6">
            <label for="nome">Nome:</label>
            <input class="form-control" type="text" name="nome_categoria" id="nome" style="box-shadow: none !important;" required placeholder="Celular" value="<?= $categoria['nome_categoria'] ?>">
        </div>

        <div class="col-md-5">
            <label for="codigo_categoria">Código:</label>
            <input class="form-control" type="text" name="codigo_categoria" id="codigo_categoria" style="box-shadow: none !important;" required placeholder="CE22" value="<?= $categoria['codigo_categoria'] ?>">
        </div>

    </div>

    <div class="mb-4">
        <input type="submit" class="btn w-100 py-3 text-white" name="editar_categoria" value="Editar Produto" style="background-color: #315d7b" />
    </div>

</form>

<div class="container w-100 my-5 d-flex justify-content-end">
    <a class="text-decoration-none" href="../dashboard.php">Voltar para dasboard</a>
</div>