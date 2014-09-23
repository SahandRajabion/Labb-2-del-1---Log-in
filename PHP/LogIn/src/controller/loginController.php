<?php

require_once("LogIn/src/view/loginView.php");
require_once("LogIn/src/model/loginModel.php");
require_once("LogIn/src/view/loggedInView.php");


class LoginController {

private $view;
private $model;
private $loggedInView;
private $test = false;

public function __construct(){


$this-> model = new loginModel();
$this-> view = new loginView($this->model);   // ($this->model) gör så att vi kan använda värdet av model i LogInVIEW´n
$this -> loggedInView = new loggedInView($this -> model);

}


public function displayshowForm(){
	$this->checkUserLoggedOut();
if($this-> view-> usrRemoveCookie()==  true){
	 $this-> view-> showForm($this-> test);
}
if($this-> view-> userPressLogin() == true &&
	$this-> model-> ifUserLoggedIn() == true ||
		$this-> view -> isSetcookie() == true &&
		$this-> model-> ifUserLoggedIn() == true){
$this-> test;
}

else{
	
	$this-> test = $this-> setCookieIfuserchecked();
}


if ($this-> model-> ifUserLoggedIn() == true) {
    return $this->loggedInView->showLoggedinView($this->test);
	}

else{

	return $this-> view->showForm($this->test);
	}	

}

//Kollar om användaren tryckt på logga ut knappen i andra vyn vid redan inloggad status.
public function checkUserLoggedOut(){  	
  	if($this -> loggedInView -> ifUsrPressLogout() == true){
     $this -> model -> loggingout();
  	}
  }

//Hämtar input och kontrollerar den
public function getUsrAndPW(){
$usrname = $this-> view-> getUsername();
$password = $this-> view-> getPassword();
$cookieUser = $this-> view-> getCookieUsername();
$cookiePass = $this-> view -> getCookiePassword();
$timeStamp = time();

return $this-> model -> checkInput($usrname, $password, $cookieUser, $cookiePass , $timeStamp);
	
}

public function setCookieIfuserchecked(){

	if($this-> getUsrAndPW() == true){
		if ($this-> view -> userCheckedBox() == true){

			$this-> view-> setCookieIfChecked();
		}
		return true;
	}

	return false;
}
}

