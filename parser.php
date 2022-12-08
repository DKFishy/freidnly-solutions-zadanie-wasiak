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
	//$tableHeaders = $DOM->getElementsByTagName('div');
	$tableData = $DOM->getElementsByTagName('h3');
	$dataIndex = 0;
	
	foreach ($tableData as $Data)
	{ 
		$dataIndex++;
		echo '<pre>'; 
		$Data->nodeValue = preg_replace('/[[:blank:]]{3,}/', '', $Data->nodeValue);
		$Data->nodeValue = preg_replace('/(\n|\r)/', '  ', $Data->nodeValue);
		$Data->nodeValue = preg_replace('/( ){2,}/', ' ', $Data->nodeValue);
		$Data->nodeValue = preg_replace('/^( )/', '', $Data->nodeValue);
		echo "[" . $dataIndex, "]" . $Data->nodeValue; 
		echo '</pre>'; 
	}
	
	/*foreach ($tableHeaders as $Header)
	{ 
		echo '<pre>'; 
		echo preg_replace('/[[:blank:]]{3,}/', '', $Header->nodeValue); 
		echo '</pre>'; 
	}*/
}
getTable();
?>

