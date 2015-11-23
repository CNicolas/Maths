<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Projet Diagonalisation</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-spacelab.min.css">
		<link rel="stylesheet" href="../css/maths.css">
	</head>
	<body>
		<div id="pcarres" class='jumbotron'>
			<h1>Voici les résultats !</h1>
		</div>
		<main>
<?php
	include_once 'fonctions.php';
	include_once 'fonctionsMatrices.php';
	include_once 'Monome.php';
	include_once 'Polynome.php';

	$time_start = microtime(true);

	echo "<div class='row' style='text-align: center;'>";

	$I3 = [[1,0,0],[0,1,0],[0,0,1]];

	$A = parseMatrice($_POST);
	echo printMatrice($A, "matriceF0", "A");
	$trA = trace($A);
	$matF0tmp = multMatriceNumber($I3, $trA);
	$matF0tmp2 = subMatrices($A, $matF0tmp);
	$F1 = multMatrices($A, $matF0tmp2);

	echo printMatrice($F1, "F1", "F1");
	$trF1 = trace($F1) / 2;
	$matF1tmp = multMatriceNumber($I3, $trF1);
	$matF1tmp2 = subMatrices($F1, $matF1tmp);
	$F2 = multMatrices($A, $matF1tmp2);
	echo printMatrice($F2, "F2", "F2");

	$trF2 = trace($F2) / 3;

	echo "</div>";

	$monomeCube = new Monome(-1, 3);
	$monomeCarre = new Monome($trA, 2);
	$monomeSimple = new Monome($trF1, 1);
	$monomeZero = new Monome($trF2, 0);
	$PA = new Polynome(array($monomeCube, $monomeCarre, $monomeSimple, $monomeZero));

	$racines = racines($PA);

	echo "<div class='panel panel-warning'>".
			"<div class='panel-heading'>".
				"<h2 class='panel-title'>Polynôme</h2></div>".
			"<div class='panel-body'><h3><strong>".$PA."</strong></h3></div></div>";

	echo "<div class='panel panel-info'><div class='panel-heading'><h2 class='panel-title'>Racines</h2></div><div class='panel-body'>";
	if (count($racines) == 1) {
		$res = factorizeOne($PA, $racines[0]);
		$factorise = $res["factorise"];
		$factorise2 = $res["factorise2"];
		$verif = $res["verification"];
		echo "<h3>La racine entière de ce polynôme est <strong>".$racines[0]."</strong></h3>";
	} elseif (count($racines) == 2) {
		$res = factorizeTwo($PA, $racines);
		$factorise = $res["factorise"];
		$factorise2 = $res["factorise2"];
		$verif = $res["verification"];
		echo "<h3>Les deux racines entières de ce polynôme sont <strong>".$racines[0]."</strong> et <strong>".$racines[1]."</strong>.</h3>";
	} elseif (count($racines) == 3) {
		$res = factorizeThree($PA, $racines);
		$factorise = $res["factorise"];
		$factorise2 = "- ".$res["factorise2"];
		$verif = $res["verification"];
		echo "<h3>Sp&real; = {<strong>".$racines[0]."</strong>, <strong>".$racines[1]."</strong>, <strong>".$racines[2]."</strong>} avec ";
		echo "<i>m</i>(".$racines[0].") = 1, <i>m</i>(".$racines[1].") = 1 et <i>m</i>(".$racines[2].") = 1</h3>";
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