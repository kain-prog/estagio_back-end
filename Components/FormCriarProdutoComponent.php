<form method="POST" enctype="multipart/form-data" class="form-control shadow-sm m-auto pt-4 pb-3 px-4  bg-body-tertiary" style="max-width: 767px;">
    
    <div class="d-flex gap-2 align-items-center mb-4 ">
        <img src="../Assets/logo-internit.png" alt="Logo da empresa Internit" class="mb-0" style="max-width: 30px" />
        <p class="mb-2">- Crie um novo produto abaixo:</p>
    </div>

    <div class="d-flex justify-content-start gap-2 mb-4">
        <p class="text-danger" style="font-weight: 600">OBS*</p>
        <small> Antes de criar um produto, você <strong>deve</strong> ter alguma categoria registrada. </small>
    </div>

    <div class="row align-items-center justify-content-between mb-3 gap-3">

        <div class="mb-3 mb-lg-0 col-md-5">
            <label for="imagem">Imagem:</label>
            <input type="file" name="imagem" id="imagem">
        </div>

    <div class="col-md-5">
            <label class="w-100" for="codigo">Código: </label>
            <input type="text" class="form-control" name="codigo" style="box-shadow: none !important;" id="codigo" required placeholder="X1234">
        </div>
    </div>


    <div class="row align-items-center justify-content-between mb-3 gap-3">

        <div class="col-md-6">
            <label for="nome">Nome:</label>
            <input class="form-control" type="text" name="nome" id="nome" style="box-shadow: none !important;" required placeholder="Celular">
        </div>

        <div class="col-md-5">
            <label for="categoria">Categoria:</label>
           
            <select class="form-select form-select" name="categoria" id="categoria" style="box-shadow: none !important;">
                
                <?php foreach ( $todas_categorias_usuario as $categoria): ?>
                    
                    <option value="<?= $categoria['categoria_id'] ?>"> <?= $categoria['nome_categoria'] ?> </option>
                
                <?php endforeach ?>
            
            </select>

        </div>

    </div>

    <div class="d-flex flex-column w-100 align-items-center mb-3">
        <label for="nome" class="w-100">Descrição:</label>
        <textarea class="w-100 form-control" name="descricao" id="descricao" cols="30" rows="3" style="box-shadow: none !important;" required placeholder="Faça a descrição do seu produto aqui"></textarea>

    </div>

    <div class="row align-items-center justify-content-between mb-5 gap-3">

        <div class="col-md-3">
            <label for="nome">Valor:</label>
            <input class="form-control" type="tel" name="valor" id="valor" style="box-shadow: none !important;" required placeholder="9.99" />
        </div>

        <div class="col-md-3">
            <label for="quantidade">Quantidade:</label>
            <input class="form-control" type="tel" name="quantidade" id="quantidade" style="box-shadow: none !important;" required placeholder="50">
        </div>

        <div class="col-md-5">
            <label class="w-100" for="situacao">Status:</label>
            <select class="form-select form-select" name="situacao" id="situacao" style="box-shadow: none !important;">
                <option value="0" selected>Desativado</option>
                <option value="1">Ativado</option>
            </select>
        </div>

    </div>


    <div class="mb-4">
        <input type="submit" class="btn w-100 py-3 text-white" name="criar_produto" value="Criar Produto" style="background-color: #315d7b" />
    </div>

</form>

<div class="container w-100 my-5 d-flex justify-content-end">
    <a class="text-decoration-none" href="../produtos/todos.php">Voltar para o gerenciamento de produtos</a>
</div>