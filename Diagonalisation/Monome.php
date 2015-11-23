<?php

/**
* Monome
*/
class Monome
{
	/**
	 * Le coefficient du monome
	 * @var int
	 */
	public $coeff;
	/**
	 * Le degré du monome
	 * @var int
	 */
	public $degre;

	/**
	 * Méthode magique de construction d'un Monome
	 * @param	int		$coeff	Le coefficient
	 * @param	int		$degre	Le degré
	 * @return 	Monome 			Un nouveau Monome
	 */
	function __construct($coeff, $degre) {
		$this->coeff = (int) $coeff;
		$this->degre = (int) $degre;
	}

	/**
	 * Méthode magique Monome vers string
	 * @return string La représentation graphique du Monome
	 */
	function __toString() {
		if ($this->degre == 0) {
			if ($this->coeff < 0) {
				return "- ".abs($this->coeff);
			} else {
				return (string) $this->coeff;
			}
			
		}

		switch ($this->coeff) {
			case 0:
				return "";
			case -1:
				return "- X".$this->HTMLDegre();
			case 1:
				return "X".$this->HTMLDegre();
			default:
				break;
		}

		if ($this->coeff < 0) {
			return "- ".abs($this->coeff)."X".$this->HTMLDegre();
		} else {
			return $this->coeff."X".$this->HTMLDegre();
		}
    }
   
   /**
    * Retourne le symbole correspondant à l'exposant du degré du Monome
    * @return string	Le symbole pour affichage html
    */
    public function HTMLDegre() {
    	switch ($this->degre) {
			case 1:
				return "";
			case 2:
				return "&sup2;";
			case 3:
				return "&sup3;";
			default:
				throw new Exception("On ne gère pas plus haut que degré 3, désolé !", 1);
		}
    }

    /**
     * Clone le Monome
     * @return Monome Le clone
     */
	public function cloneMonome() {
		return new Monome($this->coeff, $this->degre);
	}

	/**
	 * Teste l'égalité entre les 2 Monomes
	 * @param  Monome	$monome	L'autre Monome
	 * @return bool 			Vrai ou Faux
	 */
	public function equals($monome) {
		return $this->coeff == $monome->coeff && $this->degre == $monome->degre;
	}

	/**
	 * Résoud un Monome à partir d'un nombre donné
	 * @param  int	$num	Le nombre
	 * @return int 			Le résultat
	 */
    public function resolve($num) {
    	return $this->coeff * pow($num, $this->degre);
    }

    // --------------------------------------------------------------
    // OPERATIONS
    // --------------------------------------------------------------
    
    /**
     * Addition de 2 Monomes
     * @param Monome $other L'autre Monome
     */
    public function add($other) {
    	if ($this->degre == $other->degre) {
			return new Monome($this->coeff + $other->coeff, $this->degre);
    	} else {
    		return array($this, $other);
    	}
    }

    /**
     * Soustraction de 2 Monomes
     * @param Monome $other L'autre Monome
     */
    public function sub($other) {
    	if ($this->degre == $other->degre) {
			return new Monome($this->coeff - $other->coeff, $this->degre);
    	} else {
    		return array($this, $other);
    	}
    }

    /**
     * Multiplication de 2 Monomes
     * @param Monome $other L'autre Monome
     */
    public function mult($other) {
    	if ($this->degre == $other->degre && $this->degre == 0) {
			return new Monome($this->coeff * $other->coeff, $this->degre);
    	} else {
    		return new Monome($this->coeff * $other->coeff, $this->degre + $other->degre);
    	}
    }

    /**
     * Multiplication du Monome par un int
     * @param int	$other	Le nombre
     */
    public function multNumber($num) {
    	return new Monome($this->coeff * $num, $this->degre);
    }

    /**
     * Division de 2 Monomes
     * @param Monome $other L'autre Monome
     */
    public function div($other) {
    	if ($this->degre == $other->degre && $this->degre == 0) {
			return new Monome($this->coeff / $other->coeff, $this->degre);
    	} else {
    		return new Monome($this->coeff / $other->coeff, $this->degre - $other->degre);
    	}
    }
}