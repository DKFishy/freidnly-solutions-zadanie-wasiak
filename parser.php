<?php

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
	$dataValue = '';
	$dataArray = array();
	foreach ($tableData as $Data)
	{ 
		echo '<pre>'; 
		$dataValue = $Data->nodeValue; 
		
		$dataValue = preg_replace('/[[:blank:]]{3,}/', '', $dataValue);
		$dataValue = preg_replace('/(\n|\r)/', '  ', $dataValue);
		$dataValue = preg_replace('/( ){2,}/', ' ', $dataValue);
		$dataValue = preg_replace('/^( )/', '', $dataValue);
		$dataValue = preg_replace('/( )$/', '', $dataValue);		

		if ($dataIndex == '16'){
			$splitAddArr = explode(' ', $dataValue); //zamiana string do array
			foreach ($splitAddress as $SA){
				$dataArray[$dataIndex] = $SA;
				$dataIndex++;
			}
			
		} else {
			$dataArray[$dataIndex] = $dataValue;
			$dataIndex++;
		}
		
		
		//echo $dataIndex . ' ' . $dataValue;
		echo '</pre>'; 
		/*$dataArray[$dataIndex] = $dataValue;
		$dataIndex++;*/
	}
	echo '<pre>'; print_r($dataArray); echo '</pre>';
	$unset($dataIndex);
	
	/*foreach ($tableHeaders as $Header)
	{ 
		echo '<pre>'; 
		echo preg_replace('/[[:blank:]]{3,}/', '', $Header->nodeValue); 
		echo '</pre>'; 
	}*/
}
getTable();
?>

