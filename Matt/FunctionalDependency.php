<?php

namespace Matt;
use \Matt\AttributeSet;

class FunctionalDependency 
{
	
	public function __construct(AttributeSet $alpha, AttributeSet $beta)
	{
		$this->alpha = $alpha;
		$this->beta = $beta;
	}

	public function getAlpha() {
	    return $this->alpha;
  	}

  	public function getBeta() {
	    return $this->beta;
  	}

  	public function setAlpha(AttributeSet $alpha) {
	    $this->alpha = $alpha;
  	}

  	public function setBeta(AttributeSet $beta) {
	    $this->beta = $beta;
  	}
	
	public function __toString()
	{
		return $this->alpha . " -> " . $this->beta;
	}

	public function equals(FunctionalDependency $other)
	{
		return ( ( $this->alpha===$other->getAlpha() ) && ( $this->beta===$other->getBeta() ) );
	}

	private $alpha;
	private $beta;
}