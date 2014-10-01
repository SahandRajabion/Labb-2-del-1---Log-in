<?php

class loginView{



private $model;
private $session = "userlogg";
private $user ="username";
private $pass ="password";
private $saveCookie = "saveinfo";
private $submit = "submit";
private $setCookieUser ="view::username";
private $setCookiePW ="view::password";
private $submitOut ="submitout";


public function __construct(loginModel $model){

$this-> model = $model;


}



public function usrNameTyped(){

if(isset($_POST[$this->user]) == true){

	return true;

}
return false;
}

public function passwordTyped(){

if(isset($_POST[$this->pass]) == true){

	return true;
}
return false;
}

public function getUserName(){

if($this->usrNameTyped() == true){

	return htmlentities($_POST[$this->user]);
}
}

public function getPassword(){

if($this->passwordTyped() == true){

	return htmlentities($_POST[$this->pass]);
}
}

public function userCheckedBox(){
	return isset($_POST[$this->saveCookie]);
}


public function userPressLogin(){

	if(isset($_POST[$this->submit]) == true){
		return true;
	}
return false;
}

public function ifUserPressLogin(){

return isset($_POST[$this->submit]);

}




//Visas vid default läge
public function showForm($test){

$ret = "";

//Ifall usrname + password är inskrivet i fälten och användaren efter submit fortfarande ej är inloggad :
if ($this -> getUserName() == true && $this -> getPassword() == true) {
			
			if ($this -> model -> ifUserLoggedIn() == false) {
				$ret .= " * Felaktigt användarnamn och/eller lösenord";
			}
		}

// Ifall usrname fältet står tomt efter submit
		if ($this -> ifUserPressLogin() == true) {
			
				if ($this -> usrNameTyped() == empty($_POST[$this->user]) ){
			$ret .= " * Användarnamnet måste anges" ."<br>";


		}
	}

//Ifall password fältet står tomt efter submit
		if ($this -> passwordTyped() == empty($_POST[$this->pass])) {
			$ret .= " * Lösenordet måste anges";
		}

		
//Ifall användare tryckt logga ut
		if (isset($_POST[$this->submitOut]) == true) {
		
			$ret .=" * Du är nu utloggad";
		}

		else{
			if ($this-> isSetcookie() == true && $test == false) {

			$ret .= "Fel cookie information";
			//ifall att cookies ändras i browsern så rensas dem och felmeddelande kommer fram
				setcookie($this->setCookieUser, "" , time() -1);
				setcookie($this->setCookiePW, "" , time() -1);
		}
	}
		

$res = "<form action ='' method='post'>
$ret
<h1>Ej inloggad</h1> <br/>
<fieldset>
<legend>Skriv in användarnamn och lösenord för att logga in</legend>



<label>Username :</label>
<input type='text' placeholder='Username' value='' name=".$this->user.">

<label>Password :</label>
<input type='password' placeholder='Password' value='' name=".$this->pass.">

<input type='checkbox' name=".$this->saveCookie." value='saveinfo'/>Håll mig inloggad

<br/><br/>

<input name=".$this->submit." type='submit' value='Logga in'>

</fieldset>

</form>";

return $res;

}


	public function getCryptPW(){
 		return crypt(md5($this->getPassword()));	
 	}


 	public function getCookieTimeStamp(){
 		return time() +60;
 	}



	public function setCookieIfChecked(){

	    if (isset($_POST[$this->saveCookie]) == true) {
	    	$timeStamp = $this-> getCookieTimeStamp();
	   	    $cookieUser = $this-> getUserName();
		    $cookiePass = $this-> getCryptPW();	
					
			setcookie($this->setCookieUser , $cookieUser, $timeStamp );
		 	setcookie($this->setCookiePW , $cookiePass, $timeStamp );

		 	$this-> model-> cookieFileWrite($cookiePass, $timeStamp);	
		  	return true;
		}
			return false;
	}
	public function usrRemoveCookie(){
			
			if ($this-> isSetcookie() == true) {
			if (isset($_POST[$this->submitOut]) == true) {
				setcookie($this->setCookieUser, "" , time() -1);
				setcookie($this->setCookiePW , "" , time() -1);
				unset($_SESSION[$this->session]);
				return true;
				}
				return false;
			}


}

	public function isSetcookie(){
		if(isset($_COOKIE[$this->setCookieUser]) && isset($_COOKIE[$this->setCookiePW])){

			return true;
		}

			return false;
	}


	public function getCookiePassword(){
		if ($this-> isSetcookie() == true) {
			# code...
			return $_COOKIE[$this->setCookiePW];
		}
	}

	public function getCookieUsername(){
		if ($this-> isSetcookie() == true) {
			# code...
			return $_COOKIE[$this->setCookieUser];
		}
	}

//Motverka SessionHiJacking
Public function checkSession(){
	return $_SERVER["HTTP_USER_AGENT"];
}

}







		

