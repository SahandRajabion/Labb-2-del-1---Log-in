<?php


require_once("common/HTMLView.php");
require_once("LogIn/src/controller/loginController.php");

$htmlView = new HTMLView();
$Loginmodel = new Loginmodel();
$cont = new loginController();

$htmlBody = $cont->displayshowForm();
//$htmlView -> echoHTML($htmlBody);



//$showLoggedinView = $cont -> showLoggedin();

//Hämtar nödvändig info innan presentation av inloggad status nedan

$htmlView -> echoHTML($htmlBody);






//LC_ALL = All of the below in swedish.
setlocale(LC_ALL, 'swedish');
//"%A = full textual representation of the current day".
$currentDay = utf8_encode(ucfirst(strftime("%A")));
//Presents a string with information of the current day, date and time in chosen format (%d, %B, %Y, %X).
echo ucwords(strftime($currentDay .'en. Den %d %B år %Y. Klockan är [%X].'));









 