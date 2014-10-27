<?php
class NumberGenerator {
		
	public $number;
	
	function __construct($s) {
		while (count($this->number) < $s) {
			$this->number[] = rand(1,10);
		}
	}
	
	function asJSON() {
		return json_encode($this);
	}
	
}

$size = $_GET["size"];
//$size = 6;
$nn = new NumberGenerator($size);
echo  $nn->asJSON();

?>

