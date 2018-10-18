<?php

require_once('painel.php');
require_once('conexao.php');
require_once('verifica_acesso.php');

$id_usuario = $_SESSION['usuario']['IdUsuario'];

if (isset($_GET['id_exc']) && $_GET['id_exc'] != '') {
    $id_renda = $_GET['id_exc'];

    $page = ($_GET['limit'] != 1 || $_GET['page'] == 0) ? $_GET['page'] : $_GET['page'] - 5;

	mysqli_query($conexao, "UPDATE renda
							SET Excluido = 'S'
							WHERE ( IdRenda = '$id_renda' )");

    header("Location: http://localhost/sistema_financeiro/renda.php?page=$page"); 
}

$start = (isset($_GET['page'])) ? $_GET['page'] : 0;

$sql = "SELECT * 
		FROM renda 
		WHERE ( IdUsuario = '$id_usuario' )
        AND   ( Excluido = 'N' )";

$lines = mysqli_num_rows(mysqli_query($conexao, $sql));

$query = mysqli_query($conexao, $sql . ' LIMIT ' . $start . ', 5');

$limit = mysqli_num_rows($query);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Renda</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/validacao.js" charset="iso-8859-1"></script>
</head>
<body>

<div class="container">
	<h2>Suas Rendas</h2>
	<a href="http://localhost/sistema_financeiro/renda_adicionar.php" class="btn-link">Nova Renda</a>
	<table cellspacing="0" cellpadding="0">
		<thead>
		    <tr>
		    	<th width="60%">Descrição</th>
		        <th width="10%" class="centro">Dia</th>
		        <th width="10%" class="centro">Mês</th>
		        <th width="10%" class="centro">Ano</th>
		        <th width="5%"></th>
		        <th width="5%"></th>
		    </tr>
		</thead>
  		<tbody>
  			<?php if ($lines > 0) { while ($renda = mysqli_fetch_assoc($query)) { ?>
			    <tr>
			    	<td><?php echo $renda['Descricao']; ?></td>
			        <td class="centro"><?php echo number_format(($renda['Ganho'] / 30), 2, ',', ' '); ?></td>
			        <td class="centro"><?php echo number_format(($renda['Ganho']), 2, ',', ' '); ?></td>
			        <td class="centro"><?php echo number_format(($renda['Ganho'] * 12), 2, ',', ' '); ?></td>
	 				<td class="icone"><a href="http://localhost/sistema_financeiro/renda_editar.php?page=<?php echo isset($_GET['page']) ? $_GET['page'] : 0; ?>&id_edi=<?php echo $renda['IdRenda']; ?>"><img src="img/editar.png" title="editar" class="img-icone"></a></td>
			        <td class="icone"><a href="http://localhost/sistema_financeiro/renda.php?page=<?php echo isset($_GET['page']) ? $_GET['page'] : 0; ?>&id_exc=<?php echo $renda['IdRenda']; ?>&limit=<?php echo $limit; ?>"><img src="img/excluir.png" title="excluir" class="img-icone"></a></td>
			    </tr>
			<?php } } else { ?>
				<tr>
			    	<td class="null-list" colspan="4">Você não possui nenhuma despesa.</td>
			    </tr>
			<?php } ?>
		</tbody>
	</table>
    <?php if ($lines > 0) { ?>
        <div class="paginacao" style="width: 80%;">
            <ul>
                <a href="http://localhost/sistema_financeiro/renda.php?page=<?php echo (isset($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] - 5 : 0; ?>" title="Anterior"><li><</li></a>	
                <a href="http://localhost/sistema_financeiro/renda.php?page=<?php if (isset($_GET['page']) && $lines > $_GET['page'] + 5) { echo $_GET['page'] + 5; } else if (isset($_GET['page'])) { echo $_GET['page']; } else if (!isset($_GET['page']) && $lines > 5) { echo 5; } else { echo 0; }; ?>" title="Proximo"><li>></li></a>		
            </ul>
        </div>
    <?php } ?>
</div>

</body>
</html>