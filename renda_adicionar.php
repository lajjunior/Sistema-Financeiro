<?php

require_once('painel.php');
require_once('conexao.php');
require_once('verifica_acesso.php');

$id_usuario = $_SESSION['usuario']['IdUsuario'];

if (isset($_POST['btnGravar'])) {
    $descricao = trim($_POST['txtDescricao']);
    $ganho = trim($_POST['nbrGanho']);

    mysqli_query($conexao, "INSERT
							INTO renda
							(IdUsuario,
							 Descricao,
							 Ganho
							) VALUES (
						 	 '$id_usuario',
						 	 '$descricao',
						 	 '$ganho')");

    header("Location: http://localhost/sistema_financeiro/renda.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Renda</title>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/validacao.js" charset="iso-8859-1"></script>
</head>
<body>

<div class="container">
	<h2>Adicionar Renda</h2>
	<div class="div-form">
		<form method="POST" action="" id="frmDados" name="frmDados">
			<div class="div-botao" style="width: 70%;">
				<label for="txtDescricao">Descrição da Renda</label>
				<input type="text" name="txtDescricao" id="txtDescricao" value="" maxlength="50" class="btn-texto">
			</div>
			<div class="div-botao" style="width: 29.5%;">
				<label for="nbrGanho">Ganho Mensal</label>
				<input type="number" name="nbrGanho" id="nbrGanho" value="" maxlength="10" class="btn-texto">
			</div>
			<div class="div-botao">
				<input type="submit" name="btnGravar" id="btnGravar" value="Gravar" class="btn-gravar" onclick="return validaCampo();">
			</div>
		</form>
	</div>
</div>

</body>
</html>