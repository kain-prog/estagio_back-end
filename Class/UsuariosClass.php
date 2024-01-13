<?php

class Usuarios
{
    private $adm = false;
    private $id;

    public function __construct( private $pdo  ){}

    public function listar()
    {   

        $conn = $this->pdo->prepare("SELECT * FROM usuarios WHERE adm = :adm");
        $conn->bindValue( ":adm", false  );
        $conn->execute();
    
        if($conn->rowCount() <= 0) return 0;

        return $conn;
        
        // return $usuarios;

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
                // header('Location: ../login.php');

                $this->listar_por_id($usuario['id']);

                if($usuario['adm']){
                    header( 'Location: ./adm/painel.php' );

                }else{
                    header( 'Location: ./usuario/painel.php' );
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

        $query = ("INSERT INTO usuarios ( nome, cpf, endereco, cidade, uf, senha, adm ) 
                    VALUES
                $dados->nome, $dados->cpf, $dados->endereco, $dados->cidade, $dados->uf, $dados->senha, $this->adm ");

        $sql = $this->pdo->prepare( $query );
        $sql->bindValue( ':nome', $dados['nome']  );
        $sql->bindValue( ':cpf', $dados['cpf']  );
        $sql->bindValue( ':endereco', $dados['endereco']  );
        $sql->bindValue( ':cidade', $dados['cidade']  );
        $sql->bindValue( ':uf', $dados['uf']  );
        $sql->bindValue( ':senha', md5( $dados['senha'] )  );
        $sql->bindValue( ':adm', $dados['adm']  );
        $sql->execute();            
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

    public function logout()
    {
        unset($_SESSION['internit-login']);
    }
}