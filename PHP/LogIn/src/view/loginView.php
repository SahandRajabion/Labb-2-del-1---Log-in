<?php

class loginView{



private $model;



public function __construct(loginModel $model){

$this-> model = $model;
//var_dump($this-> checkCookiePW());
//var_dump($this-> checkCookieUsr());
//var_dump($this->getCookieUsername());
//var_dump($this->getCookiePassword());
}



public function usrNameTyped(){

if(isset($_POST["username"]) == true){

	return true;

}
return false;
}

public function passwordTyped(){

if(isset($_POST["password"]) == true){

	return true;
}
return false;
}

public function getUserName(){

if($this->usrNameTyped() == true){

	return htmlentities($_POST["username"]);
}
}

public function getPassword(){

if($this->passwordTyped() == true){

	return htmlentities($_POST["password"]);
}
}

public function userCheckedBox(){
	return isset($_POST['saveinfo']);
}


public function userPressLogin(){

	if(isset($_POST['submit']) == true){
		return true;
	}
return false;
}

public function ifUserPressLogin(){

return isset($_POST['submit']);

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
			
				if ($this -> usrNameTyped() == empty($_POST['username']) ){
			$ret .= " * Användarnamnet måste anges" ."<br>";


		}
	}

//Ifall password fältet står tomt efter submit
		if ($this -> passwordTyped() == empty($_POST['password'])) {
			$ret .= " * Lösenordet måste anges";
		}

		
//Ifall användare tryckt logga ut
		if (isset($_POST['submitout']) == true) {
		
			$ret .=" * Du är nu utloggad";
		}

		else{
			if ($this-> isSetcookie() == true && $test == false) {

			$ret .= "Fel cookie information";
				//setcookie('view::username', "" , time() -1);
				//setcookie('view::password', "" , time() -1);
		}
	}
		

$res = "<form action ='' method='post'>
$ret
<h1>Ej inloggad</h1> <br/>
<fieldset>
<legend>Skriv in användarnamn och lösenord för att logga in</legend>



<label>Username :</label>
<input type='text' placeholder='Username' value='' name='username'>

<label>Password :</label>
<input type='password' placeholder='Password' value='' name='password'>

<input type='checkbox' name='saveinfo' value='saveinfo'/>Håll mig inloggad

<br/><br/>

<input name='submit' type='submit' value='Logga in'>

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
//var_dump(isset($_POST['saveinfo']));
//var_dump($this->getCookiePassword());
	//var_dump($this->checkCookiePW());
	//var_dump($this->getP());

				//var_dump($cookiePass);
	    if (isset($_POST['saveinfo']) == true) {
	    	$timeStamp = $this-> getCookieTimeStamp();
	   	    $cookieUser = $this-> getUserName();
		    $cookiePass = $this-> getCryptPW();		
					
			setcookie('view::username' , $cookieUser, $timeStamp);
		 	setcookie('view::password' , $cookiePass, $timeStamp);

		 	$this-> model-> cookieFileWrite($cookiePass, $timeStamp);	
		  	return true;
		}
			return false;
	}
public function usrRemoveCookie(){
			
			if ($this-> isSetcookie() == true) {
			if (isset($_POST['submitout']) == true) {
				setcookie('view::username', "" , time() -1);
				setcookie('view::password' , "" , time() -1);
				unset($_SESSION['userlogg']);
				return true;
				}
				return false;
			}


}
	public function isSetcookie(){
		if(isset($_COOKIE['view::username']) && isset($_COOKIE['view::password'])){

			return true;
		}

			return false;
	}


	public function getCookiePassword(){
		if ($this-> isSetcookie() == true) {
			# code...
			return $_COOKIE['view::password'];
		}
	}

	public function getCookieUsername(){
		if ($this-> isSetcookie() == true) {
			# code...
			return $_COOKIE['view::username'];
		}
	}




}
		

