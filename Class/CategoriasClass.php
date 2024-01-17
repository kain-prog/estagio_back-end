<?php

class Categorias
{
    public function __construct( private $pdo  ){}

    public function listar_todas_categorias()
    {
        $categorias = array();

        $query = "SELECT * FROM categorias";
        $sql = $this->pdo->prepare( $query );
        $sql->execute();

        if( $sql->rowCount() != 0 ){
            $categorias = $sql->fetchAll();
            return $categorias;
        }

        return $categorias;

    }

    public function listar_categorias_usuario( $id )
    {
        $query = "SELECT * FROM categorias WHERE usuario_id = :id";

        $sql = $this->pdo->prepare( $query );
        $sql->bindValue( ':id', $id );
        $sql->execute();

        return $sql;
    }

    public function listar_categoria_por_id( $id )
    {
        $query = "SELECT * FROM categorias WHERE categoria_id = :id";

        $sql = $this->pdo->prepare( $query );
        $sql->bindValue( ':id', $id );
        $sql->execute();

        return $sql;
    }

    public function criar_categoria( $dados )
    {
        
        $todas_categorias = $this->listar_categorias_usuario( $dados['usuario_id'] );

        $nome_categoria = $dados['nome_categoria'];

        foreach( $todas_categorias as $categoria ):
            
            if( in_array( $dados['nome_categoria'], $categoria ) ){
                
                echo "<script>alert('O nome da categoria já existe.');</script>" ;
                return ;
            
            };

        endforeach ;
        
        if( strlen( $dados['nome_categoria'] ) > 20 ){
            echo "<script>alert('O nome da categoria é muito longo, o máximo são 20 caracteres!');</script>" ;
            return ;
        }

        if( strlen( $dados['codigo_categoria'] ) > 4 ){
            echo "<script>alert('O código da categoria é muito longo, o máximo são 4 caracteres!');</script>" ;
            return ;
        }

        $nome_categoria = addslashes( $dados['nome_categoria'] );
        $codigo_categoria = addslashes( $dados['codigo_categoria'] );
        $usuario_id = addslashes( $dados['usuario_id'] );

        $query = "INSERT INTO categorias( nome_categoria, codigo_categoria, usuario_id )
                    VALUES
                ( :nome_categoria, :codigo_categoria, :usuario_id )";
        
        $sql = $this->pdo->prepare( $query );
        $sql->bindValue( ':nome_categoria', $nome_categoria );
        $sql->bindValue( ':codigo_categoria', $codigo_categoria );
        $sql->bindValue( ':usuario_id', $usuario_id );
        $sql->execute();

        echo "<script>alert( 'A categoria foi criada com sucesso!' )</script>";

        $resultado = array( 'sucesso' => true, 'mensagem' => 'A categoria foi criada com sucesso!' );
        return $resultado;
    }


    public function editar_categoria( $id, $dados )
    {

        $todas_categorias = $this->listar_categorias_usuario( $dados['usuario_id'] );

        foreach( $todas_categorias as $categoria ):
            
            if( in_array( $dados['nome_categoria'], $categoria ) ){

                if( $categoria['categoria_id'] !== $id ){

                    echo "<script>alert('O nome da categoria já existe.');</script>" ;
                    return ;
                }          
            };

        endforeach ;

        if( $dados['nome_categoria'] > 20 ){
            echo "<script>alert('O nome da categoria é muito longo, o máximo são 20 caracteres!');</script>" ;
            return ;
        }

        if( $dados['codigo_categoria'] > 4 ){
            echo "<script>alert('O código da categoria é muito longo, o máximo são 4 caracteres!');</script>" ;
            return ;
        }

        $categoria_id = addslashes( $id );
        $nome_categoria = addslashes( $dados['nome_categoria'] );
        $codigo_categoria = addslashes( $dados['codigo_categoria'] );
        $usuario_id = addslashes( $dados['usuario_id'] );

        $query = "UPDATE SET `nome_categoria` = :nome_categoria, `codigo_categoria` = `codigo_categoria`, `usuario_id` = :usuario_id WHERE categoria_id = :categoria_id";
        
        $sql = $this->pdo->prepare( $query );
        $sql->bindValue( ':categoria_id', $categoria_id );
        $sql->bindValue( ':nome_categoria', $nome_categoria );
        $sql->bindValue( ':codigo_categoria', $codigo_categoria );
        $sql->bindValue( ':usuario_id', $usuario_id );
        $sql->execute();

        echo "<script>alert( 'A categoria foi editada com sucesso!' )</script>";

        $resultado = array( 'sucesso' => true, 'mensagem' => 'A categoria foi editada com sucesso!' );
        return $resultado;
    }

    public function excluir_categoria( $id )
    {
        $query = "DELETE FROM categorias WHERE categoria_id = :id";

        $sql = $this->pdo->prepare( $query );
        $sql->bindValue( ':id', $id );
        $sql->execute();
        
        echo "<script>alert( 'A categoria foi excluida com sucesso!' )</script>";

        $resultado = array( 'sucesso' => true, 'mensagem' => 'A categoria foi excluida com sucesso!' );
        return $resultado;
    }


}