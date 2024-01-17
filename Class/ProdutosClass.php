<?php

// require '../Database/Conexao.php';

class Produtos
{
   public function __construct( private $pdo  ){}

   public function listar_todos_produtos_ativos( $id)
   {
      $query = "SELECT * FROM produtos WHERE usuario_id = :id AND situacao = 1";

      $sql = $this->pdo->prepare( $query );
      $sql->bindValue( ':id', $id );
      $sql->execute();

      return $sql;
   }

   public function listar_todos_produtos_do_usuario( $id )
   {
      $query = "SELECT * FROM produtos p
                        INNER JOIN categorias c
                           ON p.categoria_id = c.categoria_id
                        WHERE p.usuario_id = :id AND c.usuario_id = p.usuario_id";

      $sql = $this->pdo->prepare( $query );
      $sql->bindValue( ':id', $id );
      $sql->execute();

      return $sql;
   }

   public function listar_produto_por_id( $id )
   {

      $query = "SELECT * FROM produtos p
                        INNER JOIN categorias c
                           ON p.categoria_id = c.categoria_id
                        WHERE p.id = :id AND c.usuario_id = p.usuario_id";

      $sql = $this->pdo->prepare( $query );
      $sql->bindValue( ':id', $id );
      $sql->execute();

      return $sql;
   }

   public function criar_produto( $dados )
   {

      $imagem_vazia = strlen( $dados['imagem']['name'] );

      if( $imagem_vazia <= 0 ){
         echo "<script>alert('Por favor, insira uma imagem.');</script>" ;
         return;
      }

      if( strlen($dados['nome'])  > 25  ){
         echo "<script>alert('O nome do produto é muito grande, o máximo são 25 caracteres.');</script>" ;
         return;
      }

      if( strlen($dados['descricao'])  > 75 ){
         echo "<script>alert('O nome do produto é muito grande, o máximo são 75 caracteres.');</script>" ;
         return;
      }

      if( strlen($dados['codigo'])  > 4 ){
         echo "<script>alert('O código do produto é muito grande, o máximo são 4 caracteres.');</script>" ;
         return;
      }
   
      $codigo_categoria = $dados['categoria_selecionada']['codigo_categoria'];
      $codigo_relacionado = $codigo_categoria . $dados['codigo'];

      $todos_os_produtos = $this->listar_todos_produtos_do_usuario( $dados['usuario_id'] );

      foreach( $todos_os_produtos as $produto ):

         if( $produto['codigo'] === $codigo_relacionado ){

            echo "<script>alert('O código do produto já existe.');</script>" ;
            return;

         }

      endforeach;

      $usuario_id = $dados['usuario_id'];
      $arquivo = $dados['imagem'];
      $nome = $arquivo['name'];
      $caminho = 'Uploads/Produtos/'. 'usuario_' . $usuario_id . '/' . uniqid('', true) . $nome;
      $caminho_pasta = '../Uploads/Produtos/'. 'usuario_' . $usuario_id;

      if ( !is_dir( $caminho_pasta )){
         mkdir( $caminho_pasta , 0777, true);
      }

      $nome = addslashes( $dados['nome'] );
      $codigo = addslashes( $codigo_relacionado );
      $situacao = addslashes( $dados['situacao']  );
      $valor = addslashes( $dados['valor']  );
      $quantidade = addslashes( $dados['quantidade'] );
      $descricao = addslashes( $dados['descricao']  );
      $imagem = addslashes( $caminho );
      $usuario_id = addslashes( $dados['usuario_id']  );
      $categoria_id = addslashes( $dados['categoria']  );

      $query = ( "INSERT INTO produtos ( nome, codigo, situacao, valor, quantidade, descricao, imagem, usuario_id, categoria_id ) 
                  VALUES
               ( :nome, :codigo, :situacao, :valor, :quantidade, :descricao, :imagem, :usuario_id, :categoria_id )" );
   
      $sql = $this->pdo->prepare( $query );
      $sql->bindValue( ':nome', $nome );
      $sql->bindValue( ':codigo', $codigo );
      $sql->bindValue( ':situacao', $situacao );
      $sql->bindValue( ':valor', $valor );
      $sql->bindValue( ':quantidade', $quantidade );
      $sql->bindValue( ':descricao', $descricao );
      $sql->bindValue( ':imagem', $imagem );
      $sql->bindValue( ':usuario_id', $usuario_id );
      $sql->bindValue( ':categoria_id', $categoria_id );
      $sql->execute();
   
      move_uploaded_file($arquivo['tmp_name'], '../'.$caminho);

      echo "<script>alert( 'O produto foi criado com sucesso!' )</script>";

      $resultado = array( 'sucesso' => true, 'mensagem' => 'O produto foi criado com sucesso!' );
      return $resultado;
   }

   public function atualizar_dados( $id, $dados )
   {

      if( strlen($dados['nome'])  > 25  ){
         echo "<script>alert('O nome do produto é muito grande, o máximo são 25 caracteres.');</script>" ;
         return;
      }

      if( strlen($dados['descricao'])  > 75 ){
         echo "<script>alert('O nome do produto é muito grande, o máximo são 75 caracteres.');</script>" ;
         return;
      }

      if( strlen($dados['codigo'])  > 4 ){
         echo "<script>alert('O código do produto é muito grande, o máximo são 4 caracteres.');</script>" ;
         return;
      }

      $codigo_completo = $dados['codigo_categoria'] . $dados['codigo'];

      $todos_os_produtos = $this->listar_todos_produtos_do_usuario( $dados['usuario_id'] );

      foreach( $todos_os_produtos as $produto ):

         if( $produto['codigo'] === $codigo_completo ){

            if( $produto['id'] != $id ){

               echo "<script>alert('O código do produto já existe.');</script>" ;
               
               return;
            }

         }

      endforeach;

      $valor_formatado = floatval( $dados['valor'] );

      $imagem_vazia = strlen( $dados['imagem']['name'] );

      if( $imagem_vazia <= 0 ){

         $nome = addslashes( $dados['nome'] );
         $situacao = addslashes( $dados['situacao']  );
         $valor = addslashes( $valor_formatado  );
         $quantidade = addslashes( $dados['quantidade'] );
         $descricao = addslashes( $dados['descricao']  );
         $codigo = addslashes( $codigo_completo );

         $query = "UPDATE `produtos` SET `nome` = :nome, `situacao` = :situacao, `valor` = :valor, `quantidade` = :quantidade, `descricao` = :descricao, `codigo` = :codigo WHERE `id` = :id ";
      
         $sql = $this->pdo->prepare( $query );
         $sql->bindValue( ':id', $id );
         $sql->bindValue( ':nome', $nome );
         $sql->bindValue( ':situacao', $situacao );
         $sql->bindValue( ':valor', $valor );
         $sql->bindValue( ':quantidade', $quantidade );
         $sql->bindValue( ':descricao', $descricao );
         $sql->bindValue( ':codigo', $codigo );
         $sql->execute();

         echo "<script>alert( 'O produto foi editado com sucesso!' )</script>";

         $resultado = array( 'sucesso' => true, 'mensagem' => 'O produto foi editado com sucesso!' );
         return $resultado;
         
         
      } else {

         $dados_antigos = $this->listar_produto_por_id( $id )->fetch();

         // Remover foto antiga
         if (file_exists( '../' . $dados_antigos['imagem'] )) {
             unlink( '../' . $dados_antigos['imagem'] );
         }

         $arquivo = $dados['imagem'];
         $nome = $arquivo['name'];
         $caminho = 'Uploads/Produtos/'. $dados_antigos['usuario_id'] . '/' . uniqid('', true) . $nome ;
         
         $nome = addslashes( $dados['nome'] );
         $situacao = addslashes( $dados['situacao']  );
         $valor = addslashes( $valor_formatado  );
         $quantidade = addslashes( $dados['quantidade'] );
         $descricao = addslashes( $dados['descricao']  );
         $codigo = addslashes( $codigo_completo );

         $query = "UPDATE `produtos` SET `nome` = :nome, `situacao` = :situacao, `valor` = :valor, `quantidade` = :quantidade, `imagem` = :imagem, `descricao` = :descricao, `codigo` = :codigo WHERE `id` = :id ";
      
         $sql = $this->pdo->prepare( $query );
         $sql->bindValue( ':id', $id );
         $sql->bindValue( ':imagem', $caminho );
         $sql->bindValue( ':nome', $nome );
         $sql->bindValue( ':situacao', $situacao );
         $sql->bindValue( ':valor', $valor );
         $sql->bindValue( ':quantidade', $quantidade );
         $sql->bindValue( ':descricao', $descricao );
         $sql->bindValue( ':codigo', $codigo );
         $sql->execute();

         // Adicionar foto nova
         move_uploaded_file($arquivo['tmp_name'], '../'.$caminho);

         echo "<script>alert( 'O produto foi editado com sucesso!' )</script>";

         $resultado = array( 'sucesso' => true, 'mensagem' => 'O produto foi editado com sucesso!' );
         return $resultado;
      }
   }


   public function ativar_toggle( $id )
   {

      $produto = $this->listar_produto_por_id( $id )->fetch();

      if( !$produto['situacao'] ){

         $query = "UPDATE produtos SET situacao = :situacao WHERE id = :id";

         $sql = $this->pdo->prepare( $query );
         $sql->bindValue( ':id', $id );
         $sql->bindValue( ':situacao', 1 );
         $sql->execute();

         echo "<script>alert( 'O Produto foi ativado com sucesso!' );</script>"; 
         $retorno = array( 'sucesso' => true, 'mensagem' => 'O Produto foi ativado com sucesso!' );

         return $retorno;

      } else {

         $query = "UPDATE produtos SET situacao = :situacao WHERE id = :id";

         $sql = $this->pdo->prepare( $query );
         $sql->bindValue( ':id', $id );
         $sql->bindValue( ':situacao', 0 );
         $sql->execute();

         echo "<script>alert( 'O Produto foi desativado com sucesso!' );</script>"; 
         $retorno = array( 'sucesso' => true, 'mensagem' => 'O Produto foi desativado com sucesso!' );

         return $retorno;

      }

   }

   public function excluir_produto( $id )
   {

      $query = "DELETE FROM produtos WHERE id = :id";

      $sql = $this->pdo->prepare( $query );
      $sql->bindValue( ':id', $id );
      $sql->execute();

      echo "<script>alert( 'O produto foi excluído com sucesso!' )</script>";

      $resultado = array( 'sucesso' => true, 'mensagem' => 'O produto foi excluído com sucesso!' );
      return $resultado;
   }
}