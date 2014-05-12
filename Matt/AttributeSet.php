<?php 

namespace Matt;
use \Matt\Attribute;

class AttributeSet
{
	public function __construct()
	{
		$this->attributes = array();
	}

	public function getAttributes()
	{
		return $this->attributes;
	}

	public function addAttribute(Attribute $attr)
	{
		if (!$this->contains($attr))
			array_push($this->attributes, $attr);
	}

	public function count()
	{
		return count($this->attributes);
	}

	public function removeAttribute(Attribute $attr) 
	{
		if (($key = array_search($attr, $this->attributes)) !== false) {
    		unset($this->attributes[$key]);
		}
	}

	public function contains(Attribute $anAttr)
	{
		return in_array($anAttr, $this->attributes);
	}

	public function equals(AttributeSet $other)
	{
		$attrSet = clone $other;
		if($this->count() !== $attrSet->count())
			return FALSE;
		foreach ($this->attributes as $attr) {
			if(!$attrSet->contains($attr))
				return FALSE;
		}
		foreach ($attrSet->getAttributes() as $attr) {
			if(!$this->contains($attr))
				return FALSE;
		}
		return TRUE;
	}

	public function isSubsetOf(AttributeSet $attrSet)
	{
		foreach ($this->attributes as $attribute) {
			if(!$attrSet->contains($attribute))
				return FALSE;
		}
		return TRUE;
	}

	public function __toString()
	{
		$res = "{";
		$i=1;
		foreach ($this->attributes as $attr) {
			$res .= strval($attr);
			if($i<$this->count()) {
				$res .= ", ";
			}
			$i++;
		}
		return $res."}";
	}

	private $attributes;
}