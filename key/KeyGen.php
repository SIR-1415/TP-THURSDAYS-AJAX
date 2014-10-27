<?php
// class CKeyGen

class CKeyGen {
	
	const NN = 5;
	const NS = 2;
	const MAXN = 50;
	const MINN = 1;
	const MAXS = 11;
	const MINS = 1;
	
	public $numbers;
	public $stars;
	
	public function __construct() {
		$this->genKey();
	}

	public function genKey() {
		$extN = new CExtractor(CKeyGen::NN, CKeyGen::MINN, CKeyGen::MAXN);
		$this->numbers = $extN->extract();
		$extS = new CExtractor(CKeyGen::NS, CKeyGen::MINS, CKeyGen::MAXS);
		$this->stars = $extS->extract();
	}
	
	public function key2UL() {
		$html = "";
		$html .= "<ul class='numeros'>";
		for($i =0; $i< CKeyGen::NN; $i++) {
			$html .= "<li>".$this->numbers[$i]."</li>";
		}
		$html .= "</ul>";
		
		$html .= "<ul class='estrelas'>";
		for($i =0; $i< CKeyGen::NS; $i++) {
			$html .= "<li>".$this->stars[$i]."</li>";
		}
		$html .= "</ul>";
		return $html;
	}
	
	public function Key2XML() {
		$xml = new SimpleXMLElement("<chave></chave>");
		$node_numbers 	= $xml->addChild("numeros");
			foreach ($this->numbers as  $number) {
				$node_numbers->addChild("num",$number);
			}
		$node_stars		= $xml->addChild("estrelas");
			foreach ($this->stars as  $star) {
				$node_stars->addChild("num",$star);
			}
		return $xml->asXML();
	}
	
	public function Key2JSON() {
		return json_encode($this);
	}
	
}
class CExtractor {
	private $min;
	private $max;
	private $next;
	
	public function __construct($_next, $_min, $_max) {
		$this->min  = $_min;
		$this->max  = $_max;
		$this->next	= $_next;
	}
	
	public function extract() {
		$bag  = array();
		$nels = $this->max - $this->min + 1;
		for($i=0; $i < $nels; $i++) {
			$bag[$i] = $this->min + $i;
		}
		//var_dump($bag);
		$key = array();
		for($i=0; $i<$this->next; $i++) {
			$idx = rand(0,count($bag)-1);
			$key[$i] = $bag[$idx];
			array_splice($bag,$idx,1);
		}
		sort($key);
		//var_dump($key);
		return $key;
	}
}
?>