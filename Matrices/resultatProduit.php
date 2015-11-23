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
			<h1>Le résultat du produit !</h1>
		</div>
		<main>
<?php
/**
 * @Author: cnicolas
 * @Date:   2014-08-05 15:56:30
 * @Last Modified by:   cnicolas
 * @Last Modified time: 2015-07-08 16:23:46
 */
	include 'fonctions.php';

	$matA = parseMatrice($_POST, "A");
	$matB = parseMatrice($_POST, "B");
	$matRes = multMatrices($matA, $matB);

	echo printMatrice($matA, "matA", "A");
	echo "<div class='col-sm-1'><h2>*</h2></div>";
	echo printMatrice($matB, "matB", "B");
	echo "<div class='col-sm-1'><h2>=</h2></div>";
	echo printMatrice($matRes, "matRes", "Resultat");
?>
		</main>
		<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	</body>
</html>