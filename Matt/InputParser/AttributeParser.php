<?php
namespace Matt\InputParser;
use \Matt\Attribute,
	\Matt\InputParser\Exceptions\AttributeSizeException,
	\Matt\InputParser\Exceptions\AttributeSetException;

class AttributeParser
{
	public function __construct($attrStr)
	{
		$this->attrStr = $attrStr;
		$this->attribute = $this->parse();
	}

	public function getAttribute()
	{
		return $this->attribute;
	}

	private function parse()
	{
		if (!preg_match("/[A-Za-z_]*/", $this->attrStr)) {
			throw new AttributeFormException();
			return null;
		}
		return new Attribute($this->attrStr);
	}

	private $attribute;
	private $attrStr;
}