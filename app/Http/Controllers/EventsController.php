<?php
namespace App\Http\Controllers;

use App\Http\Utillity\MyLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Http\Model\Event;
use App\Http\BusinessService\EventsService;

class EventsController extends Controller{
	public function createEvent(Request $request){
		MyLogger::info("Entering EventsController.createEvent()");
		
		try{
			$this->validateForm($request);
			$url = $request->input("url");
			$title = $request->input("title");
			$date = $request->input("date");
			$description = $request->input("description");
			$capacity = $request->input("capacity");
			
			MyLogger::info("Paremeters: with data array" , array("url" => $url, "title" => $title, "date" => $date, "description" => $description));
			
			
			$event = new Event($title, $description, $date, $url, $capacity, null);
			
			$service = new EventsService();
			
			$status = $service->createEvent($event);
			
			if($status){
				MyLogger::info("Exiting EventsController.createEvent with passed");
				$data = $service->getAllEvents();
				return view('showEvents')->with('events', $data);
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
			$status->setID($id);
			$attending = $service->findAttend($id);
			if($status){
				MyLogger::info("Exiting LoginController.userLogin with passed");
				// should be an event in the session variable for event
				return view('showOneEventDetailed')->with('ChosenEvent', $status)->with('attending',$attending);
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
	
	public function showAllEvents() {
	    try{
	        $service = new EventsService();
	        // status should hold all events
	        $status = $service->getAllEvents();
	        
	        if($status){
	            MyLogger::info("Exiting EventsController.showAllEvents with passed");
	            // should be an event in the session variable for event
	            return view('showEvents')->with('events', $status);
	        }else{
	            MyLogger::info("Exiting LoginController.userLogin with failed");
	            return view('showEvents')->with('events', array());
	        }
	    }catch(ValidationException $e1){
	        throw $e1;
	    }catch(Exception $e){
	        MyLogger::info("Exceptions", array("Message" =>$e->getMessage()));
	        throw $e;
	    }
	}
	
	public function deleteEvent(Request $request){
	    MyLogger::info("Entering EventsController.deleteEvent()");
	    
	    try{
	        $id = $request->input("id");

	        
	        $service = new EventsService();
	        
	        $status = $service->deleteEvent($id);
	        
	        if($status){
	            MyLogger::info("Exiting EventsController.deleteEvent with passed");
	            return $this->showAllEvents();
	        }else{
	            MyLogger::info("Exiting EventsController.deleteEvents with failed");
	            return view('error')->with('msg', 'Failed to Delete an Event');
	        }
	    }catch(ValidationException $e1){
	        throw $e1;
	    }
	}
	
	public function showEditEvent(Request $request){
	    MyLogger::info("Entering EventsController.showEditEvent()");
	    
	    try{
	        $id = $request->input("id");
	        $url = $request->input("url");
	        $title = $request->input("title");
	        $date = $request->input("date");
	        $description = $request->input("description");
	        $capacity = $request->input("capacity");
	        
	        $event = new Event($title, $description, $date, $url, $capacity, null);
	        $event->setID($id);
	        
	        MyLogger::info("Exiting EventsController.showEditEvent with failed");
	        return view('showEditEvent')->with('event', $event);
	        
	    }catch(ValidationException $e1){
	        throw $e1;
	    }
	}
	
	public function editEvent(Request $request){
	    MyLogger::info("Entering EventsController.editEvent()");
	    
	    try{
	        $this->validateForm($request);
	        $id = $request->input("id");
	        $url = $request->input("url");
	        $title = $request->input("title");
	        $date = $request->input("date");
	        $description = $request->input("description");
	        $capacity = $request->input("capacity");
	        
	        MyLogger::info("Paremeters: with data array" , array("url" => $url, "title" => $title, "date" => $date, "description" => $description));
	        
	        $event = new Event($title, $description, $date, $url, $capacity, null);
	        $event->setID($id);
	        $service = new EventsService();
	        
	        $status = $service->editEvent($event);
	        
	        if($status){
	            MyLogger::info("Exiting EventsController.editEvent with passed");
	            return $this->showAllEvents();
	        }else{
	            MyLogger::info("Exiting EventsController.editEvent with failed");
	            return view('error')->with('msg', 'Failed to edit an Event');
	        }
	    }catch(ValidationException $e1){
	        throw $e1;
	    }
	}
	
	public function attendEvent(Request $request){
		MyLogger::info("Entering EventsController.attendEvent()");
		
		try{
		    $this->validateAttendForm($request);
			$eventID = $request->input("eventID");
			$attendents = $request->input("attendents");

			//MyLogger::info("Paremeters: with data array" , array("EventId: " => $eventID, "#ofAttendents: " => $attendents));
			
			$service = new EventsService();
			$status = $service->attendEvent($eventID, $attendents);
			
			if($status){
				MyLogger::info("Exiting EventsController.attendEvent with success");
				return $this->showAllEvents();
			}else{
				MyLogger::info("Exiting EventsController.attendEvent with failed");
				return view('error')->with('msg', 'You already attend this event');
			}
		}catch(ValidationException $e1){
			throw $e1;
		}
	}
	
	public function unattendEvent(Request $request){
		MyLogger::info("Entering EventsController.unattendEvent()");
		
		try{
			$eventID = $request->input("eventID");
			$currentAttendies = $request->input("currentAttendies");
			//MyLogger::info("Paremeters: with data array" , array("EventId: " => $eventID));
			
			$service = new EventsService();
			$status = $service->unattendEvent($eventID, $currentAttendies);
			
			if($status){
				MyLogger::info("Exiting EventsController.unattendEvent with success");
				return $this->eventsAttending();
			}else{
				MyLogger::info("Exiting EventsController.unattendEvent with failed");
				return view('error')->with('msg', 'You can not unattend this event');
			}
		}catch(ValidationException $e1){
			throw $e1;
		}
	}
	
	public function eventsAttending() {
		try{
			$service = new EventsService();
			//status should hold all attending events
			$status = $service->eventsAttending();
			
			if($status){
				MyLogger::info("Exiting EventsController.eventsAttending with passed");
				// should be an event in the session variable for event
				return view('showEvents')->with('events', $status);
			}else{
				MyLogger::info("Exiting EventsController.eventsAttending with failed");
				return view('showEvents')->with('events', array());
			}
		}catch(ValidationException $e1){
			throw $e1;
		}catch(Exception $e){
			MyLogger::info("Exceptions", array("Message" =>$e->getMessage()));
			throw $e;
		}
	}
	
	private function validateForm(Request $request){
	    $rules = ['url' => 'Required',
	        'title' => 'Required',
	        'date' => 'Required',
	        'description' => 'Required',
	        'capacity' => 'Required'];
	    
	    //run data validation rules
	    $this->validate($request, $rules);
	}
	
	private function validateAttendForm(Request $request){
	    $rules = ['attendents' => 'Required'];
	    
	    //run data validation rules
	    $this->validate($request, $rules);
	}

	
}