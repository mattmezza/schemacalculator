<?php

namespace Matt\InputParser;
use \Matt\FunctionalDependency,
	Matt\InputParser\AttributeSetParser;

class FunctionalDependencyParser
{
	public function __construct($fdStr)
	{
		$this->fdStr = $fdStr;
		try {
			$this->fd = $this->parse();
		} catch(\Exception $e){
			throw $e;
		}
	}

	public function getFunctionalDependency()
	{
		return $this->fd;
	}

	private function parse()
	{
		$this->fdStr = preg_replace("/( )+/", " ", $this->fdStr);
		$this->fdStr = trim($this->fdStr);
		if (strpos($this->fdStr,'->') === false) {
    		throw new \Exception("Functional Dependency '".$this->fdStr."' doesn't contain '->'", 1);
		}
		$members = explode("->", $this->fdStr);
		$asp = new AttributeSetParser($members[0]);
		$alpha = $asp->getAttributeSet();
		$asp = new AttributeSetParser($members[1]);
		$beta = $asp->getAttributeSet();
		return new FunctionalDependency($alpha, $beta);
	}

	private $fdStr;
	private $fd;
}