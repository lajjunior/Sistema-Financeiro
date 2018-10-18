<?php

require_once('painel.php');
require_once('conexao.php');
require_once('verifica_acesso.php');

$id_usuario = $_SESSION['usuario']['IdUsuario'];

if (isset($_POST['btnGravar'])) {
	$descricao = trim($_POST['txtDescricao']);
	$nivel = trim($_POST['slcNivel']);
    $custo = trim($_POST['floCusto']);
    $tipo = trim($_POST['slcTipoRenda']);

	mysqli_query($conexao, "INSERT
							INTO despesa
							(IdUsuario,
							 Descricao,
							 NivelNecessidade,
							 Custo,
                             TipoRenda
							) VALUES (
						 	 '$id_usuario',
						 	 '$descricao',
						 	 '$nivel',
						 	 '$custo',
                             '$tipo')");
    
    header("Location: http://localhost/sistema_financeiro/despesa.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Despesa</title>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/validacao.js" charset="iso-8859-1"></script>
</head>
<body>

<div class="container">
	<h2>Adicionar Despesa</h2>
	<div class="div-form">
		<form method="POST" action="" id="frmDados" name="frmDados">
			<div class="div-botao">
				<label for="txtDescricao">Descrição da Despesa</label>
				<input type="text" name="txtDescricao" id="txtDescricao" value="" maxlength="50" class="btn-texto">
			</div>
			<div class="div-botao" style="width: 20%;">
				<label for="slcNivel">Nível de Necessidade</label>
				<select id="slcNivel" name="slcNivel" class="btn-texto">
					<option value="B">Baixo</option>
					<option value="M">Medio</option>
					<option value="A">Alto</option>
				</select>
            </div>
            <div class="div-botao" style="width: 20%;">
				<label for="slcTipoRenda">Tipo de Despesa</label>
				<select id="slcTipoRenda" name="slcTipoRenda" class="btn-texto">
					<option value="S">Fixa</option>
					<option value="N">Não Fixa</option>
				</select>
			</div>
			<div class="div-botao" style="width: 59%;">
				<label id="lblCusto" for="floCusto">Custo</label>
				<input type="float" name="floCusto" id="floCusto" value="" maxlength="20" class="btn-texto">
			</div>
			<div class="div-botao">
				<input type="submit" name="btnGravar" id="btnGravar" value="Gravar" class="btn-gravar" onclick="return validaCampo();">
			</div>
		</form>
	</div>
</div>

</body>
</html>