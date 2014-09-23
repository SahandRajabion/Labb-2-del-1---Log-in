<?php

class loggedInView{

 private $Model;
 private $View;
 private $submitOut ="submitout";
 

public function __construct(loginModel $Model){
 		$this -> Model = $Model;	
 		$this -> View = new loginView($this -> Model);
 	}


 public function showLoggedinView($test){

 	$ret ="";

  	 if ($this->  View -> userCheckedBox() == false &&
  		 $this -> View -> getUserName() == true && 
   		 $this -> View -> getPassword() == true) {
 		# code...
 		$ret .= "Inloggningen lyckades";
 	}
 


 	if ($this -> View -> userCheckedBox() == true && 
 		$this -> View -> ifUserPressLogin() == true &&
 	    $this -> Model -> ifUserLoggedIn() == true){
 			$ret .= "Inloggning lyckades och vi kommer ihåg dig nästa gång";
 		}
 	

 	if ($this -> View -> isSetcookie() == true && $test == true) {
 
 			$ret .= "Inloggning lyckades via cookies";
 		}
 		
 	


 		$loggedInRes = "
 		<form action='' method='POST' >
 				 <h1>Laboration Del 1 Login</h1>
 				  $ret
 				 <h2>Admin är nu inloggad</h2>
 				 </br>
 				 </br><br>
 				 <input type='submit' name=".$this->submitOut." value='Logga ut'/>
 				 </br><br><br>
 				 </form>";
 
 		return $loggedInRes;	

	 }

 	

 	public function ifUsrPressLogout(){
 	
	 	if (isset($_POST[$this->submitOut]) == true) {
 		
 			return true;
 		
 		}
 			return false;
 	}

}