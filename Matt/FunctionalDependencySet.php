<?php 

namespace Matt;
use Matt\FunctionalDependency,
	Matt\AttributeSet;

class FunctionalDependencySet
{
	public function __construct()
	{
		$this->dependencies = array();
	}

	public function getDependencies()
	{
		return $this->dependencies;
	}

	public function addDependency(FunctionalDependency $fd)
	{
		if(!$this->contains($fd))
			array_push($this->dependencies, $fd);
	}

	public function count()
	{
		return count($this->dependencies);
	}

	public function removeDependency(FunctionalDependency $fd) 
	{
		if (($key = array_search($attr, $this->dependencies)) !== false) {
    		unset($this->dependencies[$key]);
		}
	}

	public function setLabel($label)
	{
		$this->label = $label;
	}

	public function calculateClosureOf(AttributeSet $attributeSet)
	{
		$closure = clone $attributeSet;
		foreach ($this->dependencies as $dependency) {
			if($dependency->getAlpha()->isSubsetOf($closure))
			{
				foreach ($dependency->getBeta()->getAttributes() as $attr) {
					$closure->addAttribute($attr);
				}
			}
		}
		return $closure;
	}

	public function contains(FunctionalDependency $fd)
	{
		return in_array($fd, $this->dependencies);
	}

	public function getLabel()
	{
		return $this->label;
	}

	public function __toString()
	{
		$res = "{";
		$i=1;
		foreach ($this->dependencies as $fd) {
			$res .= strval($fd);
			if($i<$this->count()) {
				$res .= ", ";
			}
			$i++;
		}
		return $res."}";
	}

	private $dependencies;
	private $label;
}