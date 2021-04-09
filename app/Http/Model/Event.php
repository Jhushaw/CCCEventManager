<?php
namespace App\Http\Model;
//user model class outlines all event data
class Event {
    private $id;
	private $title;
	private $description;
	private $date;
	private $url;	
    private $capacity;
    private $currentattendies;


    //constructor method
	public function __construct($title,$description,$date,$url,$capacity,$currentattendies){
		$this->title = $title;
		$this->description= $description;
		$this->date = $date;
		$this->url = $url;
		$this->capacity = $capacity;
		$this->currentattendies = $currentattendies;
	}	
	
	//getter methods for all user variables
	
	
	/**
	 * @return mixed
	 */
	public function getCapacity()
	{
	    return $this->capacity;
	}
	
	/**
	 * @return mixed
	 */
	public function getCurrentattendies()
	{
	    return $this->currentattendies;
	}
	
	/**
	 * @param mixed $capacity
	 */
	public function setCapacity($capacity)
	{
	    $this->capacity = $capacity;
	}
	
	/**
	 * @param mixed $currentattendies
	 */
	public function setCurrentattendies($currentattendies)
	{
	    $this->currentattendies = $currentattendies;
	}
	
	public function getID(){
	    return $this->id;
	}
	
	public function setID($id){
	    $this->id = $id;	    
	}
	public function getTitle() {
		return $this->title;
	}
	public function getDescription() {
		return $this->description;
	}
	public function getDate() {
		return $this->date;
	}
	public function getUrl() {
		return $this->url;
	}
	//setter methods for all user variables
	public function setTitle($title) {
		$this->title = $title;
	}
	public function setDescription($description) {
		$this->description = $description;
	}
	public function setDate($date) {
		$this->date = $date;
	}
	public function setUrl($url) {
		$this->url = $url;
	}
	//toString method to print all user variables
	public function toString(){
		return "Title: ". $this->title." | description: ". $this->description." | date: ". $this->date." | url: ". $this->url;
	}
	
}
?>