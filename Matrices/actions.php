<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Projet Matrices</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-spacelab.min.css">
		<link rel="stylesheet" href="../css/maths.css">
	</head>
	<body>
		<div class='jumbotron'>
			<h1>Vous voulez calculer le/la <?php echo htmlspecialchars($_POST['action']) ?> !</h1>
		</div>
		<main>
<?php
/**
 * @Author: cnicolas
 * @Date:   2014-08-05 10:38:00
 * @Last Modified by:   cnicolas
 * @Last Modified time: 2015-07-02 11:34:09
 */
	include 'fonctions.php';
	
	echo "<form action='".htmlspecialchars($_POST['action']).".php' method='post' class='col-sm-6'>\n";
	if (($_POST['action'] === "Somme") || ($_POST['action'] === "Produit")) {
		echo "<div class='row'>\n";
		echo "<div class='form-group col-sm-5'>Nombre de lignes de A : <input type='text' name='lignesA' value='' class='form-control' /></div>\n";
		echo "<div class='col-sm-1'></div>\n";
		echo "<div class='form-group col-sm-5'>Nombre de lignes de B : <input type='text' name='lignesB' value='' class='form-control' /></div>\n</div>\n";
		echo "<div class='row'>\n";
		echo "<div class='form-group col-sm-5'>Nombre de colonnes de A : <input type='text' name='colonnesA' value='' class='form-control' /></div>\n";
		echo "<div class='col-sm-1'></div>\n";
		echo "<div class='form-group col-sm-5'>Nombre de colonnes de B : <input type='text' name='colonnesB' value='' class='form-control' /></div>\n</div>\n";
	} elseif ($_POST['action'] === "Transposee") {
		echo "<div class='form-group'>Nombre de lignes de A : <input type='text' name='lignesA' value='' class='form-control' /></div>\n";
		echo "<div class='form-group'>Nombre de colonnes de A : <input type='text' name='colonnesA' value='' class='form-control' /></div>\n";
	} elseif ($_POST['action'] === "Trace") {
		echo "<div class='form-group'>Ordre de A : <input type='text' name='ordreA' value='' class='form-control' /></div>\n";
	} elseif ($_POST['action'] === "Gauss") {
		echo "<div class='form-group'>n : <input type='text' name='n' value='' class='form-control' /></div>\n";
	}

	echo "<button type='submit' class='btn btn-default'>OK</button>\n";
	echo "</form>\n";
?>
		</main>
		<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	</body>
</html>