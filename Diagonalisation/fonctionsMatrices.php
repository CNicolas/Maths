<?php

function parseMatrice($post)
{
	$res;
	$li = 0;
	foreach ($post as $key => $value) {
		if (preg_match("@^caseA(.)(.)$@", $key, $tab)) {

			if ($tab[1] != $li) {
				$li = $tab[1];
				$res[] = array();
			}
			$res[$tab[1]][] = $value;
		}
	}
	return $res;
}

function drawInputMatrice($lig, $col, $bootstrapcol=3)
{
	$res = "";
	$res .= "<div class='mat col-sm-".$bootstrapcol." col-sm-offset-4'>\n";

	$res .= "<label for='matA'>A</label>\n";
	$res .= "<table id='matA' class='matrice table-bordered'>\n";
	for ($i=0; $i < $lig; $i++) { 
		$res .= "<tr class='mat'>\n";
		for ($j=0; $j < $col; $j++) { 
			$res .= "<td>\n";
			$res .= "<input type='number' name='caseA".$i.$j."' value='' maxlength='3' size='1' class='casemat'>\n";
			$res .= "</td>\n";
		}
		$res .= "</tr>\n";
	}
	$res .= "</table>\n";
	$res .= "</div>\n";

	return $res;
}

function trace($matrice) {
	$res = 0;
	for ($i=0; $i < sizeof($matrice); $i++) { 
		$res += $matrice[$i][$i];
	}
	return $res;
}

function multMatrices($matA, $matB) {
	$matRes;
	for ($i=0; $i < count($matA); $i++) { 
		for ($k=0; $k < count($matB[0]); $k++) { 
			$somme = 0;
			for ($j=0; $j < count($matA[$i]); $j++) { 
				$somme += round($matA[$i][$j] * $matB[$j][$k], 2);
			}
			$matRes[$i][] = $somme;
		}
		$matRes[] = array();
	}
	array_pop($matRes);
	return $matRes;
}

function multMatriceNumber($matrice, $number) {
	$matRes;
	for ($i=0; $i < sizeof($matrice); $i++) { 
		for ($j=0; $j < sizeof($matrice[$i]); $j++) { 
			$matRes[$i][$j] = $matrice[$i][$j] * $number;
		}
	}
	return $matRes;
}

function subMatrices($matA, $matB) {
	$matRes;
	for ($i=0; $i < sizeof($matA); $i++) { 
		for ($j=0; $j < sizeof($matA[$i]); $j++) { 
			$matRes[$i][$j] = $matA[$i][$j] - $matB[$i][$j];
		}
	}
	return $matRes;
}

function printMatrice($mat, $nom = 0, $label="Matrice", $bootstrapcol=4)
{
	$res = "";

	$res .= "<div class='mat col-sm-".$bootstrapcol."'>\n";
	if ($nom === 0)
		$nom = "matrice".rand();
	$res .= "<label for='".$nom."'>".$label."</label>\n";
	$res .= "<table id='".$nom."' class='matrice table-bordered'>\n";
	for ($i=0; $i < count($mat); $i++) { 
		$res .= "<tr>\n";
		for ($j=0; $j < count($mat[$i]); $j++) { 
			$res .= "<td class='casemat'>".$mat[$i][$j]."</td>\n";
		}
		$res .= "</tr>\n";
	}
	$res .= "</table>\n";
	$res .= "</div>\n";

	return $res;
}