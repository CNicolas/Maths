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
			<h1>Le résultat de la somme !</h1>
		</div>
		<main>
<?php
/**
 * @Author: cnicolas
 * @Date:   2014-08-05 12:09:51
 * @Last Modified by:   cnicolas
 * @Last Modified time: 2015-07-02 11:34:06
 */
	include 'fonctions.php';

	$matA = parseMatrice($_POST, "A");;
	$matB = parseMatrice($_POST, "B");;

	echo printMatrice($matA, "matA", "A");
	echo "<div class='col-sm-1'><h2>+</h2></div>";
	echo printMatrice($matB, "matB", "B");
	echo "<div class='col-sm-1'><h2>=</h2></div>";

	echo "<div class='mat col-sm-3'>\n";
	echo "<label for='res'>Resulat</label>\n";
	echo "<table id='res' class='matrice table-bordered'>\n";
	for ($i=0; $i < sizeof($matA); $i++) { 
		echo "<tr>\n";
		for ($j=0; $j < sizeof($matA[$i]); $j++) { 
			echo "<td class='casemat'>".($matA[$i][$j]+$matB[$i][$j])."</td>\n";
		}
		echo "</tr>\n";
	}
	echo "</table>\n";
	echo "</div>\n";
?>
		</main>
		<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	</body>
</html>