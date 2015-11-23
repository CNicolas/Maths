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
 * @Date:   2014-08-05 15:54:24
 * @Last Modified by:   cnicolas
 * @Last Modified time: 2015-07-02 11:34:07
 */
	include 'fonctions.php';
	
	if ($_POST['lignesB'] === $_POST['colonnesA']) {
		echo "<form action='resultatProduit.php' method='post' id='format'>\n";
		echo drawInputMatrice($_POST['lignesA'], $_POST['colonnesA'], 'A');
		echo drawInputMatrice($_POST['lignesB'], $_POST['colonnesB'], 'B');
		echo "<div class='col-sm-5'></div><button type='submit' class='btn btn-default'>OK</button>\n";
		echo "</form>\n";
	} else {
		echo "<h2>Produit A * B non calculable. Les matrices A et B doivent être de même taille</h2>";
		echo "<form action='actions.php' method='post' id='format'>\n";
		echo "<input hidden='true' type='radio' name='action' value='Somme' checked/>";
		echo "<button type='submit' class='btn btn-default'>OK</button>\n";
		echo "</form>\n";
	}
?>
		</main>
		<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	</body>
</html>
