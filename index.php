<?php

// Importa o arquivo de conex�o
require_once('conexao.php');

// Starta a sess�o
session_start();

// Verifica se a Sess�o j� existe
if (isset($_SESSION['login'])) {	
	// Caso exista a mesma passa a valer 'N'
	$_SESSION['login'] = 'N';
}

// Verifica se clicou no bot�o
if (isset($_POST['btnGravar'])) {
	// Pega o login e senha que o usuario digitou
	$login = trim($_POST['txtUsuario']);
	$senha = md5(trim($_POST['txtSenha']));

	// SQL para buscar as informa��es do Usu�rio
	$sql = "SELECT * 
            FROM usuario 
            WHERE ( Login = '$login' )
            AND   ( Senha = '$senha' )";

	// Executa a query passando a SQL
	$query = mysqli_query($conexao, $sql);

	// Verifica se o usuario existe
	if (mysqli_num_rows($query) > 0)  {
		// Login efetuado com sucesso, agora a sess�o passa a valer 'S'
		$_SESSION['login'] = 'S';

		// Recebe todas as informa��es do usuario
		$_SESSION['usuario'] = mysqli_fetch_assoc($query);

		// Redireciona para o painel principal
		header('Location: despesa.php');
	} else {
		echo "<script> alert('Usu�rio ou Senha invalido.'); </script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/validacao.js" charset="iso-8859-1"></script>
</head>
<body class="login-body">

<form method="POST" action="" id="frmDados" name="frmDados">
	<fieldset>
		<h1>Bem Vindo</h1>
		<label>Usu�rio</label>
		<input type="text" name="txtUsuario" id="txtUsuario" value="<?php echo (isset($_POST['txtUsuario'])) ? $_POST['txtUsuario'] : ''; ?>">	
		<label>Senha</label>
		<input type="password" name="txtSenha" id="txtSenha" value="<?php echo (isset($_POST['txtSenha'])) ? $_POST['txtSenha'] : ''; ?>">
		<input type="submit" name="btnGravar" id="btnGravar" value="Entrar" onclick="return validaCampo();">
		<label id="lbl-conta"><a href="http://localhost/sistema_financeiro/conta.php">Criar uma conta</a></label>
	</fieldset>
</form>

</body>
</html>