<?php

//header("Content-Type: text/plain");

    $xml = file_get_contents('note_temp.xml'); // or http://path.to/file.xml
	
	//$temp = $xml;
    $myXmlString = str_replace('@Ime_u','Ana Antolić', $xml);
	file_put_contents('note.xml', $myXmlString);
	
	
	$xml = file_get_contents('note.xml'); // or http://path.to/file.xml
	$myXmlString = str_replace('ID_prebivaliste','Novi status', $xml);
	file_put_contents('note.xml', $myXmlString);
	
	$xml = file_get_contents('note.xml'); // or http://path.to/file.xml
	$myXmlString = str_replace( '@Ime_k','Majka Božja', $xml);
		file_put_contents('note.xml', $myXmlString);
	
	
	$xml = file_get_contents('note.xml'); // or http://path.to/file.xml
	$myXmlString = str_replace('ID_datum','21.12.2016', $xml);
	file_put_contents('note.xml', $myXmlString);
	
	
	
	
		$xml = file_get_contents('note.xml'); // or http://path.to/file.xml
	$myXmlString = str_replace('@P','Danas je bio na pregledu i bilo mu je baš ljepo. Nitko s enij ežali na ništai na nikakve bolove. Danas je bio na pregledu i bilo mu je baš ljepo.
	 Nitko s enij ežali na ništai na nikakve bolove. Danas je bio na pregledu i bilo mu je baš ljepo. 
	 Nitko s enij ežali na ništai na nikakve bolove. Danas je bio na pregledu i bilo mu je baš ljepo. Nitko s enij ežali na ništai na nikakve bolove.
	 Danas je bio na pregledu i bilo mu je baš ljepo. Nitko s enij ežali na ništai na nikakve bolove. Danas je bio na pregledu i bilo mu je baš ljepo. Nitko s enij ežali na ništai na nikakve bolove.',	 $xml);
		file_put_contents('note.xml', $myXmlString);
	
//var_dump($temp);
	//echo $temp;
	
	//$temp=simplexml_load_file(''); 
	//echo $temp->asXML();
	
	if (file_exists('note_temp.xml')) {
    $xml = simplexml_load_file('note_temp.xml');
 
    echo $xml;
} else {
    exit('Failed to open test.xml.');
}

	

?>