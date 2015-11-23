<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Projet Matrices</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-spacelab.min.css">
		<link rel="stylesheet" href="../css/maths.css">
	</head>
	<body>
		<div class='jumbotron'>
			<h1>Le résultat de la trace !</h1>
		</div>
		<main>
<?php
/**
 * @Author: cnicolas
 * @Date:   2014-08-05 16:55:42
 * @Last Modified by:   cnicolas
 * @Last Modified time: 2015-07-08 16:20:26
 */
	include 'fonctions.php';

	$matA = parseMatrice($_POST, "A");
	$res = 0;

	for ($i=0; $i < sizeof($matA); $i++) { 
		$res += $matA[$i][$i];
	}

	echo "<div class='col-sm-2'><h2>Trace : </h2></div>";
	echo printMatrice($matA, "matA", "A");
	echo "<div class='col-sm-1'><h2>=</h2></div>";
	echo "<div class=' col-sm-1'><h2>".$res."</h2></div>\n";
?>
		</main>
		<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	</body>
</html>