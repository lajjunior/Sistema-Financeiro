<?php

require_once('painel.php');
require_once('conexao.php');
require_once('verifica_acesso.php');

$id_usuario = $_SESSION['usuario']['IdUsuario'];

$id_renda = (isset($_GET['id_edi'])) ? $_GET['id_edi'] : '';

if (isset($_POST['btnGravar'])) {
	$descricao = trim($_POST['txtDescricao']);
	$ganho = trim($_POST['nbrGanho']);
    
    $page = $_GET['page'];

	mysqli_query($conexao, "UPDATE renda
							SET Descricao = '$descricao',
								Ganho = '$ganho'
							WHERE ( IdRenda = '$id_renda' )
                            AND   ( IdUsuario = '$id_usuario' )");
                            
    header("Location: http://localhost/sistema_financeiro/renda.php?page=$page"); 
}

$sql = "SELECT * 
		FROM renda 
		WHERE ( IdUsuario = '$id_usuario' )
		AND   ( IdRenda = '$id_renda')
		AND   ( Excluido = 'N' )";

$query = mysqli_query($conexao, $sql);

$renda = mysqli_fetch_assoc($query);

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
	<h2>Editar Renda</h2>
	<div class="div-form">
		<form method="POST" action="" id="frmDados" name="frmDados">
			<div class="div-botao" style="width: 70%;">
				<label for="">Descrição da Renda</label>
				<input type="text" name="txtDescricao" id="txtDescricao" value="<?php echo $renda['Descricao']; ?>" maxlength="50" class="btn-texto">
			</div>
			<div class="div-botao" style="width: 29.5%;">
				<label for="nbrGanho">Ganho Mensal</label>
				<input type="float" name="nbrGanho" id="nbrGanho" value="<?php echo number_format(($renda['Ganho']), 2, ',', ' '); ?>" maxlength="10" class="btn-texto">
			</div>
			<div class="div-botao">
				<input type="submit" name="btnGravar" id="btnGravar" value="Gravar" class="btn-gravar" onclick="return validaCampo();">
			</div>
		</form>
	</div>
</div>

</body>
</html>