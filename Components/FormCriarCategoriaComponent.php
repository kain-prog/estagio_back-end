<form method="POST" class="form-control shadow-sm m-auto pt-4 pb-3 px-4  bg-body-tertiary" style="max-width: 767px;">
    
    <div class="d-flex gap-2 align-items-center mb-4 ">
        <img src="../Assets/logo-internit.png" alt="Logo da empresa Internit" class="mb-0" style="max-width: 30px" />
        <p class="mb-0">- Crie uma nova categoria abaixo:</p>
    </div>

    <div class="row align-items-center justify-content-between mb-5 gap-3">

        <div class="col-md-6">
            <label for="nome">Nome:</label>
            <input class="form-control" type="text" name="nome_categoria" id="nome" style="box-shadow: none !important;" required placeholder="Celular">
        </div>

        <div class="col-md-5">
            <label for="codigo_categoria">Código:</label>
            <input class="form-control" type="text" name="codigo_categoria" id="codigo_categoria" style="box-shadow: none !important;" required placeholder="CE22" >
        </div>

    </div>

    <div class="mb-4">
        <input type="submit" class="btn w-100 py-3 text-white" name="criar_categoria" value="Criar Categoria" style="background-color: #315d7b" />
    </div>

</form>

<div class="container w-100 my-5 d-flex justify-content-end">
    <a class="text-decoration-none" href="../dashboard.php">Voltar para dasboard</a>
</div>