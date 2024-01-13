
<form method="POST" class="form-control shadow-sm m-auto pt-4 pb-3 px-4  bg-body-tertiary" style="max-width: 100%">

    <div class="d-flex gap-2 align-items-center mb-4 ">
        <img src="../Assets/logo-internit.png" alt="Logo da empresa Internit" class="mb-0" style="max-width: 30px" />
        <p class="mb-0">- Atualize as suas informações abaixo:</p>
    </div>

    <div class="mb-3">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" name="nome" id="nome" style="box-shadow: none !important;" placeholder="Jonh Doe" required value="<?= $usuario_logado['nome'] ?>">
    </div>

    <div class="row ">

        <div class="mb-3 col-5">
            <label for="cpf">CPF:</label>
            <input type="tel" class="form-control" name="cpf" id="cpf" style="box-shadow: none !important;" placeholder="12345678901" required value="<?= $usuario_logado['cpf'] ?>">
        </div>

        
        <div class="mb-3 col">
            <label for="email">E-mail:</label>
            <input type="text" class="form-control" name="email" id="email" style="box-shadow: none !important;" placeholder="exemplo@exemplo.com" required value="<?= $usuario_logado['email'] ?>">
        </div>

    </div>

    <div class="mb-3">
        <label for="endereco">Endereço:</label>
        <input type="text" class="form-control" name="endereco" id="endereco" style="box-shadow: none !important;" placeholder="Rua Sérgio Amado, 155" required value="<?= $usuario_logado['endereco'] ?>">
    </div>

    
    <div class="row">
        <div class="mb-3 col">
            <label for="cidade">Cidade:</label>
            <input type="text" class="form-control" name="cidade" id="cidade" style="box-shadow: none !important;" placeholder="Niterói" required value="<?= $usuario_logado['cidade'] ?>" >
        </div>

        
        <div class="mb-3 col-3">
            <label for="uf">UF:</label>
            <input type="text" class="form-control" name="uf" id="uf" style="box-shadow: none !important;" placeholder="RJ" required value="<?= $usuario_logado['uf'] ?>" >
        </div>
    </div>

    <div class="mb-3">
        <label for="senha">Senha atual:</label>
        <input type="password" class="form-control" name="senha_atual" id="senha" style="box-shadow: none !important;" placeholder="******" value="<?= $usuario_logado['senha'] ?>" >
    </div>

    <div class="mb-3">
        <label for="senha">Nova Senha:</label>
        <input type="password" class="form-control" name="senha" id="senha" style="box-shadow: none !important;" placeholder="******">
    </div>

    <div class="mb-3">
        <label for="confirmacao_senha">Confirme a sua nova senha:</label>
        <input type="password" class="form-control" name="confirmacao_senha" id="confirmacao_senha" style="box-shadow: none !important;" placeholder="******">
    </div>


    <div class="mb-4">
        <button type="submit" class="btn w-100 py-3 text-white" name="atualizar" style="background-color: #315d7b"> Atualizar Dados </button>
    </div>

</form>

<div class="d-flex justify-content-end w-100 m-auto mt-3" style="max-width: 100%;">
    <a href="./painel.php">Voltar para o painel</a>
</div>

