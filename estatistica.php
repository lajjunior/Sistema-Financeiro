<?php

require_once('painel.php');
require_once('conexao.php');
require_once('verifica_acesso.php');

$id_usuario = $_SESSION['usuario']['IdUsuario'];

$sql_ren = "SELECT SUM(Ganho) AS Total
            FROM renda 
            WHERE ( IdUsuario = '$id_usuario' )";
$total = mysqli_fetch_assoc(mysqli_query($conexao, $sql_ren));

$sql_des = "SELECT Custo,
                   NivelNecessidade,
                   DataEnvio,
                   TipoRenda
            FROM despesa
            WHERE ( IdUsuario = '$id_usuario' )
            AND   ( Excluido = 'N' )";
$query_des = mysqli_query($conexao, $sql_des);

$despesas = array('B' => 0, 'M' => 0, 'A' => 0, 'Total' => 0);

$mes_anterior = array('m1' => 0, 'm2' => 0, 'm3' => 0, 'm4' => 0, 'fixa' => 0);

while ($dado = mysqli_fetch_assoc($query_des)) {
    $despesas['Total'] += $dado['Custo'];
 
    if ($dado['NivelNecessidade'] == 'B') {
        $despesas['B'] += $dado['Custo'];
    } else if ($dado['NivelNecessidade'] == 'M') {
        $despesas['M'] += $dado['Custo'];
    } else { 
        $despesas['A'] += $dado['Custo'];
    }
    
    if ($dado['TipoRenda'] == 'S') {
        $mes_anterior['fixa'] += $dado['Custo'];
    } else {
        if (substr($dado['DataEnvio'], 5, -12) == date('m', time())) {
            $mes_anterior['m1'] += $dado['Custo'];
        } else if (substr($dado['DataEnvio'], 5, -12) == date('m', time()) - 1) {
            $mes_anterior['m2'] += $dado['Custo'];
        } else if (substr($dado['DataEnvio'], 5, -12) == date('m', time()) - 2) {
            $mes_anterior['m3'] += $dado['Custo'];
        } else if (substr($dado['DataEnvio'], 5, -12) == date('m', time()) - 3) {
            $mes_anterior['m4'] += $dado['Custo'];
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>DashBoard</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/validacao.js" charset="iso-8859-1"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Descartavel', <?php echo $despesas['B']; ?>],
                ['Aceitavel', <?php echo $despesas['M']; ?>],
                ['Necessario',  <?php echo $despesas['A']; ?>],
            ]);

            var options = { title: 'Despesas' };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    
            chart.draw(data, options);
        }

        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart2);

        function drawChart2() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Custo", { role: "style" } ],
                ["Julho", <?php echo ($mes_anterior['fixa'] + $mes_anterior['m4']); ?>, "#b87333"],
                ["Agosto", <?php echo ($mes_anterior['fixa'] + $mes_anterior['m3']); ?>, "#8181F7"],
                ["Setembro", <?php echo ($mes_anterior['fixa'] + $mes_anterior['m2']); ?>, "gold"],
                ["Outubro", <?php echo ($mes_anterior['fixa'] + $mes_anterior['m1']); ?>, "color: #81F781"]
            ]);

            var view = new google.visualization.DataView(data);

            view.setColumns([0, 1, { calc: "stringify", sourceColumn: 1, type: "string", role: "annotation" }, 2]);

            var options = {
                title: "Comparação de gastos nos ultimos messes",
                width: 600,
                height: 400,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
            chart.draw(view, options);
        }
    </script>
</head>
<body>

<div class="dash-board">
    <h2>Avaliação Mensal</h2>
    <div class="card" style="background-color: #F2F2F2;">
        <h3>Renda Total</h3>
        <div class="total"><?php echo number_format(($total['Total']), 2, ',', ' '); ?></div>
    </div>
    <div class="card" style="background-color: #F2F2F2;">
        <h3>Despesa Total</h3>
        <div class="total"><?php echo number_format($despesas['Total'], 2, ',', ' '); ?></div>
    </div>
    <div class="card" style="background-color: #F2F2F2;">
        <h3>Economia Mensal</h3>
        <div class="total"><?php echo number_format(($total['Total'] - $despesas['Total']), 2, ',', ' ')  ; ?></div>
    </div>
    <div id="piechart" style="height: 450px;"></div>
    <div id="columnchart_values"></div>
</div>

</body>
</html>