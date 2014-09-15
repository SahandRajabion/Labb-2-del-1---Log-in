<?php



class loginModel{

private $username;
private $password;



public function __construct(){

	$this -> getFileInfo();

}


public function getFileInfo(){

if (file_exists("data.txt")){
$dataFile = "data.txt";
$fileOpen = fopen($dataFile, "r");
$fileData = fread($fileOpen, 13);
$this -> username = substr($fileData, 0,5);
$this -> password = substr($fileData, 5,8);
var_dump($this -> username = substr($fileData, 0,5));
var_dump($this -> password = substr($fileData, 5,8));


}

else {
	throw new Exception("Ett fel har skett vid hämtning av (data.txt), filen kunde ej hittas", 1);
 }

}



public function checkUsrInput($usrname, $password){

//var_dump($password);
var_dump($usrname == $this -> username && $password == $this -> password);
if($usrname == $this -> username && $password == $this -> password){

//inloggning lyckades skicka vidare
	return  true;

}

//else did not work

	}





















	
}















	/*$info = @file)("userinfo.txt");

	if($info === FALSE){
	//code
}
	return $info;*/