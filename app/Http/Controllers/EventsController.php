<?php
namespace App\Http\Controllers;

use App\Http\Utillity\MyLogger;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Http\Model\Event;
use App\Http\BusinessService\EventsService;

class EventsController extends Controller{
	public function createEvent(Request $request){
		MyLogger::info("Entering EventsController.createEvent()");
		
		try{
			// $this->validateForm($request);
			$url = $request->input("url");
			$title = $request->input("title");
			$date = $request->input("date");
			$description = $request->input("description");
			
			MyLogger::info("Paremeters: with data array" , array("url" => $url, "title" => $title, "date" => $date, "description" => $description));
			
			
			$event = new Event($title, $description, $date, $url);
			
			$service = new EventsService();
			
			$status = $service->createEvent($event);
			//adding a comment
			
			if($status){
				MyLogger::info("Exiting EventsController.createEvent with passed");
				$data = ['event' => $event];
				return view('showEvents')->with($data);
			}else{
				MyLogger::info("Exiting EventsController.createEvent with failed");
				return view('createEventFailed');
			}
		}catch(ValidationException $e1){
			throw $e1;
		}
	}
	
	public function showEvent($id) {
		MyLogger::info("Entering EventsController.showEvent()");
		
		try{
			// MyLogger::info("Paremeters: with data array" , array("username" => $username, "password" => $password));
			
			$service = new EventsService();
			$status = $service->findEvent($id);
			
			if($status){
				MyLogger::info("Exiting LoginController.userLogin with passed");
				// should be an event in the session variable for event
				return view('showOneEventDetailed')->with('ChosenEvent', $status);
			}else{
				MyLogger::info("Exiting LoginController.userLogin with failed");
				return view('showEvents');
			}
		}catch(ValidationException $e1){
			throw $e1;
		}catch(Exception $e){
			MyLogger::info("Exceptions", array("Message" =>$e->getMessage()));
			throw $e;
		}
	}
}