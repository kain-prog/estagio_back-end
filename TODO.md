# Passo à passo do desenvolvimento.

## Páginas

1. - Página Principal:
    - botão para fazer login;
    - botão para se registrar;

2. - Página de Registro
    - formulário de registro;
    - botão de redirecionamento para login;
    - botão de redirecionamento para página principal;

3. - Página de Login:
    - cpf;
    - senha;
    - botão de redirecionamento para a página principal;
    - botão de redirecionamento para registro;

4. - Página inicial de usuários:
    - botão de redirecionamento para a dashboard;
    - botão de redirecionamento para editar o perfil;
    - conter as 3 notícias em destaque;
    - botão para mostrar todas as notícias;

5. - Página de dashboard:
    - botão para cadastrar produtos;
    - listagem dos produtos com seus respectivos status;

6. - Página de produtos:
    - botão para criação de categorias;
    - botão para criação de produtos;
    - listagem de produtos criados com botões de ação como edição e exclusão;

7. - Página inicial de admin: 
    - botão de gerenciamento de usuários;
    - botão de gerenciamento de notícias;
    - conter as 3 notícias em destaque;
    - botão para mostrar todas as notícias;

8. - Página de gerenciamento de usuários:
    - botão para adicionar um novo usuário;
    - listagem de todos os usuários com botão de exclusão;

9. - Pagina de gerenciamento de notícias;
    - botão para adicionar uma nova notícia;
    - listagem de todas as notícias com botões de ação como edição e exclusão;

## - Tabela de Usuários

- [ ] Text-> nome
- [ ] Text->[unico]-> email 
- [ ] Text->[unico] cpf
- [ ] Text-> endereco
- [ ] Text-> cidade
- [ ] Text-> uf
- [ ] Text-> senha
- [ ] Bool-> admin


## - Tabela de Notícias

- [ ] Text-> titulo
- [ ] Data-> data
- [ ] Text-> resumo
- [ ] Text-> imagem
- [ ] Text-> conteudo
- [ ] Bool-> destaque
- [ ] ForeignKey-> usuario_id


## - Tabela de Categorias

- [ ] Text-> nome
- [ ] Text->[unico] codigo
- [ ] ForeignKey-> usuario_id


## - Tabela de Produtos

- [ ] Text-> nome
- [ ] Text-> codigo
- [ ] Text-> status
- [ ] Float-> valor
- [ ] Integer-> quantidade
- [ ] Text-> descricao
- [ ] Text-> imagem
- [ ] ForeignKey-> categoria_id
- [ ] ForeignKey-> usuario_id