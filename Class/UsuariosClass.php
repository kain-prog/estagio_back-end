<?php
class Usuarios
{
    private $adm = 0;
    private $id;

    public function __construct( private $pdo  ){}

    public function listar_todos_usuarios()
    {   
        $usuarios = array();

        $conn = $this->pdo->prepare("SELECT * FROM usuarios");
        $conn->execute();

        if( $conn->rowCount() > 0 ){

            $usuarios = $conn->fetchAll();

            return $usuarios;
        }

        return $usuarios;
    }

    public function listar()
    {   

        $conn = $this->pdo->prepare("SELECT * FROM usuarios WHERE adm = :adm");
        $conn->bindValue( ":adm", 0  );
        $conn->execute();
    
        return $conn;
    }

    public function login( $email, $senha )
    {

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "<script>alert( 'Insira um e-mail válido' )</script>";
            return ;
        }

        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue( ":email", $email );
        $sql->execute();

        if($sql->rowCount() > 0 ){

            $usuario = $sql->fetch();

            if( $usuario['senha'] === $senha ) {

                $_SESSION['internit-login'] = $usuario['id'];
                
                echo "<script>alert( 'Login feito com sucesso!' );</script>";

                $this->listar_por_id($usuario['id']);

                if( $usuario['adm'] != 0 ){
                    
                    $resultado = array( 'sucesso' => true, 'adm' => true,  'mensagem' => 'Usuário registrado com sucesso!' );
                    return $resultado;


                }else{

                    $resultado = array( 'sucesso' => true, 'adm' => false,  'mensagem' => 'Usuário registrado com sucesso!' );
                    return $resultado;

                }

                return true;

            } else{
                echo "<script>alert( 'A senha inserida está incorreta.' );</script>";
                return false;

            }

        } else { 
            echo  "<script>alert( 'O e-mail inserido não existe.' );</script>";
            return false;

        }
    }

    public function registrar( $dados )
    {

        if(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
            echo "<script>alert( 'Insira um e-mail válido' )</script>";
            return ;
        }

        if(strlen( $dados['cpf'] ) < 14 ){
            echo "<script>alert( 'Insira um cpf válido' )</script>";
            return ;
        }

        $formatar_cpf = explode( '.', $dados['cpf'] );
        $formatar_cpf = explode( '-', implode($formatar_cpf) );
        $cpf_formatado = implode($formatar_cpf);

        $todos_usuarios = $this->listar_todos_usuarios();

        foreach( $todos_usuarios as $usuario ):

            if( $usuario['cpf'] == $cpf_formatado ){
                
                echo "<script>alert( 'O CPF inserido já existe.' )</script>";
                return ;

            }

            if( $usuario['email'] == $dados['email'] ){

                echo "<script>alert( 'O CPF inserido já existe.' )</script>";
                return ;

            }
        
        endforeach;

        
        if( !empty( $dados['senha'] || !empty( $dados['confirmacao_senha'] ))){

            if( $dados['senha'] !== $dados['confirmacao_senha'] ){
                echo "<script>alert( 'Confirmação de senha inválida' )</script>";
                return ;
            }

            $query = ( "INSERT INTO usuarios ( nome, email, cpf, endereco, cidade, uf, senha, adm ) 
                        VALUES
                    ( :nome, :email, :cpf, :endereco, :cidade, :uf, :senha, :adm )" );

            $nome = addslashes( $dados['nome'] );
            $email = addslashes( $dados['email'] );
            $cpf = addslashes( $cpf_formatado );
            $endereco = addslashes( $dados['endereco'] );
            $cidade = addslashes( $dados['cidade'] );
            $uf = addslashes( $dados['uf'] );
            $adm = addslashes( $this->adm );
            $senha = md5( $dados['senha'] );

            $sql = $this->pdo->prepare( $query );
            $sql->bindValue( ':nome', $nome  );
            $sql->bindValue( ':email', $email  );
            $sql->bindValue( ':cpf', $cpf );
            $sql->bindValue( ':endereco', $endereco  );
            $sql->bindValue( ':cidade', $cidade  );
            $sql->bindValue( ':uf', $uf );
            $sql->bindValue( ':senha', md5( $senha )  );
            $sql->bindValue( ':adm', $adm );
            $sql->execute();            

            echo "<script>alert( 'Usuário registrado com sucesso!' )</script>";
            $resultado = array( 'sucesso' => true, 'mensagem' => 'Usuário registrado com sucesso!' );
            return $resultado;
        }

    }

    public function listar_por_id( $id )
    {
        $this->id = $id;

        $query = "SELECT * FROM usuarios WHERE id = :id";
        $sql = $this->pdo->prepare( $query );
        $sql->bindValue( ':id', $id );
        $sql->execute();

        if($sql->rowCount() > 0 ){

            $usuario = $sql->fetch();
            return $usuario;
    
        }
    }

    public function atualizar_dados( $id, $dados)
    {

        if(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
            echo "<script>alert( 'Insira um e-mail válido' )</script>";
            return ;
        }

        if(strlen( $dados['cpf'] ) < 14 ){
            echo "<script>alert( 'Insira um cpf válido' )</script>";
            return ;
        }

        $formatar_cpf = explode( '.', $dados['cpf'] );
        $formatar_cpf = explode( '-', implode($formatar_cpf) );
        $cpf_formatado = implode($formatar_cpf);

        $todos_usuarios = $this->listar_todos_usuarios();

        foreach( $todos_usuarios as $usuario ):

            if( $usuario['cpf'] == $cpf_formatado ){

                if( $usuario['id'] !== $id ){

                    echo "<script>alert( 'O CPF inserido já existe.' )</script>";
                    return ;
                }
                
            }

            if( $usuario['email'] == $dados['email'] ){

                if( $usuario['id'] !== $id ){

                    echo "<script>alert( 'O E-mail inserido já existe.' )</script>";
                    return ;

                }
            }
        
        endforeach;

        if( empty( $dados['senha_atual'] ) ){
            echo "<script>alert( 'A senha atual é obrigatória' )</script>";
            return ;
        }

        $nome = addslashes( $dados['nome'] );
        $cpf = addslashes( $cpf_formatado );
        $email = addslashes( $dados['email'] );
        $endereco = addslashes( $dados['endereco'] );
        $cidade = addslashes( $dados['cidade'] );
        $uf = addslashes( $dados['uf'] );


        if( !empty( $dados['senha'] || !empty( $dados['confirmacao_senha'] ))){

            if( $dados['senha'] !== $dados['confirmacao_senha'] ){
                echo "<script>alert( 'Confirmação de senha inválida' )</script>";
                return ;
            }
            
            $senha = md5( $dados['senha'] );

            $query = "UPDATE usuarios SET `nome` = :nome, `cpf` = :cpf, `email` = :email, `endereco` = :endereco, `cidade` = :cidade, `uf` = :uf, `senha` = :senha WHERE `id` = :id";

            $sql = $this->pdo->prepare( $query );
            $sql->bindValue( ':id', $id );
            $sql->bindValue( ':nome', $nome );
            $sql->bindValue( ':cpf', $cpf );
            $sql->bindValue( ':email', $email );
            $sql->bindValue( ':endereco', $endereco );
            $sql->bindValue( ':cidade', $cidade );
            $sql->bindValue( ':uf', $uf );
            $sql->bindValue( ':senha', $senha );

            $sql->execute();

            echo "<script>alert( 'Seus dados foram atualizados com sucesso!' )</script>";

            $resultado = array( 'sucesso' => true, 'mensagem' => 'Seus dados foram atualizados com sucesso!' );
            return $resultado;

        } else {

            $query = "UPDATE `usuarios` SET `nome` = :nome, `cpf` = :cpf, `email` = :email, `endereco` = :endereco, `cidade` = :cidade, `uf` = :uf WHERE `id` = :id ";

            $sql = $this->pdo->prepare( $query );
            $sql->bindValue( ':id', $id );
            $sql->bindValue( ':nome', $nome );
            $sql->bindValue( ':cpf', $cpf );
            $sql->bindValue( ':email', $email );
            $sql->bindValue( ':endereco', $endereco );
            $sql->bindValue( ':cidade', $cidade );
            $sql->bindValue( ':uf', $uf );

            $sql->execute();

            echo "<script>alert( 'Seus dados foram atualizados com sucesso!' )</script>";

            $resultado = array( 'sucesso' => true, 'mensagem' => 'Seus dados foram atualizados com sucesso!' );
            return $resultado;
        }
    }

    public function excluir_usuario( $id )
    {

        $query = "DELETE FROM usuarios WHERE id = :id";

        $sql = $this->pdo->prepare( $query );
        $sql->bindValue( ':id', $id );
        $sql->execute();

        echo "<script>alert( 'O usuário foi removido com sucesso!' )</script>";

        $resultado = array( 'sucesso' => true, 'mensagem' => 'O usuário foi removido com sucesso!' );
        return $resultado;

    }

    public function logout()
    {
        unset($_SESSION['internit-login']);
    }
}