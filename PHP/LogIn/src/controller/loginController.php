<?php

require_once("LogIn/src/view/loginView.php");
require_once("LogIn/src/model/loginModel.php");
require_once("LogIn/src/view/loggedInView.php");


class LoginController {

private $view;
private $model;
private $loggedInView;

public function __construct(){

$this-> model = new loginModel();
$this-> view = new loginView($this->model);   // ($this->model) gör så att vi kan använda värdet av model i LogInVIEW´n
$this -> loggedInView = new loggedInView($this -> model);
}



//@return string HTML
//Default läge
public function showForm(){

return $this-> view->showForm();

}


//Hämtar file data
public function getTextfileInfo(){

$this-> model->getFileInfo();

}


//Om användaren tryckt på logga in knappen = hämta input och kontrollera den
public function userPressLogin(){

	if($this -> view -> ifUserPressLogin()){

		$this -> getuserandpass();
	}
}


//Hämtar input och kontrollerar den
public function getuserandpass(){

$username = $this-> view-> getUsername();
$password = $this-> view-> getPassword();

 $this-> model -> checkUserInput($username, $password);

}




//Kollar om användaren blivit inloggad eller inte efter att kontrollen gått igenom
public function isUserLoggedIn(){

	return $this -> model -> isResUserLoggedin();
}

//När användare loggat in
public function showLoggedin(){

return $this-> loggedInView->showLoggedinView();

}


//Kollar om användaren tryckt på logga ut knappen i andra vyn vid redan inloggad status
public function isUserLoggedOut(){
  	
  	if($this -> loggedInView -> ifUsrPressLogout() == true){

     $this -> model -> loggingout();

  	}



}


}

