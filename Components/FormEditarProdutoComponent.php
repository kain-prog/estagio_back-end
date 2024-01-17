<form method="POST" enctype="multipart/form-data" class="form-control shadow-sm m-auto pt-5 pb-3 px-4  bg-body-tertiary" style="max-width: 767px;">
    
    <input type="hidden" name="codigo_categoria" value="<?= $produto['codigo_categoria'] ?>" >
    <div class="d-flex gap-2 align-items-center mb-4 ">
        <img src="../Assets/logo-internit.png" alt="Logo da empresa Internit" class="mb-0" style="max-width: 30px" />
        <p class="mb-0">- Atualize as informações do produto abaixo:</p>
    </div>



    <div class="row align-items-center justify-content-between mb-3 gap-3">

        <div class="mb-3 mb-lg-0 col-md-5">
            <label for="imagem">Imagem:</label>
            <input type="file" name="imagem" id="imagem">
        </div>

        <div class="col-md-5">
            <p class="mb-0">Código:</p>
            <div class="input-group">
                <label class="input-group-text" for="codigo"><small><?= $produto['codigo_categoria'] ?></small></label>
                <input type="text" class="form-control" name="codigo" style="box-shadow: none !important;" id="codigo" value="<?= substr($produto['codigo'], 3) ?>">
            </div>
        </div>
    </div>


    <div class="row align-items-center justify-content-between mb-3 gap-3">

        <div class="col-md-6">
            <label for="nome">Nome:</label>
            <input class="form-control" type="text" name="nome" id="nome" value="<?= $produto['nome'] ?>" style="box-shadow: none !important;">
        </div>

        <div class="col-md-5">
            <label for="categoria">Categoria:</label>
            <input class="form-control disabled" disabled type="text" id="categoria" value="<?= $produto['nome_categoria'] ?>" style="box-shadow: none !important;">
        </div>

    </div>

    <div class="d-flex flex-column w-100 align-items-center mb-3">
        <label for="nome" class="w-100">Descrição:</label>
        <textarea class="w-100 form-control" name="descricao" id="descricao" cols="30" rows="3" style="box-shadow: none !important;"><?= $produto['descricao'] ?></textarea>

    </div>

    <div class="row align-items-center justify-content-between mb-5 gap-3">

        <div class="col-md-3">
            <label for="nome">Valor:</label>
            <input class="form-control" type="tel" name="valor" id="valor" value="<?= $produto['valor'] ?>" style="box-shadow: none !important;" />
        </div>

        <div class="col-md-3">
            <label for="quantidade">Quantidade:</label>
            <input class="form-control" type="tel" name="quantidade" id="quantidade" value="<?= $produto['quantidade'] ?>" style="box-shadow: none !important;">
        </div>

        <div class="col-md-5">
            <label class="w-100" for="situacao">Status:</label>
            <select class="form-select form-select" name="situacao" id="situacao" style="box-shadow: none !important;">

                <?php if( $produto['situacao'] != 0 ){ ?>

                    <option value="0"> Desativado </option>
                    <option value="1" selected>Ativado</option>

                <?php } else { ?>

                    <option value="0" selected>Desativado</option>
                    <option value="1">Ativado</option>

                <?php } ?>
            </select>
        </div>

    </div>


    <div class="mb-4">
        <input type="submit" class="btn w-100 py-3 text-white" name="atualizar_produto" value="Editar Produto" style="background-color: #315d7b" />
    </div>

</form>

<div class="container w-100 my-5 d-flex justify-content-end">
    <a class="text-decoration-none" href="../produtos/todos.php">Voltar para o gerenciamento de produtos</a>
</div>