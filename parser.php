<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

function getTable(){
	$tableFile = file_get_contents('wo_for_parse.html');
	$DOM = new DOMDocument;
	$DOM->preserveWhiteSpace = false;
	$DOM->formatOutput = true;
	$DOM->loadHTML($tableFile);
	$tableData = $DOM->getElementsByTagName('h3');

	$dataIndex = 0;	
	$dataValue = '';
	$dataArray = array();
	foreach ($tableData as $Data)
	{
		$dataValue = $Data->nodeValue; 
		
		$dataValue = preg_replace('/[[:blank:]]{3,}/', '', $dataValue);
		$dataValue = preg_replace('/(\n|\r)/', '  ', $dataValue);
		$dataValue = preg_replace('/( ){2,}/', ' ', $dataValue);
		$dataValue = preg_replace('/^( )/', '', $dataValue);
		$dataValue = preg_replace('/( )$/', '', $dataValue);		

		if ($dataIndex == 16){
			$strToArr = explode(' ', $dataValue); //zamiana wartości komórki tabeli z string do array
			$splitAddress = array_slice($strToArr, 0, 3);
			$splitAddress = implode(' ', $splitAddress);
			$splitAddress = array($splitAddress);
			array_push($splitAddress, $strToArr[4], $strToArr[5]);
			foreach ($splitAddress as $SA){
				$dataArray[$dataIndex] = $SA;
				$dataIndex++;
			}
		} elseif ($dataIndex == 3){
			$dataValue = strtotime($dataValue);
			$dataValue = date('Y-m-d H:i', $dataValue);
			$dataArray[$dataIndex] = $dataValue;
			$dataIndex++;
		} elseif ($dataIndex == 5){
			$dataValue = preg_replace('/\$|\,/', '', $dataValue);
			$dataArray[$dataIndex] = floatval($dataValue);
			$dataIndex++;
		} elseif ($dataIndex == 19){
			$dataValue = preg_replace('/\D/', '', $dataValue);
			$dataArray[$dataIndex] = floatval($dataValue);
			$dataIndex++;
		} else {
			$dataArray[$dataIndex] = $dataValue;
			$dataIndex++;
		}
	}
	$csvArray = array();
	$indexArr = array(0, 2, 3, 5, 10, 11, 14, 16, 17, 18, 19);
	foreach ($indexArr as $index){
		array_push($csvArray, $dataArray[$index]);
	}
	$csvHeaders = array( 'Customer', 'Trade', 'Date' , 'NTE (USD)', 'PO', 'Tracking No', 'Store ID', 'Street', 'State', 'Zip code', 'Phone');
	$csvFile = fopen('parsed.csv', 'w');
	
	fputcsv($csvFile, $csvHeaders, ",");
	fputcsv($csvFile, $csvArray, ",");
	fclose($csvFile);
	
	unset($dataIndex);
	
}
getTable();
?>

