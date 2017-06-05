<?php


    $xml = file_get_contents('UGOVOR.xml'); // or http://path.to/file.xml
    $myXmlString = str_replace('@Ime_u','Ana Antolić', $xml);
	file_put_contents('UGOVOR1.xml', $myXmlString);
	
	
	
	
	$xml = file_get_contents('UGOVOR1.xml'); // or http://path.to/file.xml
	$myXmlString = str_replace('ID_datum','21.12.2016', $xml);
	file_put_contents('UGOVOR1.xml', $myXmlString);
	
	$xml = file_get_contents('UGOVOR1.xml'); // or http://path.to/file.xml
	$myXmlString = str_replace('ID_prebivaliste','Varaždin', $xml);
	file_put_contents('UGOVOR1.xml', $myXmlString);
	
	
	$xml = file_get_contents('UGOVOR1.xml'); // or http://path.to/file.xml
	$myXmlString = str_replace( '@Ime_k','Majka Božja', $xml);
	file_put_contents('UGOVOR1.xml', $myXmlString);
	
	$xml = file_get_contents('UGOVOR1.xml'); // or http://path.to/file.xml
	$myXmlString = str_replace('@Ime_a','22.12.2016', $xml);
	file_put_contents('UGOVOR1.xml', $myXmlString);
	
		$xml = file_get_contents('UGOVOR1.xml'); // or http://path.to/file.xml
	$myXmlString = str_replace('ID1prebivaliste','Zagreb', $xml);
	file_put_contents('UGOVOR1.xml', $myXmlString);
	
		$xml = file_get_contents('UGOVOR1.xml'); // or http://path.to/file.xml
	$myXmlString = str_replace('ID_br_osobne','12345687954', $xml);
	file_put_contents('UGOVOR1.xml', $myXmlString);
	
		$xml = file_get_contents('UGOVOR1.xml'); // or http://path.to/file.xml
	$myXmlString = str_replace('ID_iznos','4200', $xml);
	file_put_contents('UGOVOR1.xml', $myXmlString);
	
		$xml = file_get_contents('UGOVOR1.xml'); // or http://path.to/file.xml
	$myXmlString = str_replace('ID_2_datum_poc','01-01-2011', $xml);
	file_put_contents('UGOVOR1.xml', $myXmlString);
	
?>