<?php


class loginModel{

private $username;
private $password;
private $cookieFilePassword;
private $cookieFileDate;
private $data = "data.txt";
private $cookieFile = "CookieFile.txt";
private $cookieTimeFile = "CookieTimeFile.txt";
private $session = "userlogg";


public function __construct(){
    @session_start();
	$this ->getFileInfo();
	$this->OpenCookieFileReadOnly();
	$this->OpenCookieFileReadDateOnly();
//	$this->cookieFilePassword = $_SERVER["HTTP_USER_AGENT"];
}






public function getFileInfo(){
if (file_exists($this->data)){
	$dataFile = $this->data;
	$fileOpen = fopen($dataFile, "r");
	$fileData = fread($fileOpen, 13);
	$this -> username = substr($fileData, 0,5);
	$this -> password = substr($fileData, 	5,8);
	fclose($fileOpen);
}

else {
	throw new Exception("Ett fel har skett vid hämtning av (data.txt), filen kunde ej hittas", 1);
 }

}



public function OpenCookieFileReadOnly(){
	if ($this-> IfPwFileIsEmpty() > 0) {
		$cookieFile = $this->cookieFile;
		$open = fopen($cookieFile, "r");
		$read = fread($open, filesize($cookieFile));
		fclose($open);
		$this-> cookieFilePassword = $read;
	    
	}
		return;
}

public function IfPwFileIsEmpty(){
		$filecheckPW = @file($this->cookieFile);
		if ($filecheckPW === false) {
			return 0;
		}
		return count($filecheckPW);
	}


public function OpenCookieFileReadDateOnly(){
	if ($this->IfDateFileisEmpty() > 0) {
		$CookieTime = $this->cookieTimeFile;
		$open = fopen($CookieTime, "r");
		$read = fread($open, filesize($CookieTime));
		fclose($open);
		$this-> cookieFileDate = $read;
	}
		return;
}

	public function IfDateFileisEmpty(){
		$fileCheckDate = @file($this->cookieTimeFile);
		if ($fileCheckDate == false) {
			return 0;
		}
		return count($fileCheckDate);
	}


public function cookieFileWrite($cookiePass , $timeStamp){
		$cookieFiletxt = $this->cookieFile;
		$openCookieFiletxt = fopen($cookieFiletxt, "w");
		$writeCrypto = fwrite($openCookieFiletxt, $cookiePass);
		fclose($openCookieFiletxt);

		$cookieTimeFile = $this->cookieTimeFile;
		$openCookieTimeFile = fopen($cookieTimeFile, "w");
		$writeTimeStamp = fwrite($openCookieTimeFile, $timeStamp);
		fclose($openCookieTimeFile);

}


public function checkInput($usrname, $password, $cookieUser, $cookiePass, $timeStamp, $sessionData){
	
	if(($usrname == $this -> username && $password == $this -> password) == true || 
 		$cookiePass == $this-> cookieFilePassword && $cookieUser == $this -> username && $timeStamp < (int)$this-> cookieFileDate) {

	//inloggning lyckades skicka vidare
		$_SESSION[$this->session] = $sessionData;
		return true;

	}
		return false;
	}



//Retunerar true / false beroende på om användaren blivit inloggad efter kontrollen.
public function ifUserLoggedIn(){
	if(isset($_SESSION[$this->session]) == true){
		return true;
	}

	return false;
}

/*Efter att kollat om användaren tryckt på logga ut knappen i andra vyn
 kallas denna metoden för att logga ut användare och unsetta sessionen.*/
public function loggingout(){
	unset($_SESSION[$this->session]);

}


//Kollar om nuvarande session i webbläsaren är den samma. 
public function checkCurrentSession($checkCurrentSession) {
		if ($checkCurrentSession == $_SESSION[$this->session]) {
			return true;
		}
		return false;
	}








	
}












