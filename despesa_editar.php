<?php

require_once('painel.php');
require_once('conexao.php');
require_once('verifica_acesso.php');

$id_usuario = $_SESSION['usuario']['IdUsuario'];

$id_despesa = (isset($_GET['id_edi'])) ? $_GET['id_edi'] : '';

if (isset($_POST['btnGravar'])) {
	$descricao = trim($_POST['txtDescricao']);
	$nivel = trim($_POST['slcNivel']);
    $custo = trim($_POST['nbrCusto']);
    $tipo_renda = trim($_POST['slcTipoRenda']);
    
    $page = $_GET['page'];

	mysqli_query($conexao, "UPDATE despesa
							SET Descricao        = '$descricao',
								NivelNecessidade = '$nivel',
                                TipoRenda        = '$tipo_renda',
								Custo            = '$custo'
							WHERE ( IdDespesa = '$id_despesa' )
                            AND   ( IdUsuario = '$id_usuario' )");
                            
    header("Location: http://localhost/sistema_financeiro/despesa.php?page=$page"); 
}

$sql = "SELECT * 
		FROM despesa 
		WHERE ( IdUsuario = '$id_usuario' )
		AND   ( IdDespesa = '$id_despesa')
		AND   ( Excluido = 'N' )";

$query = mysqli_query($conexao, $sql) or die ('Error: ' . mysqli_error($conexao));

$despesas = mysqli_fetch_assoc($query);

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
	<h2>Editar Despesa</h2>
	<div class="div-form">
		<form method="POST" action="" id="frmDados" name="frmDados">
			<div class="div-botao">
				<label for="">Descrição da Despesa</label>
				<input type="text" name="txtDescricao" id="txtDescricao" value="<?php echo $despesas['Descricao']; ?>" maxlength="50" class="btn-texto">
			</div>
			<div class="div-botao" style="width: 20%;">
				<label for="slcNivel">Nível de Necessidade</label>
				<select id="slcNivel" name="slcNivel" class="btn-texto">
					<option value="B" <?php echo ($despesas['NivelNecessidade'] == 'B') ? 'selected' : ''; ?>>Baixo</option>
					<option value="M" <?php echo ($despesas['NivelNecessidade'] == 'M') ? 'selected' : ''; ?>>Medio</option>
					<option value="A" <?php echo ($despesas['NivelNecessidade'] == 'A') ? 'selected' : ''; ?>>Alto</option>
				</select>
			</div>
            <div class="div-botao" style="width: 20%;">
				<label for="slcTipoRenda">Tipo de Renda</label>
				<select id="slcTipoRenda" name="slcTipoRenda" class="btn-texto">
					<option value="S" <?php echo ($despesas['TipoRenda'] == 'S') ? 'selected' : ''; ?>>Renda Fixa</option>
					<option value="N" <?php echo ($despesas['TipoRenda'] == 'N') ? 'selected' : ''; ?>>Renda não Fixa</option>
				</select>
			</div>
			<div class="div-botao" style="width: 59%;">
				<label id="lblCusto" for="nbrCusto">Custo</label>
				<input type="float" name="nbrCusto" id="nbrCusto" value="<?php echo $despesas['Custo']; ?>" maxlength="20" class="btn-texto">
			</div>
			<div class="div-botao">
				<input type="submit" name="btnGravar" id="btnGravar" value="Gravar" class="btn-gravar" onclick="return validaCampo();">
			</div>
		</form>
	</div>
</div>

</body>
</html>