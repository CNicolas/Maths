<?php

include_once 'Monome.php';
include_once 'Polynome.php';

/**
 * Clone un tableau
 * @param  Array $array Le tableau
 * @return Array        Le clone du tableau
 */
function cloneArray($array) {
	$res = array();
	foreach ($array as $k => $v) {
		$res[$k] = clone $v;
	}
	return $res;
}

/**
 * Trouve la ou les racines entières d'un polynome de degré 3
 * @param  Polynome		$polynome	Le polynome
 * @return Array(int)				La ou les racine(s)
 */
function racines($polynome) {
	$racines = [];
	for ($num=-10; $num <= 10; $num++) { 
		if ($polynome->resolve($num) == 0) {
			$racines[] = $num;
		}
	}
	return $racines;
}

/**
 * Transforme la ou les racine(s) en un polynome utilisable dans les fonctions de factorisation
 * @param  mixed 		$racines	La ou les racine(s)
 * @return Polynome					Le polynome formé à partir des racine(s) pour la factorisation
 */
function racinesToPolynome($racines) {
	$len = count($racines);
	if (is_integer($racines)) {
		$monomeX = new Monome(1, 1);
		$P2 = new Polynome(array($monomeX, new Monome(-1 * $racines, 0)));
	} elseif ($len == 2) {
		$x0 = $racines[0];
		$x1 = $racines[1];
		$m2 = new Monome(1, 2);
		$m1 = new Monome(-1 * ($x0 + $x1), 1);
		$m0 = new Monome($x0 * $x1, 0);
		$P2 = new Polynome(array($m2, $m1, $m0));
	} elseif ($len == 1) {
		$monomeX = new Monome(1, 1);
		$P2 = new Polynome(array($monomeX, new Monome(-1 * $racines[0], 0)));
	} else {
		throw new Exception("WTF ?", 1);
	}
	return $P2;	
}

/**
 * Factorise un polynome en fonction de sa racine
 * @param  Polynome 				$polynome	Le polynome
 * @param  int 						$racines	Les racines
 * @return Array(string->string)				Les formes factorisée, alternative et le polynome de vérification
 */
function factorizeOne($P1, $racine) {
	$P2 = racinesToPolynome($racine);
	$P3 = $P1->algorithme($P2);
	$racines = racines($P3);
	$P4 = racinesToPolynome($racines);
	$P5 = $P3->algorithme($P4);

	$factorise = "(".$P2.")(".$P4.")(".$P5.")";
	$factorise2 = prettyFactors($P2, $P4, $P5);
	$verif = $P2->multPolynome($P4->multPolynome($P5));
	return array("factorise" => $factorise, "factorise2" => $factorise2, "verification" => $verif);
}

/**
 * Factorise un polynome en fonction de ses 2 racines
 * @param  Polynome 				$polynome	Le polynome
 * @param  Array(int) 				$racines	Les racines
 * @return Array(string->string)				Les formes factorisée, alternative et le polynome de vérification
 */
function factorizeTwo($polynome, $racines) {
	$monomeX = new Monome(1, 1);
	$mr1 = new Monome(-1 * $racines[0], 0);
	$mr2 = new Monome(-1 * $racines[1], 0);
	$po1 = new Polynome(array($monomeX, $mr1));
	$po2 = new Polynome(array($monomeX, $mr2));
	$po3 = $polynome->algorithme(racinesToPolynome($racines));

	$factorise = "(".$po1.")(".$po2.")(".$po3.")";
	$factorise2 = prettyFactors($po1, $po2, $po3);
	$verif = $po1->multPolynome($po2->multPolynome($po3));
	return array("factorise" => $factorise, "factorise2" => $factorise2, "verification" => $verif);
}

/**
 * Factorise un polynome en fonction de ses 3 racines
 * @param  Polynome 				$polynome	Le polynome
 * @param  Array(int) 				$racines	Les racines
 * @return Array(string->string)				Les formes factorisée, alternative et le polynome de vérification
 */
function factorizeThree($polynome, $racines) {
	$monomeX = new Monome(1, 1);
	$mr1 = new Monome(-1 * $racines[0], 0);
	$mr2 = new Monome(-1 * $racines[1], 0);
	$mr3 = new Monome(-1 * $racines[2], 0);
	$po1 = new Polynome(array($monomeX, $mr1));
	$po2 = new Polynome(array($monomeX, $mr2));
	$po3 = new Polynome(array($monomeX, $mr3));

	$factorise = "- (".$po1.")(".$po2.")(".$po3.")";
	$factorise2 = prettyFactors($po1, $po2, $po3);
	$verif = $po1->multPolynome($po2->multPolynome($po3))->multNumber(-1);
	return array("factorise" => $factorise, "factorise2" => $factorise2, "verification" => $verif);
}

/**
 * Rend un polynome de degré 1 joli
 * @param  Polynome	$P	Le polynome
 * @return string		La représentation du polynome
 */
function prettyPolynome($P) {
	$len = count($P->monomes);
	if ($len == 2 && $P->calculDegrePolynome() == 1) {
		$m0 = $P->monomes[0];
		$m1 = $P->monomes[1];
		if ($m0->coeff < 0 && $m1->coeff < 0) {
			$r0 = new Monome(-1 * $m0->coeff, $m0->degre);
			$r1 = new Monome(-1 * $m1->coeff, $m1->degre);
			return "- (".$r0." + ".$r1.")";
		}
		if ($m0->coeff < 0 && $m1->coeff > 0) {
			return "(".$m1." ".$m0.")";
		}
		return "(".$P.")";
	} elseif ($len == 1 && $P->calculDegrePolynome() == 1) {
		return $P;
	} else {
		throw new Exception("WTF ?", 1);
	}
}

/**
 * Rend la factorisation plus compacte et peut-être jolie
 * @param  Polynome	$P1	Le facteur 1
 * @param  Polynome	$P2	Le facteur 2
 * @param  Polynome	$P3	Le facteur 3
 * @return string		La représentation factorisée du polynome
 */
function prettyFactors($P1, $P2, $P3) {
	// echo $P1."<br/>".$P2."<br/>".$P3."<br/>";
	if ($P1->equals($P2) && $P1->equals($P3)) {
		return prettyPolynome($P1)."&sup3;";
	} elseif ($P1->equals($P2) && $P2->equals($P3->multNumber(-1))) {
		return "- ".prettyPolynome($P1)."&sup3;";
	}  elseif ($P1->equals($P2->multNumber(-1)) && $P1->equals($P3)) {
		return "- ".prettyPolynome($P1)."&sup3;";
	} elseif ($P1->equals($P2->multNumber(-1)) && $P2->equals($P3)) {
		return prettyPolynome($P1)."&sup3;";
	} elseif ($P1->equals($P2) && !$P1->equals($P3)) {
		return prettyPolynome($P1)."&sup2;".prettyPolynome($P3);
	} elseif (!$P1->equals($P2) && $P1->equals($P3)) {
		return prettyPolynome($P1)."&sup2;".prettyPolynome($P2);
	} elseif ($P1->equals($P2->multNumber(-1)) && !$P1->equals($P3) && !$P2->equals($P3)) {
		return "- ".prettyPolynome($P1)."&sup2;".prettyPolynome($P3);
	} elseif ($P2->equals($P3->multNumber(-1)) && !$P1->equals($P3) && !$P1->equals($P2)) {
		return "- ".prettyPolynome($P3)."&sup2;".prettyPolynome($P1);
	}
	return prettyPolynome($P1).prettyPolynome($P2).prettyPolynome($P3);
}
