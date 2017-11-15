<html>
 <head>
  <title>addQuestions</title>
 </head>
 <body>
 	<table>
		<tr align = "center">
 <?php 
	session_start();
	include 'dbConfig.php';
	$korreo = $_SESSION['email'];
	$galderak = $_POST['galdera'];
	$eZuzena = $_POST['zuzena'];
	$eOkerra1 = $_POST['okerra1'];
	$eOkerra2 = $_POST['okerra2'];
	$eOkerra3 = $_POST['okerra3'];
	$zailtasuna = $_POST['zaila'];
	$gaiak = $_POST['gaia'];
	
	if ($korreo == 'undefined' || $korreo === null || $korreo === ''){echo "Zerbitzariko segurtasunak dio:Sartu baliozko korreoa!";return false;};
	if ($galderak == 'undefined' || $galderak === null || $galderak === ''){echo "Zerbitzariko segurtasunak dio:Sartu baliozko galdera bat!";return false;};
	if ($eZuzena == 'undefined' || $eZuzena === null || $eZuzena === ''){echo "Zerbitzariko segurtasunak dio:Sartu baliozko erantzun zuzen bat!";return false;};
	if ($eOkerra1 == 'undefined' || $eOkerra1 === null || $eOkerra1 === ''){echo "Zerbitzariko segurtasunak dio:Sartu baliozko lehenengo erantzun okerra!";return false;};
	if ($eOkerra2 == 'undefined' || $eOkerra2 === null || $eOkerra2 === ''){echo "Zerbitzariko segurtasunak dio:Sartu baliozko bigarrengo erantzun okerra!";return false;};
	if ($eOkerra3 == 'undefined' || $eOkerra3 === null || $eOkerra3 === ''){echo "Zerbitzariko segurtasunak dio:Sartu baliozko hirugarrengo erantzun okerra!";return false;};
	if ($zailtasuna == 'undefined' || $zailtasuna === null || $zailtasuna === '' || $zailtasuna>5 ||$zailtasuna<1){echo "Zerbitzariko segurtasunak dio:Sartu baliozko zailtasun bat!";return false;};
	if ($gaiak == 'undefined' || $gaiak === null || $gaiak === ''){echo "Zerbitzariko segurtasunak dio:Sartu baliozko galderaren gai arloa!";return false;};
	
	if (!preg_match('/[a-z]+[0-9]{3}@ikasle\.ehu\.(eus|es)/', $korreo)){
		echo "Zerbitzariko segurtasunak dio: Korrea ez dago zuzen idatzita!";
		return false;
	}

	$mysqli = new mysqli($zerbitzaria,$erabiltzailea,$pasahitza,$db);
	
	$emaitza = $mysqli->query("INSERT INTO questions (Korreoa,Galdera,Erantzun_ona, Erantzun_okerra_1, Erantzun_okerra_2, Erantzun_okerra_3,Zailtasuna,Gai_arloa) VALUES ('$korreo','$galderak','$eZuzena','$eOkerra1','$eOkerra2','$eOkerra3','$zailtasuna','$gaiak')");
	
	if ($emaitza==TRUE) {
?>
		<td colspan="3">Datuak ondo gorde dira datu basean</td>
<?php
	}else{
		echo "Error: " . $emaitza . "<br>" . $mysqli->error;
	}
	
	$mysqli->close();

	$assessmentItems = simplexml_load_file('questions.xml');
	$assessmentItem = $assessmentItems->addChild('assessmentItem');
	$assessmentItem->addAttribute('complexity',$zailtasuna);
	$assessmentItem->addAttribute('subject',$gaiak);
	$itemBody = $assessmentItem->addChild('itemBody');
	$itemBody->addChild('p',$galderak);
	$correctResponse = $assessmentItem->addChild('correctResponse');
	$correctResponse->addChild('value',$eZuzena);
	$incorrectResponse = $assessmentItem->addChild('incorrectResponse');
	$incorrectResponse->addChild('value',$eOkerra1);
	$incorrectResponse->addChild('value',$eOkerra2);
	$incorrectResponse->addChild('value',$eOkerra3);
	$assessmentItems->asXML('questions.xml');
		
 ?>
	</table>
 </body>
</html>