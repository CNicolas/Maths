<?php
include_once 'fonctions.php';
include_once 'Monome.php';

/**
* Polynome
*/
class Polynome
{

	/**
	 * Le tableau des monomes
	 * @var Array(Monome)
	 */
	public $monomes;
	/**
	 * Le degré du polynome
	 * @var int
	 */
	private $degre;

	/**
	 * Méthode magique de construction d'un Polynome
	 * @param	Array(int)		$monomes	Le tableau de Monomes
	 * @return		Polynome					Un nouveau Polynome
	 */
	function __construct($monomes) {
		$this->monomes = $monomes;
		$this->triDecroissantEnPlace();
		$this->calculDegrePolynome();
	}

	/**
	 * Méthode magique Polynome vers string
	 * @return	string La représentation graphique du Polynome
	 */
	function __toString() {
		$res = "";
		$len = count($this->monomes);
		for ($i = 0; $i < $len; $i++) { 
			if ($this->monomes[$i]->coeff > 0 && $i != 0) {
				$res .= " + ".$this->monomes[$i];
			} else {
				$res .= " ".$this->monomes[$i];
			}
		}
		return trim($res);
	}

	/**
     * Clone le Polynome
     * @return	Polynome	Le clone
     */
	public function clonePolynome() {
		$newMonomes = [];
		foreach ($this->monomes as $monome) {
			$newMonomes[] = $monome->cloneMonome();
		}
		return new Polynome($newMonomes);
	}

	/**
	 * Calcule et modifie le degré du Polynome
	 * @return	int	Le degré du Polynome
	 */
	public function calculDegrePolynome() {
		if (count($this->monomes) == 0) {
			return 0;
		}
		$this->degre = $this->monomes[0]->degre;
		return $this->degre;
	}

	/**
	 * Retourne le Monome de degré donné dans le Polynome
	 * @param 	int	$degre	Le degré
	 * @return	Monome		Le Monome, ou un Monome valant 0
	 */
	public function getMonomeByDegre($degre) {
		for ($i = 0; $i < count($this->monomes); $i++) {
			if ($this->monomes[$i]->degre == $degre) {
				return $this->monomes[$i];
			}
		}
		return new Monome(0,0);
	}

	/**
	 * Résoud un Polynome à partir d'un nombre donné
	 * @param 	int	$num	Le nombre
	 * @return	int 			Le résultat
	 */
	public function resolve($num) {
		$res = 0;
		for ($i = 0; $i < count($this->monomes); $i++) { 
			$res += $this->monomes[$i]->resolve($num);
		}
		return $res;
	}

	/**
	 * Réduit le Polynome : rassemble les Monomes de même degré
	 */
	private function reduce() {
		for ($i = 0; $i < count($this->monomes); $i++) { 
			for ($j = $i + 1; $j < count($this->monomes); $j++) { 
				if ($this->monomes[$i]->degre == $this->monomes[$j]->degre) {
					$this->monomes[$i] = $this->monomes[$i]->add($this->monomes[$j]);
					array_splice($this->monomes, $j, 1);
				} else {
					break;
				}
			}
		}
	}

	/**
	 * Tri le Polynome du Monome de plus haut degré vers le plus bas
	 */
	private function triDecroissantEnPlace() {
		$this->reduce();
		usort($this->monomes, function($a, $b) {
			return $b->degre - $a->degre;
		});
		for ($i = 0; $i < count($this->monomes); $i++) { 
			if ($this->monomes[$i]->coeff == 0) {
				array_splice($this->monomes, $i, 1);
			}
		}
	}

	/**
	 * Teste l'égalité entre les 2 Polynomes
	 * @param 	Polynome	$polynome	L'autre Polynome
	 * @return	bool 				Vrai ou Faux
	 */
	public function equals($polynome) {
		$len = count($this->monomes);
		$lenOther = count($polynome->monomes);
		if ($len == $lenOther) {
			for ($i = 0; $i < $len; $i++) { 
				if ($this->monomes[$i]->equals($polynome->monomes[$i]) == FALSE) {
					return FALSE;
				}
			}
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Ajoute un Monome au tableau de Monomes donné
	 * @param 	Array(Monome)	$monomes	Le tableau de monomes
	 * @param 	Monome			$monome		Le Monome à ajouter
	 * @return	Polynome						Le nouveau Polynome
	 */
	private function myAddMonome($monomes, $monome) {
		$i = 0;
		$len = count($monomes);
		while ($i < $len) {
			if ($monomes[$i]->degre == $monome->degre) {
				$monomes[$i] = $monomes[$i]->add($monome);
				break;
			}
			$i++;
		}
		if ($i >= $len) {
			$monomes[] = $monome;
		}
		$res = new Polynome($monomes);
		return $res;
	}

	/**
	 * Ajotue un Monome au Polynome
	 * @param	Monome		$monome	Le Monome à ajouter
	 * @return	Polynome			Le nouveau Polynome
	 */
	public function addMonome($monome) {
		return $this->myAddMonome(cloneArray($this->monomes), $monome);
	}

	/**
	 * Ajotue un Polynome au Polynome
	 * @param	Polynome	$polynome	Le Polynome à ajouter
	 * @return	Polynome				Le nouveau Polynome
	 */
	public function addPolynome($polynome) {
		$myMonomes = cloneArray($this->monomes);
		$res = new Polynome($myMonomes);
		$len = count($polynome->monomes);
		for ($i = 0; $i < $len; $i++) { 
			$res = $res->myAddMonome($res->monomes, $polynome->monomes[$i]);
		}
		$res->triDecroissantEnPlace();
		return $res;
	}

	/**
	 * Soustrait un Polynome
	 * @param	Polynome	$polynome	Le Polynome à soustraire
	 * @return	Polynome				Le nouveau Polynome
	 */
	public function subPolynome($polynome) {
		$otherMonomes = cloneArray($polynome->monomes);
		for ($i = 0; $i < count($otherMonomes); $i++) {
			$otherMonomes[$i]->coeff *= -1;
		}
		return $this->addPolynome(new Polynome($otherMonomes));
	}

	/**
	 * Multiplie par un Polynome
	 * @param	Polynome	$polynome	Le Polynome à multiplier
	 * @return	Polynome				Le nouveau Polynome
	 */
	public function multPolynome($polynome) {
		$otherMonomes = cloneArray($polynome->monomes);
		$lenOther = count($polynome->monomes);
		$len = count($this->monomes);
		$finalMonomes = [];
		for ($i = 0; $i < $lenOther; $i++) { 
			$newMonomes = cloneArray($this->monomes);
			for ($j = 0; $j < $len; $j++) { 
				$newMonomes[$j] = $newMonomes[$j]->mult($otherMonomes[$i]);
			}
			$finalMonomes = array_merge($finalMonomes, $newMonomes);
		}
		$res = new Polynome($finalMonomes);
		return $res;
	}

	/**
	 * Multiplie par un Monome
	 * @param	Monome	$monome		Le Monome à multiplier
	 * @return	Polynome			Le nouveau Polynome
	 */
	public function multMonome($monome) {
		$newMonomes = cloneArray($this->monomes);
		$len = count($newMonomes);
		for ($i = 0; $i < $len; $i++) { 
			$newMonomes[$i] = $newMonomes[$i]->mult($monome);
		}
		$res = new Polynome($newMonomes);
		return $res;
	}

	/**
	 * Multiplie par un int
	 * @param	int			$monome	Le nombre à multiplier
	 * @return	Polynome			Le nouveau Polynome
	 */
	public function multNumber($number) {
		$newMonomes = cloneArray($this->monomes);
		for ($i = 0; $i < count($newMonomes); $i++) { 
			$newMonomes[$i]->coeff = $newMonomes[$i]->coeff * $number;
		}
		$res = new Polynome($newMonomes);
		return $res;
	}

	/**
	 * L'algorithme de division euclidienne de polynomes
	 * Merci : http://www.developpez.net/forums/d174185/general-developpement/algorithme-mathematiques/mathematiques/division-euclidienne-polynome/#post1117295
	 * @param	Polynome	$P2	Le Polynome diviseur
	 * @return	Polynome		Le Polynome dividende
	 */
	public function algorithme($P2) {
		// $P1 est une copie de $this
		$P1 = $this->clonePolynome();
		// $P stockera le résultat
		$P = new Polynome(array(new Monome(0,0)));
		// $degre1 est le degré maximum actuel du Polynome $P1
		$degre1 = $P1->calculDegrePolynome();
		// $degre2 est le degré maximum du Polynome $P2
		$degre2 = $P2->calculDegrePolynome();
		// $coeff2 est le coefficient du Monome de degré $degre2 de $P2
		$coeff2 = $P2->getMonomeByDegre($degre2)->coeff;

		// Tant que le degré de $P2 est inférieur ou égal au degré de $P1
		while ($degre1 >= $degre2) {
			// On actualise le degré de $P1
			$degre1 = $P1->calculDegrePolynome();
			// $n est la différence de degré entre $P1 et $P2
			$n = $degre1 - $degre2;
			// $coeff1 est le coefficient du Monome de degré $degre1 de $P1
			$coeff1 = $P1->getMonomeByDegre($degre1)->coeff;
			
			// $xn est le Monome valant X à la puissance $n
			$xn = new Monome(1, $n);
			// $coeffDiv est le dividende des coefficients actuels
			$coeffDiv = $coeff1 / $coeff2;
			// $P2xn est le Polynome avec lequel on multiplie $xn
			$P2xn = $P2->multMonome($xn);
			// $P2xndiv est le Polynome avec lequel on multiplie $coeffDiv
			$P2xndiv = $P2xn->multNumber($coeffDiv);
			// $P1 est le nouveau Polynome diviseur, il vaut la soustraction de $P1 avec $P2xndiv
			// comme dans la division euclidienne à l'école
			$P1 = $P1->subPolynome($P2xndiv);

			// $P recoit $P + $xn * $coeffDiv
			$P = $P->addMonome($xn->multNumber($coeffDiv));
		}
		// $Q = $this->subPolynome($P2->multPolynome($P));
		// $P1 = $this->subPolynome($P2->multPolynome($P));
		return $P;
	}
}