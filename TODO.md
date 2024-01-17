# Passo à passo do desenvolvimento.

## Páginas

1. Página Principal:
    - botão para fazer login;
    - botão para se registrar;

2. Página de Registro:
    - formulário de registro;
    - botão de redirecionamento para login;
    - botão de redirecionamento para página principal;

3. Página de Login:
    - cpf;
    - senha;
    - botão de redirecionamento para a página principal;
    - botão de redirecionamento para registro;

4. Página inicial de usuários:
    - botão de redirecionamento para a dashboard;
    - botão de redirecionamento para editar o perfil;
    - conter as 3 notícias em destaque;
    - botão para mostrar todas as notícias;

5. Página de dashboard:
    - botão para cadastrar produtos;
    - listagem dos produtos *ativos*;

6. Página de produtos:
    - botão para criação de categorias;
    - botão para criação de produtos;
    - listagem de produtos criados com botões de ação como edição, exclusão e toggle[*ativar ou desativar*];

7. Página inicial de admin: 
    - botão de gerenciamento de usuários;
    - botão de gerenciamento de notícias;
    - conter as 3 notícias em destaque;
    - botão para mostrar todas as notícias;

8. Página de gerenciamento de usuários:
    - botão para adicionar um novo usuário;
    - listagem de todos os usuários com botão de exclusão;

9. Página de gerenciamento de notícias;
    - botão para adicionar uma nova notícia;
    - listagem de todas as notícias com botões de ação como edição e exclusão;

## - Tabela de Usuários

- [x] Text-> nome
- [x] Text->[unico]-> email 
- [x] Text->[unico] cpf
- [x] Text-> endereco
- [x] Text-> cidade
- [x] Text-> uf
- [x] Text-> senha
- [x] Bool-> adm


## - Tabela de Notícias

- [x] Text-> titulo
- [x] Data-> data
- [x] Text-> resumo
- [x] Text-> imagem
- [x] Text-> conteudo
- [x] Bool-> destaque
- [x] ForeignKey-> usuario_id


## - Tabela de Categorias

- [x] Text-> nome_categoria
- [x] Text->[unico] codigo_categoria
- [x] ForeignKey-> usuario_id


## - Tabela de Produtos

- [x] Text-> nome
- [x] Text->[unico] codigo
- [x] Bool-> status
- [x] Float-> valor
- [x] Integer-> quantidade
- [x] Text-> descricao
- [x] Text-> imagem
- [x] ForeignKey-> categoria_id
- [x] ForeignKey-> usuario_id

## - Usuario Admin

- e-mail: admin@internit.com.br
- senha: adm123


- primary color #315d7b
- second color #e2e8ed
- maybe: bg-body-tertiary