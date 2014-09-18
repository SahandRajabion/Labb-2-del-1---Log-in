<?php

class loggedInView{

 private $Model;
 private $View;
 

public function __construct(loginModel $model){
 		$this -> model = $model;	
 		$this -> View = new loginView($this -> model);
 	}


 public function showLoggedinView(){

 	$ret ="";

 	if ($this -> View -> getUserName() == true && $this -> View -> getPassword() == true) {
 		# code...
 		$ret .= "Inloggningen lyckades";
 	}
 		$loggedInRes = "
 		<form action='' method='POST' >
 				 <h1>Laboration Del 1 Login</h1>
 				  $ret
 				 <h2>Admin är nu inloggad</h2>
 				 </br>
 				 </br>
 				 <input type='submit' name='submitout' value='Logga ut'/>
 				 </br>
 				 </form>";
 
 		return $loggedInRes;	

	 }

 	

 	public function ifUsrPressLogout(){
 	
	 	if (isset($_POST['submitout']) == true) {
 		# code...
 			return true;
 		
 		}
 			return false;
 	}

}