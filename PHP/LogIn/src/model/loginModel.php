<?php


class loginModel{

private $username;
private $password;
private $cookieFilePassword;
private $cookieFileDate;


public function __construct(){
    @session_start();
	$this -> getFileInfo();
	$this->OpenCookieFileReadOnly();
	$this->OpenCookieFileReadDateOnly();
}



public function getFileInfo(){
if (file_exists("data.txt")){
	$dataFile = "data.txt";
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
		$cookieFile = "CookieFile.txt";
		$open = fopen($cookieFile, "r");
		$read = fread($open, filesize($cookieFile));
		fclose($open);
		$this-> cookieFilePassword = $read;
	    
	}
		return;
}

public function IfPwFileIsEmpty(){
		$filecheckPW = @file("CookieFile.txt");
		if ($filecheckPW === false) {
			return 0;
		}
		return count($filecheckPW);
	}


public function OpenCookieFileReadDateOnly(){
	if ($this->IfDateFileisEmpty() > 0) {
		$CookieTime = "CookieTimeFile.txt";
		$open = fopen($CookieTime, "r");
		$read = fread($open, filesize($CookieTime));
		fclose($open);
		$this-> cookieFileDate = $read;
	}
		return;
}

	public function IfDateFileisEmpty(){
		$fileCheckDate = @file("CookieTime.txt");
		if ($fileCheckDate == false) {
			return 0;
		}
		return count($fileCheckDate);
	}


public function cookieFileWrite($cookiePass , $timeStamp){
		$cookieFiletxt = "CookieFile.txt";
		$openCookieFiletxt = fopen($cookieFiletxt, "w");
		$writeCrypto = fwrite($openCookieFiletxt, $cookiePass);
		fclose($openCookieFiletxt);

		$cookieTimeFile = "CookieTimeFile.txt";
		$openCookieTimeFile = fopen($cookieTimeFile, "w");
		$writeTimeStamp = fwrite($openCookieTimeFile, $timeStamp);
		fclose($openCookieTimeFile);

}


public function checkInput($usrname, $password, $cookieUser, $cookiePass, $timeStamp){
	//$this ->  $passcrypto = $cookiePw;
	//var_dump($this-> cookieFilePassword);
	//var_dump($cookiePw);
	//var_dump((int)$this->cookieFileDate);
	if(($usrname == $this -> username && $password == $this -> password) == true ||
 		$cookiePass == $this-> cookieFilePassword && $cookieUser == $this -> username && $timeStamp < (int)$this-> cookieFileDate  ) {

	//inloggning lyckades skicka vidare
		$_SESSION['userlogg'] = true;
		return true;

	}
		return false;
	}



//Retunerar true / false beroende på om användaren blivit inloggad efter kontrollen.
public function ifUserLoggedIn(){
	if(isset($_SESSION['userlogg']) == true){
		return true;
	}

	return false;
}

/*Efter att kollat om användaren tryckt på logga ut knappen i andra vyn
 kallas denna metoden för att logga ut användare och unsetta sessionen.*/
public function loggingout(){
	unset($_SESSION['userlogg']);
}








	
}












