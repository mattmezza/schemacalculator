<?php

namespace Matt;
use \Matt\AttributeSet,
	\Matt\FunctionalDependencySet;

class Schema
{
	public function __construct(AttributeSet $attributes, FunctionalDependencySet $fdSet)
	{
		$this->attributeSet = $attributes;
		$this->fdSet = $fdSet;
		$this->separator = " w/ ";
	}

	public function getAttributeSet() 
	{
		return $this->attributeSet;
	}

	public function getFdSet()
	{
		return $this->fdSet;
	}

	public function decomposeBCNF() 
	{
		return null;
	}

	public function decompose3NF()
	{
		return null;
	}

	public function calculateAKey()
	{
		$k = clone $this->attributeSet;
		foreach ($this->attributeSet->getAttributes() as $attribute) {
			$attrset = clone $k;
			$attrset->removeAttribute($attribute);
			$closure = $this->fdSet->calculateClosureOf($attrset);
			if($this->attributeSet->isSubsetOf($closure))
			{
				$k->removeAttribute($attribute);
			}
		}
		return $k;
	}

	public function calculateAllKey()
	{
		return null;
	}

	public function __toString()
	{
		return $this->attributeSet.$this->separator.$this->fdSet;
	}

	private $attributeSet;
	private $fdSet;
	private $separator;
}