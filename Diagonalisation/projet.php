<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Projet Diagonalisation</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-spacelab.min.css">
		<link rel="stylesheet" href="../css/maths.css">
	</head>
	<body>
		<div class='jumbotron'>
			<h1>Voici les résultats !</h1>
		</div>
		<main>
<?php
	include_once 'fonctions.php';
	include_once 'Monome.php';
	include_once 'Polynome.php';

	$time_start = microtime(true);

	$a3 = $_POST["a3"];
	$a2 = $_POST["a2"];
	$a1 = $_POST["a1"];
	$a0 = $_POST["a0"];

	$monomeX = new Monome(1, 1);

	$monomeCube = new Monome($a3, 3);
	$monomeCarre = new Monome($a2, 2);
	$monomeSimple = new Monome($a1, 1);
	$monomeZero = new Monome($a0, 0);

	$polynome = new Polynome(array($monomeCube, $monomeCarre, $monomeSimple, $monomeZero));

	$racines = racines($polynome);

	echo "<div class='panel panel-warning'>".
			"<div class='panel-heading'>".
				"<h2 class='panel-title'>Polynôme</h2></div>".
			"<div class='panel-body'><h3><strong>".$polynome."</strong></h3></div></div>";

	echo "<div class='panel panel-info'><div class='panel-heading'><h2 class='panel-title'>Racines</h2></div><div class='panel-body'>";
	if (count($racines) == 1) {
		$res = factorizeOne($polynome, $racines[0]);
		$factorise = $res["factorise"];
		$factorise2 = $res["factorise2"];
		$verif = $res["verification"];
		echo "<h3>La racine entière de ce polynôme est <strong>".$racines[0]."</strong></h3>";
	} elseif (count($racines) == 2) {
		$res = factorizeTwo($polynome, $racines);
		$factorise = $res["factorise"];
		$factorise2 = $res["factorise2"];
		$verif = $res["verification"];
		echo "<h3>Les deux racines entières de ce polynôme sont <strong>".$racines[0]."</strong> et <strong>".$racines[1]."</strong>.</h3>";
	} elseif (count($racines) == 3) {
		$res = factorizeThree($polynome, $racines);
		$factorise = $res["factorise"];
		$factorise2 = "- ".$res["factorise2"];
		$verif = $res["verification"];
		echo "<h3>Les racines entières de ce polynôme sont <strong>".$racines[0]."</strong>, <strong>".$racines[1]."</strong> et <strong>".$racines[2]."</strong>.</h3>";
	}
	echo "</div></div>";

	if (isset($factorise)) {
		echo "<div class='panel panel-success'><div class='panel-heading'><h2 class='panel-title'>Forme factorisée</h2></div><div class='panel-body'>";
		echo "<h3><strong>".$factorise."</strong></h3>";
		echo "</div></div>";
	}

	if (isset($factorise2)) {
		echo "<div class='panel panel-danger'><div class='panel-heading'><h2 class='panel-title'>Forme factorisée alternative</h2></div><div class='panel-body'>";
		echo "<h3><strong>".$factorise2."</strong></h3>";
		echo "</div></div>";
	}

	// if (isset($verif)) {
	// 	echo "<h3><strong>".$verif."</strong></h3>";
	// }

	$time_end = microtime(true);
	$time = $time_end - $time_start;
	$time = substr((string)$time, 0, 5);
?>
		</main>
		<?php echo "<footer class='footer'><h1>Durée : ".$time."s</h1></footer>"; ?>
		<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	</body>
</html>