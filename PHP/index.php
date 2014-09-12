<?php


require_once("common/HTMLView.php");
require_once("LogIn/src/controller/loginController.php");



session_start();

$cont = new loginController();
$htmlBody = $cont->displayLogin();


$htmlView = new HTMLView();
$htmlView->echoHTML($htmlBody);






