<?php
namespace App\Http\Model;
//user model class outlines all event data
class Event {
	private $title;
	private $description;
	private $date;
	private $url;	

	//constructor method
	public function __construct($title,$description,$date,$url){
		$this->title = $title;
		$this->description= $description;
		$this->date = $date;
		$this->url = $url;
	}	
	
	//getter methods for all user variables
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