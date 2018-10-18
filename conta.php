<?php

require_once('conexao.php');

if (isset($_POST['btnGravar'])) {
	$nome = trim($_POST['txtNome']);
	$email = trim($_POST['txtEmail']);
	$usuario = trim($_POST['txtUsuario']);
	$senha = md5(trim($_POST['txtSenha']));
    
    $duplicidade = mysqli_num_rows(mysqli_query($conexao, "SELECT
                                                           IdUsuario
                                                           FROM usuario
                                                           WHERE ( Login = '$usuario' )"));
    if ($duplicidade == 0) {
        mysqli_query($conexao, "INSERT
                                INTO usuario
                                (Nome,
                                Email,
                                Login,
                                Senha
                                ) VALUES (
                                '$nome',
                                '$email',
                                '$usuario',
                                '$senha')");

        echo "<script> alert('Sua conta foi criada com sucesso!'); </script>";

        header("Location: http://localhost/sistema_financeiro/index.php");
    } else {
        echo "<script> alert('Não é permitido este nome de usuário.'); </script>";
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
<body>

<div class="container-conta">
	<h2>Inscreva-se e comece a se surpreender!</h2>
	<form method="POST" action="" id="frmDados" name="frmDados">
		<label for="txtNome" id="lblTeste">Nome Completo</label>
		<input type="text" name="txtNome" id="txtNome" value="<?php echo (isset($_POST['txtNome'])) ? $_POST['txtNome'] : ''; ?>" maxlength="50">
		<label for="txtEmail">E-mail</label>
		<input type="email" name="txtEmail" id="txtEmail" value="<?php echo (isset($_POST['txtEmail'])) ? $_POST['txtEmail'] : ''; ?>" maxlength="50">
		<label for="txtUsuario">Usuário</label>
		<input type="text" name="txtUsuario" id="txtUsuario" value="<?php echo (isset($_POST['txtUsuario'])) ? $_POST['txtUsuario'] : ''; ?>" maxlength="20">
		<label for="txtSenha">Senha</label>
		<input type="text" name="txtSenha" id="txtSenha" value="<?php echo (isset($_POST['txtSenha'])) ? $_POST['txtSenha'] : ''; ?>" maxlength="32">
		<input type="submit" name="btnGravar" id="btnGravar" value="Cadastre-se" class="btnGravar" onclick="return validaCampo();">
	</form>
	<a href="http://localhost/sistema_financeiro/index.php" id="link-conta">Já possui conta? então clique aqui.</a>
</div>

</body>
</html>