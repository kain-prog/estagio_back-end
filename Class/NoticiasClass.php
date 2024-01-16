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

    public function editar_noticia()
    {
        // Todo;
        echo "<script>alert('Notícia deletada com sucesso!');</script>" ;
    }

    public function apagar_noticia( $id )
    {
        $query = ( "DELETE FROM noticias WHERE id = :id" );
        $sql = $this->pdo->prepare( $query );
        $sql->bindValue( ':id', $id );
        $sql->execute();

        return true;
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

        } else {

            $query = " UPDATE noticias SET destaque = :destaque WHERE id = :id ";
            $sql = $this->pdo->prepare($query);
            $sql->bindValue( ':id', $id );
            $sql->bindValue( ':destaque', 0 );
            $sql->execute();

        } 

        return true;
    }
}