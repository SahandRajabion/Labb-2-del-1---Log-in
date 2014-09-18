<?php



class loginModel{

private $username;
private $password;



public function __construct(){

    @session_start();
	$this -> getFileInfo();

}


public function getFileInfo(){

if (file_exists("data.txt")){
$dataFile = "data.txt";
$fileOpen = fopen($dataFile, "r");
$fileData = fread($fileOpen, 13);
$this -> username = substr($fileData, 0,5);
$this -> password = substr($fileData, 5,8);
//var_dump($this -> username = substr($fileData, 0,5));
//var_dump($this -> password = substr($fileData, 5,8));


}

else {
	throw new Exception("Ett fel har skett vid hämtning av (data.txt), filen kunde ej hittas", 1);
 }

}





public function checkUserInput($username, $password){

//var_dump($password);
//var_dump($usrname == $this -> username && $password == $this -> password);
if($usrname == $this -> username && $password == $this -> password){

//inloggning lyckades skicka vidare
	$_SESSION['userSession'] = true;

}
	}


//Retunerar true / false beroende på om användaren blivit inloggad efter kontrollen.
	public function isResUserLoggedin(){
	if(isset($_SESSION['userSession']) == true){
		return true;
	}

	return false;
}


//Efter att kollat om användaren tryckt på logga ut knappen i andra vyn kallas denna metoden för att logga ut användare och unsetta sessionen.
public function loggingout(){
	unset($_SESSION['userSession']);
}


















	
}













