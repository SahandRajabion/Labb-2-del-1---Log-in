<?php


require_once("common/HTMLView.php");
require_once("LogIn/src/controller/loginController.php");

$htmlView = new HTMLView();
$Loginmodel = new Loginmodel();
$cont = new loginController();

$htmlBody = $cont->showForm();
//$htmlView -> echoHTML($htmlBody);



$showLoggedinView = $cont -> showLoggedin();

//Hämtar nödvändig info innan presentation av inloggad status nedan
$cont -> getTextfileInfo();
$cont -> getuserandpass();
if($cont -> isUserLoggedOut() == true){

$htmlView -> echoHTML($htmlBody);
}

if($cont -> isUserLoggedIn() == true){

$htmlView -> echoHTML($showLoggedinView);

}

else{
$htmlView -> echoHTML($htmlBody);

}














 