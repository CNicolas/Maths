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
			<h1>Entrez vos valeurs dans les matrices !</h1>
		</div>
		<main>
<?php
/**
 * @Author: cnicolas
 * @Date:   2014-08-06 10:38:18
 * @Last Modified by:   cnicolas
 * @Last Modified time: 2015-07-02 11:34:08
 */
	include 'fonctions.php';

	echo "<form action='resultatGauss.php' method='post' id='format'>\n";
	echo drawInputMatrice($_POST['n'], $_POST['n'], 'A');
	echo drawInputMatrice($_POST['n'], 1, 'Y');
	echo "<button type='submit' class='btn btn-default'>OK</button>\n";
	echo "</form>\n";
?>
		</main>
		<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	</body>
</html>