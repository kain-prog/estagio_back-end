#### Projeto finalizado dia 17/01 às 03h16.

**OBS** - Projeto finalizado em PHP. Nenhum framework, lib ou estrutura foi usada a fins de backend neste projeto. Apenas php puro, sem acesso à inteligência artifical, apenas com documentação do php em mãos.

*IMPORTANTE* - A conexào no banco de dados default é MySQL 
*Necessário ter XAMPP - Apache ou PHP CLI para rodar o projeto*

- Para a melhor experiência do usuário, utilize este projeto com acesso a internet.

<hr>

## Primeiros passos:

1. Banco de dados: 

    > Procure *Query* no seu banco de dados e insira o script que já deixei pronto no arquivo script.sql .Você encontra os scripts no seguinte diretório:

    - Database > script.sql;
    **É de suma importância ter rodado este script**

    - Você também vai encontrar outros script como script_usuarios.sql que é pra inserção de vários usuários e script_noticias.sql para criação de várias notícias.Caso queira usar, fique ao seu critério.

2. Ambientação:

    > Caso use Xampp, faça o git clone ou baixe os arquivos na pasta htdocs, inicie o apache e o PhPMyAdmin e abra o navegador no diretorio da sua pasta.

    > Caso use PHP CLI, faça o git clone em qualquer lugar da sua máquina, entre na pasta do clone, abra o terminal e utilize o comando: *php -S localhost:8888*, após iniciar um servidor local na porta 8888, abra o seu navegador com o endereço *http://localhost:8888* que o projeto estará rodando.
    
    > Após ter o servidor rodando, configure o acesso ao seu banco local no arquivo "Conexao.php". Você econtrará este arquivo no seguinte diretório: 

    - Database > Conexao.php.
    - No arquivo você vai achar um comentário *Defina aqui a sua conexão com o banco de dados*. Abaixo dele você insere seus dados de acordo com as chaves do array.

## Proposta do projeto: 

1. Fluxo de Login

    > Fluxo de acesso restrito com painel admnistrativo e painel do usuário.
    > Página de login e de Registro, por default todas as contas vem setadas como usuário. Exceto a conta admin no ultimo artigo do readme - *Login Admin* criada no final do arquivo script.sql.

2. Regras de negócio

    **TODOS OS ACESSOS SÃO RESTRITOS, USUÁRIOS NÃO PODEM FAZER O QUE ADM FAZ E VICE-VERSA.**

   1. ADM: 

        > PEQUENAS INFOS
        - Ao lado do título do painel de administrador, você encontra 2 cards mostrando o total de assinantes e também o total de notícias registradas na plataforma.

        > EDITAR PERFIL
        - O ADM pode editar o seu perfil, essa funcionalidade você encontrará sendo redirecionado após fazer login como adm.

        > NOTÍCIAS
        - Ainda no painel ADM, você encontrará uma tabela de notícias, onde estão as 3 notícias em destaques, podendo visualizá-la clicando em *Ver notícia*.

        - Também na tabela, existe um botão futuante chamado *gerenciar notícias*. Neste botão você tem o controle de todas as notícias criadas, podendo editar, deletar, visualizar, criar uma nova notícia no botão *criar notícia* e também colocar como destaque. **Respeitando o limite de 3, se houver 3 notícias em destaques, remova uma do destaque clicando no botão *remover destaque* e selecione a de sua preferência clicando em *destaque***.

        - Na criação de notícias, a imagem é redirecionada para o seguinte caminho: */Uploads/Noticias/*

        > USUARIOS
        - No painel de ADM, scrollando para baixo você encontra uma outra tabela, dessa vez uma tabela de usuários, onde todos os usuários cadastrados no sistemas estão sendo listados. Nela você pode editar os respectivos dados do usuário no botão *editar* e também excluir os dados no botão *excluir*.

        - No cabeçalho da tabela, tem um breve titulo escrito *Listagem de todos os Assinantes* e logo após o número total de assinantes.

        - Também na tabela, existe um botão flutuante chamado *Adicionar usuário*, onde você pode estar registrando um novo usuário pela própria conta de ADM.
    
    2. USUARIO: 

        > PAINEL USUARIO
        - Após o login, aparece um botão flutuante chamado *Dashboard*. Nele você encontra todo o gerenciamento de produtos.
        
        > INFORMAÇÕES DO PERFIL
        - Ao lado do título panel de assinantes, você encontra seus dados como Nome, E-mail, Cidade, UF e CPF.

        - Também nas informações existe um link chamado *Editar perfil*. Ele te redireciona para editar o seus dados.

        - E por fim, também nas informações, existe um botão flutuante chamado *Ir para Dashboard*. Nele você encontra todo o gerenciamento de produtos.

        > DASHBOARD
        - Após clicar no botão dashboard e ser redirecionado, você encontra o título de dashboard e ao lado 2 cards, 1 em verde mostrando todos os produtos que estão ativos e o outro em azul, mostrando todos os produtos que você cadastrou.

        - Scrollando para baixo, você encontra uma tabela com todos os seus produtos que estão ativos, contendo as informações: *imagem*, *nome*, *quantidade* e o *valor*. Na tabela você também encontra o botão *ver produto*, onde você é redirecionado para a informação total do produto.

        - Ainda na tabela de produtos ativos, existem 2 botões flutuantes. O botãa *Criar Produto* te redireciona para o formulário de criação de um novo produto, sendo que, **Só é possível criar um novo produto se houver alguma categoria cadastrada**. O botão gerenciar produtos lista todos os produtos que você registrou no sistema, podendo então, editar, excluir, ver o produto sozinho e também ativar/desativar.

        - Scrollando para baixo na página de dashboard, você encontra uma listagem de todas as categorias que você criou com as suas informações. Ainda na tabela é possível editar e excluir a sua respectiva categoria.

        - Ainda na tabela de categorias, no cabeçalho tem um total de categorias registradas e do outro lado um botão flutuante chamado *Adicionar Categoria*, clicando nele você é redirecionado para o formulário de criação de categorias.

        > PRODUTOS
        - Na criação dos produtos, é inserido uma pasta dinâmica com id do usuário que colocou a imagem do produto. você encontra a pasta seguindo este caminho: *Uploads/Produtos/ - usuario_ *id* -  *

        > NOTICIAS
        - Voltando para o painel de usuário/assinantes, scrollando para baixo você encontra um carousel das 3 notícias em destaques, podendo clicar nelas e ser redirecionado para o conteúdo completo da notícia.

        - Logo abaixo tem um botão chamado *veja mais notícias*, nela você encontra todas as notícias já criadas pelo ADM.

## Techs utilizadas: 

> Foram usadas as seguintes tecnologias: 

- [x] PHP
- [x] MySQL
- [x] Jquery
- [x] Bootstrap
- [x] JqueryMask
- [x] JqueryMaskMoney
- [x] Owl Carousel

#### Login Admin

- Credenciais de Acesso do admin:
    - admin@internit.com.br
    - admin123