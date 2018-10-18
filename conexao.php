<?php

/**
*	Conexão com o MySQL
*
*	Banco: dbf
*	Login: root
*   Senha: 
*	URL: http://localhost/phpmyadmin/
*/

$conexao = mysqli_connect("localhost", "root", "", "dbf");

// Verifica se ocorreu algum erro na conexão com o Banco
if (mysqli_connect_errno()) {
    echo "Erro de conexão: " . mysqli_connect_error();

    exit();
}

?>