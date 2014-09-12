<?php

require_once("LogIn/src/view/loginView.php");
require_once("LogIn/src/model/loginModel.php");



class LoginController {

private $view;
private $model;

public function __construct(){

$this->model = new loginModel();
$this->view = new loginView($this->model);   // ($this->model) gör så att vi kan använda värdet av model i LogInVIEW´n

}




//@return string HTML
public function displayLogin(){

return $this->view->showResults();

 //Hantera Indata
 //if($this->view->didUserLogIn()){
 //}
}














}

