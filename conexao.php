<?php

/**
*	Conex�o com o MySQL
*
*	Banco: dbf
*	Login: root
*   Senha: 
*	URL: http://localhost/phpmyadmin/
*/

$conexao = mysqli_connect("localhost", "root", "", "dbf");

// Verifica se ocorreu algum erro na conex�o com o Banco
if (mysqli_connect_errno()) {
    echo "Erro de conex�o: " . mysqli_connect_error();

    exit();
}

?>