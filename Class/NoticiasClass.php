<?php

require '../Database/Conexao.php';

class Noticias
{
    private $destaque = 0;

    public function __construct( private $pdo  ){}

    public function todas_noticias()
    {
        $query = "SELECT *, DATE_FORMAT (data_criacao, '%d/%m/%Y') AS data_criacao FROM noticias";
        $sql = $this->pdo->prepare( $query );
        $sql->execute();

        return $sql;
    }

    public function noticias_em_destaque()
    {
        $query = "SELECT *, DATE_FORMAT (data_criacao, '%d/%m/%Y') AS data_criacao FROM noticias WHERE destaque = :destaque ";
        $sql = $this->pdo->prepare( $query );
        $sql->bindValue( ':destaque', 1 );
        $sql->execute();

        return $sql;

    }

    public function listar_por_id( $id )
    {
        $query = "SELECT *, DATE_FORMAT (data_criacao, '%d/%m/%Y') AS data_criacao FROM noticias WHERE id = :id ";
        $sql = $this->pdo->prepare( $query );
        $sql->bindValue( ':id', $id );
        $sql->execute();

        return $sql;

    }

    public function criar_noticia( $dados, $id )
    {
        if( strlen( $dados['titulo']) > 50 ){
            echo "<script>alert('O título inserido é muito grande, o máximo são 50 caracteres.');</script>" ;
            return;
        }

        if( strlen( $dados['resumo']) > 100 ){
            echo "<script>alert('O resumo inserido é muito grande, o máximo são 100 caracteres.');</script>" ;
            return;
        }

        $arquivo = $dados['imagem'];
        $nome = $arquivo['name'];
        $caminho = 'Uploads/Noticias/' . uniqid('', true) . $nome ;

        $data_formatada = str_replace("/", "-", $dados['data_criacao']);

        $validacao_data = DateTime::createFromFormat('d-m-Y', $data_formatada);
        $dia = $validacao_data->format('d');
        $mes = $validacao_data->format('m');
        $ano = $validacao_data->format('Y');
        
        if(!checkdate( $mes, $dia, $ano )){
            echo "<script>alert('Por favor, selecione uma data válida!');</script>" ;

            return ;
        }       

        $data_criacao = $validacao_data->format('Y-m-d');

        $titulo = addslashes( $dados['titulo'] );
        $resumo = addslashes( $dados['resumo'] );
        $imagem = addslashes( $caminho );
        $conteudo = addslashes( $dados['conteudo'] );
        $destaque = addslashes( $this->destaque );
        $usuario_id = addslashes( $id );

        $query = ( "INSERT INTO noticias ( titulo, resumo, imagem, conteudo, destaque, usuario_id, data_criacao ) 
                    VALUES
                    ( :titulo, :resumo, :imagem, :conteudo, :destaque, :usuario_id, :data_criacao )" );

        $sql = $this->pdo->prepare( $query );
        $sql->bindValue( ':titulo', $titulo  );
        $sql->bindValue( ':resumo', $resumo  );
        $sql->bindValue( ':imagem', $imagem );
        $sql->bindValue( ':conteudo', $conteudo  );
        $sql->bindValue( ':destaque', $destaque  );
        $sql->bindValue( ':usuario_id', $usuario_id );
        $sql->bindValue( ':data_criacao', $data_criacao );
        $sql->execute();        

        move_uploaded_file($arquivo['tmp_name'], '../'.$caminho);
        
        echo "<script>alert('Notícia criada com sucesso!');</script>" ;
    }

    public function atualizar_dados( $id, $dados )
    {   

        if( strlen($dados['titulo'])  > 50  ){
            echo "<script>alert('O título inserido é muito grande, o máximo são 50 caracteres.');</script>" ;
            return;
        }

        if( strlen($dados['resumo']) > 100 ){
            echo "<script>alert('O resumo inserido é muito grande, o máximo são 100 caracteres.');</script>" ;
            return;
        }

        $imagem_vazia = strlen( $dados['imagem']['name'] );

        $data_formatada = str_replace("/", "-", $dados['data_criacao']);
    
        $validacao_data = DateTime::createFromFormat('d-m-Y', $data_formatada);
        $dia = $validacao_data->format('d');
        $mes = $validacao_data->format('m');
        $ano = $validacao_data->format('Y');
        
        if(!checkdate( $mes, $dia, $ano )){
            echo "<script>alert('Por favor, selecione uma data válida!');</script>" ;

            return ;
        }       

        $data_criacao = $validacao_data->format('Y-m-d');

        //** */
        //*     validacao de imagem
        //** */

        if( $imagem_vazia <= 0 ){
    
            $titulo = addslashes( $dados['titulo'] );
            $resumo = addslashes( $dados['resumo'] );
            $conteudo = addslashes( $dados['conteudo'] );

            $query = "UPDATE `noticias` SET `titulo` = :titulo, `resumo` = :resumo, `data_criacao` = :data_criacao, `conteudo` = :conteudo WHERE `id` = :id ";
            $sql = $this->pdo->prepare( $query );
            $sql->bindValue( ':id', $id );
            $sql->bindValue( ':titulo', $titulo  );
            $sql->bindValue( ':resumo', $resumo  );
            $sql->bindValue( ':conteudo', $conteudo  );
            $sql->bindValue( ':data_criacao', $data_criacao );
            $sql->execute();

            $retorno = array( 'sucesso' => true , 'mensagem' => 'Notícia atualizada com sucesso!' );
            return $retorno;

        } else {

            $dados_antigos = $this->listar_por_id( $id )->fetch();

            // Remover foto antiga
            if (file_exists( '../' . $dados_antigos['imagem'] )) {
                unlink( '../' . $dados_antigos['imagem'] );
            }

            $arquivo = $dados['imagem'];
            $nome = $arquivo['name'];
            $caminho = 'Uploads/Noticias/' . uniqid('', true) . $nome ;
            
            $titulo = addslashes( $dados['titulo'] );
            $resumo = addslashes( $dados['resumo'] );
            $conteudo = addslashes( $dados['conteudo'] );

            $query = "UPDATE `noticias` SET `titulo` = :titulo, `resumo` = :resumo, `imagem` = :imagem, `data_criacao` = :data_criacao, `conteudo` = :conteudo WHERE `id` = :id ";
           
            $sql = $this->pdo->prepare( $query );
            $sql->bindValue( ':id', $id );
            $sql->bindValue( ':titulo', $titulo  );
            $sql->bindValue( ':resumo', $resumo  );
            $sql->bindValue( ':imagem', $caminho );
            $sql->bindValue( ':data_criacao', $data_criacao );
            $sql->bindValue( ':conteudo', $conteudo  );
            $sql->execute();

            // Adicionar foto nova
            move_uploaded_file($arquivo['tmp_name'], '../'.$caminho);

            $retorno = array( 'sucesso' => true , 'mensagem' => 'Notícia atualizada com sucesso!' );
            
            return $retorno;

        }        
    }

    public function apagar_noticia( $id )
    {
        $query = ( "DELETE FROM noticias WHERE id = :id" );
        $sql = $this->pdo->prepare( $query );
        $sql->bindValue( ':id', $id );
        $sql->execute();

        $retorno = array( 'sucesso' => true , 'mensagem' => 'Notícia apagada com sucesso!' );
        return $retorno;
    }

    public function destacar_toggle( $id )
    {       
        $noticia = $this->listar_por_id( $id )->fetch();

        if( !$noticia['destaque'] ){

            $noticias_em_destaque = $this->noticias_em_destaque();

            if( $noticias_em_destaque->rowCount() >= 3 ){
                echo "<script>alert( 'O máximo de notícias foi atingido, remova um destaque e tente novamente.' );</script>"; 
                return ;
            }

            $query = " UPDATE noticias SET destaque = :destaque WHERE id = :id ";
            $sql = $this->pdo->prepare($query);
            $sql->bindValue( ':id', $id );
            $sql->bindValue( ':destaque', 1 );
            $sql->execute();

            return array( 'sucesso' => true, 'mensagem' => 'A notícia foi adicionada ao destaque com sucesso.' );

        } else {

            $query = " UPDATE noticias SET destaque = :destaque WHERE id = :id ";
            $sql = $this->pdo->prepare($query);
            $sql->bindValue( ':id', $id );
            $sql->bindValue( ':destaque', 0 );
            $sql->execute();

            return array( 'sucesso' => true, 'mensagem' => 'A notícia foi removida do destaque com sucesso.' );

        } 
    }
}