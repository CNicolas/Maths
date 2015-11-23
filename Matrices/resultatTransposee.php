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
			<h1>Le résultat de la transposée !</h1>
		</div>
		<main>
<?php
/**
 * @Author: cnicolas
 * @Date:   2014-08-05 16:39:26
 * @Last Modified by:   cnicolas
 * @Last Modified time: 2015-07-02 11:34:04
 */
	include 'fonctions.php';

	$matA = parseMatrice($_POST, "A");
	$matRes;
	
	for ($i=0; $i < sizeof($matA); $i++) { 
		for ($j=0; $j < sizeof($matA[0]); $j++) { 
			$matRes[$j][$i] = $matA[$i][$j];
		}
	}

	echo "<div class='col-sm-2'></div>";

	echo printMatrice($matA, "matA", "A");

	echo "<div class='col-sm-1'><h2>=</h2></div>";

	echo printMatrice($matRes, "matRes", "Transposée");
?>
		</main>
		<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	</body>
</html>