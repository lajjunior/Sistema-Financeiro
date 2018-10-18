<?php

/**
*	Verifica Acesso
*
*	Este script � responsavel por verificar 
*   se o usuario realmente realizou o login
*   caso ele n�o tenha feito o login o mesmo
*   ser� redirecionado para a pagina de login.
*
*	Obs: Este script deve ser incluido
*	em todas as paginas do sistema
*   exeto na pagina de login e na
*   cria��o de conta.
*/

// Verifica se N�O existe Sess�o
if ( !(isset($_SESSION)) )
{	
	// Starta a sess�o
	session_start();
}

// Verifica se existe algum problema no login
if ($_SESSION['login'] != 'S') {	
	// Redireciona para a tela de login
	header('Location: index.php');
}

?>