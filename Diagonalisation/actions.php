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
			<h1>Vous voulez calculer le/les <?php echo htmlspecialchars($_POST['action']) ?> !</h1>
		</div>
		<div class="container">
<?php
	include_once 'fonctionsMatrices.php';

	if ($_POST['action'] === "projet") {
		echo "<form action='projet.php' method='post' class='form-inline'>\n";
		echo "<h3>Coefficients</h3><br/><div class='form-group row'>";
		echo "<label class='col-sm-3'>a3 : <input type='number' name='a3' value='' class='form-control' required /></label>\n";
		echo "<label class='col-sm-3'>a2 : <input type='number' name='a2' value='' class='form-control' required /></label>\n";
		echo "<label class='col-sm-3'>a1 : <input type='number' name='a1' value='' class='form-control' required /></label>\n";
		echo "<label class='col-sm-3'>a0 : <input type='number' name='a0' value='' class='form-control' required /></label></div>\n";
	} else if ($_POST['action'] === "Polynome Caractéristique") {
		echo "<form action='PolynomeCaracteristique.php' method='post' id='format' class='col-sm-12'>\n";
		echo drawInputMatrice(3, 3);
	}

	echo "<button type='submit' class='btn btn-default col-sm-12'>OK</button>\n";
	echo "</form>\n";
?>
		</main>
		<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	</body>
</html>