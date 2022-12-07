<?php
//include_once ("wo_for_parse.html");

function r_2($val){
	echo '<pre>' ;print_r ($val); echo '</pre>';
}

function getTable(){
	$tableFile = file_get_contents('wo_for_parse.html');
	$DOM = new DOMDocument;
	$DOM->preserveWhiteSpace = false;
	$DOM->formatOutput = true;
	$DOM->loadHTML($tableFile);
	$tableHeaders = $DOM->getElementsByTagName('div');
	$tableData = $DOM->getElementsByTagName('h3');
	
	
	/*print_r ($tableHeaders);
	echo '<br>';
	print_r ($tableData);
	echo '<br><br>';*/
	
	foreach ($tableData as $Data)
	{ 
		echo '<pre>'; 
		echo preg_replace('/[[:blank:]]{3,}/', '', $Data->nodeValue); 
		echo '</pre>'; 
	}
	
	foreach ($tableData as $Data)
	{ echo '<pre>'; print_r($Data); echo '</pre>'; }
}

getTable();
?>

