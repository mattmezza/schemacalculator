<?php

namespace Matt\InputParser;
use \Matt\FunctionalDependencySet,
	\Matt\InputParser\FunctionalDependencyParser;

class FunctionalDependencySetParser
{
	public function __construct($fdSetStr)
	{
		$this->fdSetStr = $fdSetStr;
		try {
			$this->fdSet = $this->parse();
		} catch(\Exception $e){
			throw $e;
		}
	}

	public function getFunctionalDependencySet()
	{
		return $this->fdSet;
	}

	private function parse()
	{
		$this->fdSetStr = trim($this->fdSetStr);
		$this->fdSetStr = preg_replace("/[^A-Za-z_ \,(\-\>)]+/", "", $this->fdSetStr);
		$this->fdSetStr = preg_replace("/( )+/", " ", $this->fdSetStr);
		$bits = explode(",", $this->fdSetStr);
		$set = new FunctionalDependencySet();
		foreach ($bits as $bit) {
			try{
				$p = new FunctionalDependencyParser($bit);
				$set->addDependency($p->getFunctionalDependency());
			} catch(\Exception $e) {
				throw $e;
			}
		}
		return $set;
	}

	private $fdSet;
	private $fdSetStr;
}