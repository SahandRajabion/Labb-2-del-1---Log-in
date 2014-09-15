<?php

class loginView{



private $model;


public function __construct(loginModel $model){

$this->model = $model;

}


public function showForm(){


$ret = '<form action ="" method="post">

<h1>Ej inloggad</h1> <br/>
<fieldset>
<legend>Skriv in användarnamn och lösenord för att logga in</legend>
<label>Username :</label>
<input type="text" placeholder="Username" value="" name="username">

<label>Password :</label>
<input type="password" placeholder="Password" value="" name="password">

<input type="checkbox" name="saveinfo" value="saveinfo"/>Håll mig inloggad

<br/><br/>

<input name="submit" type="submit" value=" Logga in ">

</fieldset>

</form>';

return $ret;



}
//index

//controller -> model -> view 


/*public function checkFields(){

$res = '';
if(empty($_POST['username']))
    $res .= 'The username is required.<br>';
if(empty($_POST['password']))
    $res .= 'The password is required.<br>';  
if(empty($_POST['username']) && empty($_POST['password']))
    $res .= 'You need to enter username or password.<br>';
echo $res;

}*/
/*public function didUserLogIn(){

if (isset($_POST[logIn]))
	return true;
return false;

}*/


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


/*

public function chkCheckBox(){

if(isset($_POST["submit"]) == true){

	return true;
}
return false;
}
*/





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




















}