<header>
	<img src="img/perfil.png" class="perfil" title="<?php session_start(); echo $_SESSION['usuario']['Nome']; ?>">
	<nav>
		<h1>Your Money</h1>
		<ul>
			<a href="http://localhost/sistema_financeiro/despesa.php"><li>DESPESA</li></a>
			<a href="http://localhost/sistema_financeiro/renda.php"><li>RENDA</li></a>
			<a href="http://localhost/sistema_financeiro/estatistica.php"><li>ESTATÍSTICA</li></a>
			<a href="http://localhost/sistema_financeiro/index.php"><li>SAIR</li></a>
		</ul>
	</nav>
</header>