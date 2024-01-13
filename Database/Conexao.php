<?php

try {

    $config = array();

    // Defina aqui a sua conexão com o banco de dados
    $config['db_name']  = 'internit';
    $config['db_host']  = 'localhost';
    $config['db_user']  = 'root';
    $config['db_pass']  = 'root';

    $pdo = new PDO("mysql:dbname=".$config['db_name'].";host=".$config['db_host'], 
                                        $config['db_user'], $config['db_pass']);

} catch (PDOException $e) {

    throw new PDOException($e->getMessage());    
};

?>