<?php
namespace Matt\InputParser;
use \Matt\AttributeSet,
	\Matt\InputParser\Exceptions\AttributeFormException,
	\Matt\InputParser\AttributeParser;

class AttributeSetParser
{
	public function __construct($attrStr)
	{
		$this->attrStr = $attrStr;
		$this->attributeSet = $this->parse();
	}

	public function getAttributeSet()
	{
		return $this->attributeSet;
	}

	private function parse()
	{
		$this-> attrStr = preg_replace("/[^A-Za-z_]/", " ", $this->attrStr);
		$this->attrStr = trim($this->attrStr);
		$this-> attrStr = preg_replace("/( )+/", " ", $this->attrStr);
		if (!preg_match("/[A-Z ]*/", $this->attrStr)) {
			throw new AttributeSetFormException();
			return null;
		}
		$bits = explode(" ", $this->attrStr);
		$set = new AttributeSet();
		foreach ($bits as $bit) {
			try {
				$p = new AttributeParser($bit);
			} catch(AttributeFormException $ex) {
				throw $ex;
				return null;
			}
			$set->addAttribute($p->getAttribute());
		}
		return $set;
	}

	private $attributeSet;
	private $attrStr;
}