<?php

class loginView{



private $model;


public function __construct(loginModel $model){

$this->model = $model;

}


//Visas vid default läge
public function showForm(){

$ret = "";

if ($this -> getUserName() == true && $this -> getPassword() == true) {
			
			if ($this -> model -> isResUserLoggedin() == false) {
			
				$ret .= " * Felaktigt användarnamn och/eller lösenord";
			}
		}

		if ($this -> usrPressLogin() == true) {
			
				if ($this -> usrNameTyped() == empty($_POST['username']) ){
		
			$ret .= " * Användarnamnet måste anges" ."<br>";


		}
	}
		if ($this -> passwordTyped() == empty($_POST['password'])) {
			
			$ret .= " * Lösenordet måste anges";
		}

		
		if (isset($_POST['submitout']) == true) {
		
			$ret .=" * Du är nu utloggad";
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

public function ifUserPressLogin(){

	if(isset($_POST['submit']) == true){
		return true;
	}
return false;
}

public function usrPressLogin(){

return isset($_POST['submit']);

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

	return $_POST["username"];
}
}



public function getPassword(){

if($this->passwordTyped() == true){

	return $_POST["password"];
}
}











/*public function diduserpresskeep(){

if(isset($_POST['saveinfo'])){

	return true;
}

return false;
}

public function usrCheckedIT(){
	return isset($_POST['saveinfo']);
}
*/










}