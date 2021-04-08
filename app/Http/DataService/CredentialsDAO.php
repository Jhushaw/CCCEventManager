<?php
namespace App\Http\DataService;

use App\Http\Model\User;
use App\Http\Utillity\DatabaseException;
use App\Http\Utillity\MyLogger;
use Illuminate\Support\Facades\Session;
use PDO;
use PDOException;

/* Connects to the database to authenticate users */

//security class that creates or findes user depending on which method is requested from previous service
class CredentialsDAO{
    
    private $conn;
    public function __construct($conn){
        $this->conn = $conn;
    }
    
    /**
     * finds users in database and returns true if found
     * @param User $user
     * @throws DatabaseException
     * @return boolean
     */
    public function findUser(User $user){    
        MyLogger::info("Entering CredentialsDAO.findUser()");
        
        try{
        	//Select username and password and see if this row exists
        	$name = $user->getUsername();
        	$pw = $user->getPassword();
        	
        	$stmt = $this->conn->prepare("SELECT * FROM users WHERE USERNAME = :username AND PASSWORD = :password LIMIT 1");
        	$stmt->bindParam(':username', $name);
        	$stmt->bindParam(':password', $pw);
        	$stmt->execute();
        	
        	//See if user existed and return true if found else return false if not found
        	//Bad practice: this is a business rules in our DAO
        	if ($stmt->rowCount() == 1){
        		MyLogger::info("Exit CredentialsDAO.findUser() with true");
        		$row = $stmt->fetch(PDO::FETCH_ASSOC);
        		$fetchedUser = new User($row["ID"], $row['USERNAME'], $row['PASSWORD'], $row['FIRSTNAME'], $row['LASTNAME'], $row['EMAIL'], $row['PHONENUM']);
        		//put user in session
        		Session::put('User',$fetchedUser);
        		Session::put('Admin', $row["ADMIN"]);
        		return true;  		
        	}else{
        		MyLogger::info("Exit CredentialsDAO.findUser() with false");
        		return false;
        	}      	
        }catch (PDOException $e){
        	//BEST practice: catch all exceptions (do not swallow exceptions),
        	//log the exception, do not throw technology specific exceptions, and throw a cusom exception
        	MyLogger::error("Exception: ", array("message" => $e->getMessage()));
        	throw new DatabaseException("Database Exception " . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * creates a user in database and returns true if it was added successfully
     * @param User $user
     * @throws DatabaseException
     * @return boolean
     */
    public function createUser(User $user){
    	MyLogger::info("Entering CredentialsDAO.createUser()");
    	
    	try{
    		//Select username and password and see if this row exists
    		$name = $user->getUsername();
    		$pw = $user->getPassword();
    		$fname = $user->getFirstName();
    		$lname = $user->getLastName();
    		$email = $user->getEmail();
    		$phone = $user->getPhoneNumber();
    		//create a prepared statment. Pass valus by binding pararmeters one by one
    		$stmt = $this->conn->prepare("INSERT INTO users (ID, FIRSTNAME, LASTNAME, EMAIL, USERNAME, PASSWORD, PHONENUM) VALUES (null,?, ?, ?, ?, ?, ?)");
    		$stmt->bindParam(1, $fname);
    		$stmt->bindParam(2, $lname);
    		$stmt->bindParam(3, $email);
    		$stmt->bindParam(4, $name);
    		$stmt->bindParam(5, $pw);
    		$stmt->bindParam(6, $phone);
    		$stmt->execute();
    		
    		//check if changes were made
    		if ($stmt->rowCount() == 1){
    			MyLogger::info("Exit CredentialsDAO.createUser() with true");
    			return true;
    		}else{
    			MyLogger::info("Exit CredentialsDAO.createUser() with false");
    			return false;
    		}
    	}catch (PDOException $e){
    		//log exception and throw a custom exception
    		MyLogger::error("Exception: ", array("message" => $e->getMessage()));
    		throw new DatabaseException("Database Exception " . $e->getMessage(), 0, $e);
    	}
    }

}