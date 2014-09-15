<?php


require_once("common/HTMLView.php");
require_once("LogIn/src/controller/loginController.php");

$htmlView = new HTMLView();
$cont = new loginController();
$htmlBody = $cont->showLogin();


$htmlView = new HTMLView();
$htmlView->echoHTML($htmlBody);


var_dump($cont -> getuserandpass());
if($cont -> getuserandpass() == true){

$htmlView->echoHTML($htmlBody);



}

