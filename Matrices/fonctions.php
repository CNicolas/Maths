<?php
/**
 * @Author: cnicolas
 * @Date:   2014-08-06 15:02:32
 * @Last Modified by:   cnicolas
 * @Last Modified time: 2015-07-08 16:09:35
 */

function printMatrice($mat, $nom = 0, $label="Matrice", $bootstrapcol=2)
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

function drawInputMatrice($lig, $col, $lettre, $bootstrapcol=3)
{
	$res = "";
	$res .= "<div class='mat col-sm-".$bootstrapcol."'>\n";

	$res .= "<label for='mat".$lettre."'>$lettre</label>\n";
	$res .= "<table id='mat".$lettre."' class='matrice table-bordered'>\n";
	for ($i=0; $i < $lig; $i++) { 
		$res .= "<tr class='mat'>\n";
		for ($j=0; $j < $col; $j++) { 
			$res .= "<td>\n";
			$res .= "<input type='number' name='case".$lettre.$i.$j."' value='' maxlength='3' size='1' class='casemat'>\n";
			$res .= "</td>\n";
		}
		$res .= "</tr>\n";
	}
	$res .= "</table>\n";
	$res .= "</div>\n";

	return $res;
}

function parseMatrice($post, $lettre)
{
	$res;
	$li = 0;
	foreach ($post as $key => $value) {
		if (preg_match("@^case".$lettre."(.)(.)$@", $key, $tab)) {

			if ($tab[1] != $li) {
				$li = $tab[1];
				$res[] = array();
			}
			$res[$tab[1]][] = $value;
		}
	}
	return $res;
}

function roundMatrice($mat) {
	$res = $mat;
	for ($i=0; $i < count($res); $i++) { 
		for ($j=0; $j < count($res[$i]); $j++) { 
			if (is_float($res[$i][$j]))
				$res[$i][$j] = round($res[$i][$j], 2);
		}
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

function showMatrice($mat) {
	$res = "";
	for ($i=0; $i < count($mat); $i++) { 
		for ($j=0; $j < count($mat[$i]); $j++) { 
			$res .= $mat[$i][$j] . " ";
		}
		$res .= "<br />";
	}
	return $res;
}

function reverseMatrice($mat) {
	$tmp;
	for ($i=count($mat)-1; $i >= 0; $i--) { 
		$tmp[] = array_reverse($mat[$i]);
	}
	return $tmp;
}

?>