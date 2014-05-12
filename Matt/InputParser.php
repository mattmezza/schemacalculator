<?php

namespace Matt;
use Matt\FunctionalDependency,
	Matt\Set;

class InputParser
{
	public function __construct($F, $G) 
	{
		$this->F_input = str_replace(" ", "", $F);
		$this->G_input = str_replace(" ", "", $G);
	}

	public function getFSetObject()
	{
		$set = new Set("F");
		$fds = explode(",", $this->F_input);
		foreach ($fds as $sfd) {
			$fd = $this->parseFunctionalDependency($sfd);
			$set->addDependency($fd);
		}
		return $set;
	}

	public function getGSetObject()
	{
		$set = new Set("G");
		$fds = explode(",", $this->G_input);
		foreach ($fds as $sfd) {
			$fd = $this->parseFunctionalDependency($sfd);
			$set->addDependency($fd);
		}
		return $set;
	}

	private function parseFunctionalDependency($sfd)
	{
		$members = explode("->", $sfd);
		$fd = new FunctionalDependency();
		$fd->__set('alpha', $members[0]);
		$fd->__set('beta', $members[1]);
		return $fd;
	}

	private $F_input;
	private $G_input;
}