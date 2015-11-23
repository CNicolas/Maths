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
			<h1>Le résultat de l'équation !</h1>
		</div>
		<main>
<?php
/**
 * @Author: cnicolas
 * @Date:   2014-08-06 14:29:39
 * @Last Modified by:   cnicolas
 * @Last Modified time: 2015-07-02 11:34:07
 */
	include 'fonctions.php';

	$matA = parseMatrice($_POST, "A");
	$matAOld = $matA;
	$matY = parseMatrice($_POST, "Y");
	$matYOld = $matY;

	echelonner();
	echelonnerRev();

	for ($i=0; $i < count($matA); $i++) { 
		$tmp = round($matY[$i][0] / $matA[$i][$i]);
		if ($tmp == 0)
			$tmp = 1;
		$res[] = $tmp;
	}

	$matRes;
	for ($i=0; $i < count($res); $i++) { 
		$matRes[] = array($res[$i]);
	}

	echo "<div class='col-sm-offset-2 col-sm-8 panel-success'>";
	echo "<div class='panel-heading'><h1>Résultat !</h1></div>";
	echo "<div class='panel-body'>";
	echo printMatrice($matAOld, "matAOld", "A", 4);
	echo printMatrice($matRes, "matRes", "X", 4);
	echo printMatrice($matYOld, "matYOld", "Y", 4);
	echo "</div></div>";

	function initG($mat) {
		$res = $mat;
		for ($i=0; $i < sizeof($res); $i++) { 
			for ($j=0; $j < sizeof($res[0]); $j++) { 
				if ($i === $j) {
					$res[$i][$j] = 1;
				} else {
					$res[$i][$j] = 0;
				}
			}
		}
		return $res;
	}

	function isFinished($tab) {
		$res = 0;
		foreach ($tab as $key => $value) {
			if ($value != 0)
				if ($res === 0)
					$res = 1;
				else
					return false;
		}
		return true;
	}

	function echelonner() {
		global $matA;
		global $matY;

		$k = 0;
		while(!isFinished($matA[count($matA) - 1]) && $k != count($matA) - 1) {
			$matG = initG($matA);

			if ($matA[$k][$k] === 0) {
				for ($i = $k + 1; $i < count($matA); $i++) { 
					if ($matA[$i][$k] != 0) {
						$matA[$k] = $matA[$i];
						$matY[$k] = $matY[$i];
						break;
					}
				}
			}

			for ($i = $k + 1; $i < count($matG); $i++) { 
				$matG[$i][$k] = -round($matA[$i][$k] / $matA[$k][$k], 2);
			}
			$matA = multMatrices($matG, $matA);
			$matY = multMatrices($matG, $matY);

			$matA = roundMatrice($matA);
			$matY = roundMatrice($matY);

			echo printMatrice($matG, "matG".($k+1), "G".($k+1));
			echo printMatrice($matA, "matA".($k+2), "A".($k+2));
			echo printMatrice($matY, "matY".($k+2), "Y".($k+2));
			$k++;
		}
	}

	function echelonnerRev() {
		global $matA;
		global $matY;

		$k = count($matA) - 1;
		while(!isFinished($matA[0]) && $k != 0) {
			$matG = initG($matA);

			if ($matA[$k][$k] === 0) {
				for ($i = $k - 1; $i >= 0; $i--) { 
					if ($matA[$i][$k] != 0) {
						$matA[$k] = $matA[$i];
						$matY[$k] = $matY[$i];
						break;
					}
				}
			}

			for ($i = $k - 1; $i >= 0; $i--) { 
				$matG[$i][$k] = -round($matA[$i][$k] / $matA[$k][$k], 2);
			}
			$matA = multMatrices($matG, $matA);
			$matY = multMatrices($matG, $matY);
		
			$matA = roundMatrice($matA);
			$matY = roundMatrice($matY);
/*
			echo printMatrice($matG, "matGRev".$k, "G".-$k);
			echo printMatrice($matA, "matARev".(-$k+1), "A".(-$k+1));
			echo printMatrice($matY, "matYRev".(-$k+1), "Y".(-$k+1));*/
			$k--;
		}
	}

?>
		</main>
		<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	</body>
</html>