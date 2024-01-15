<?php

require '../Database/Conexao.php';

class Noticias
{
    private $destaque = 0;

    public function __construct( private $pdo  ){}


    public function todas_noticias()
    {
        $query = "SELECT * FROM noticias";

        $sql = $this->pdo->prepare( $query );
        $sql->execute();

        return $sql;
    }

    public function noticias_em_destaque()
    {
        $query = "SELECT * FROM noticias WHERE destaque = :destaque";

        $sql = $this->pdo->prepare( $query );
        $sql->bindValue( ':destaque', 1 );
        $sql->execute();

        return $sql;
    }

    public function criar_noticia( $dados, $id )
    {

        $arquivo = $dados['imagem'];
        $nome = $arquivo['name'];
        $caminho = 'Uploads/Noticias/' . uniqid('', true) . $nome ;

        $utc_timezone = new DateTimeZone("UTC");
        $rj = new DateTimeZone("America/Sao_Paulo");

        $data_formatada = str_replace("/", "-", $dados['data_criacao']);
        $data_criacao = new DateTime($data_formatada, $utc_timezone );
        $data_criacao->setTimezone( $rj );
        $data_criacao = $data_criacao->format('Y-m-d');

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
    }

    public function adicionar_destaque( $id )
    {

        $noticias_em_destaque = $this->noticias_em_destaque();
        if( $noticias_em_destaque->rowCount() >= 3 ) echo "<script>alert( O máximo de notícias foi atingido, remova um destaque e tente novamente. );</script>";

        $query = " UPDATE noticias SET destaque = :destaque WHERE id = :id ";

        $sql = $this->pdo->prepare($query);
        $sql->bindValue( ':id', $id );
        $sql->bindValue( ':destaque', 1 );
        $sql->execute();

        echo "<script>alert( Noticia adicionada aos destaques. );</script>";

    }

    public function remover_destaque( $id )
    {

        $noticias_em_destaque = $this->noticias_em_destaque();
        if( $noticias_em_destaque->rowCount() >= 3 ) echo "<script>alert( O máximo de notícias foi atingido, remova um destaque e tente novamente. );</script>";

        $query = " UPDATE noticias SET destaque = :destaque WHERE id = :id ";
        $sql = $this->pdo->prepare($query);
        $sql->bindValue( ':id', $id );
        $sql->bindValue( ':destaque', 0 );
        $sql->execute();

        echo "<script>alert( Noticia removida dos destaques. );</script>";

    }

}