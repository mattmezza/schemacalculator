<?php 

namespace Matt;

class Attribute
{
	public function __construct($identifier)
	{
		$this->identifier = $identifier;
	}

	public function getIdentifier() 
	{
		return $this->identifier;
	}

	public function setIdentifier($identifier) 
	{
		$this->identifier = $identifier;
	}

	public function __toString()
	{
		return $this->identifier;
	}

	public function equals(Attribute $other)
	{
		return $this->identifier===$other->getIdentifier();
	}

	private $identifier;
}