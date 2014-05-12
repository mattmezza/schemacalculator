<?php

namespace Matt\InputParser;
use \Matt\InputParser\FunctionalDependencySetParser,
	\Matt\InputParser\AttributeSetParser,
	\Matt\Schema;

class SchemaParser 
{
	public function __construct($R, $F)
	{
		$this->R = $R;
		$this->F = $F;
		try {
			$this->schema = $this->parse();
		} catch(\Exception $e) {
			throw $e;
		}
	}

	public function getR()
	{
		return $this->R;
	}

	public function getF()
	{
		return $this->F;
	}

	public function getSchema()
	{
		return $this->schema;
	}

	private function parse()
	{
		try {
			$asp = new AttributeSetParser($this->R);
			$as = $asp->getAttributeSet();
			$fdsp = new FunctionalDependencySetParser($this->F);
			$fds = $fdsp->getFunctionalDependencySet();
			return new Schema($as, $fds);
		} catch (\Exception $e) {
			throw $e;
		}
	}

	private $schema;
	private $R;
	private $F;
}