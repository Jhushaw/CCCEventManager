<?php
namespace App\Http\Model;
//user model class outlines all user data
class User {
	private $userId = null;
	private $username;
	private $password;
	private $firstName;
	private $lastName;
	private $email;
	private $phoneNumber;
	
	//constructor method
	public function __construct($id,$uname,$pswd,$fname,$lname,$email,$phoneNum){
		$this->userId = $id;
		$this->username = $uname;
		$this->password= $pswd;
		$this->firstName = $fname;
		$this->lastName = $lname;
		$this->email = $email;
		$this->phoneNumber = $phoneNum;
	}	
	//getter methods for all user variables
	public function getUserId() {
		return $this->userId;
	}
	public function getUsername() {
		return $this->username;
	}
	public function getPassword() {
		return $this->password;
	}
	public function getFirstName() {
		return $this->firstName;
	}
	public function getLastName() {
		return $this->lastName;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getPhoneNumber() {
		return $this->phoneNumber;
	}
	//setter methods for all user variables
	public function setUsername($username) {
		$this->username = $username;
	}
	public function setPassword($password) {
		$this->password = $password;
	}
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}
	public function setEmail($email) {
		$this->email = $email;
	}
	public function setPhoneNumber($phoneNumber) {
		$this->phoneNumber = $phoneNumber;
	}
	//toString method to print all user variables
	public function toString(){
		return " User Id: ". $this->userId." | Username: ". $this->username." | Password: ". $this->password." | firstName: ". $this->firstName." | lastName: ". $this->lastName." | age: ". $this->age." | address: ". $this->address." | email: ". $this->email." | phonenumber: ". $this->phoneNumber;
	}
	
}
?>