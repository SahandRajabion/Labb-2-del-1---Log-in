<?php

class loginView{



private $model;


public function __construct(loginModel $model){

$this->model = $model;

}



/*public function didUserLogIn(){

if (isset($_POST[logIn]))
	return true;
return false;

}*/


public function showResults(){


$ret = '<form action ="" method="post">

<h1>Ej inloggad</h1> <br/>
<fieldset>
<legend>Skriv in användarnamn och lösenord för att logga in</legend>
<label>Username :</label>
<input type="text" placeholder="Username" value="" name="username">

<label>Password :</label>
<input type="text" placeholder="Password" value="" name="password">

<input type="checkbox" name="saveinfo" value="saveinfo"/>Håll mig inloggad

<br/><br/>

<input name="submit" type="submit" value=" Logga in ">

</fieldset>

</form>';




return $ret;
}

}