<?php

/**
*	Verifica Acesso
*
*	Este script щ responsavel por verificar 
*   se o usuario realmente realizou o login
*   caso ele nуo tenha feito o login o mesmo
*   serс redirecionado para a pagina de login.
*
*	Obs: Este script deve ser incluido
*	em todas as paginas do sistema
*   exeto na pagina de login e na
*   criaчуo de conta.
*/

// Verifica se NУO existe Sessуo
if ( !(isset($_SESSION)) )
{	
	// Starta a sessуo
	session_start();
}

// Verifica se existe algum problema no login
if ($_SESSION['login'] != 'S') {	
	// Redireciona para a tela de login
	header('Location: index.php');
}

?>