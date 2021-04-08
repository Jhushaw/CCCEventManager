<?php
namespace App\Http\Controllers;

use App\Http\Utillity\MyLogger;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\BusinessService\CredentialsService;
use App\Http\Model\User;
use App\Http\BusinessService\EventsService;

class RegisterController extends Controller{
	/**
	 * 
	 * @param Request $request
	 * @throws ValidationException
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function userRegister(Request $request){
		MyLogger::info("Entering RegisterController.userRegister()");
		
		try{
			$this->validateForm($request);
			$firstname = $request->input("firstname");
			$lastname = $request->input("lastname");
			$username = $request->input("username");
			$password = $request->input("password");
			$email = $request->input("email");
			$phonenumber = $request->input("phonenum");
			
			MyLogger::info("Paremeters: with data array" , array("username" => $username, "password" => $password, "firstname" => $firstname, "lastname" => $lastname));
			
			$user = new User(-1, $username, $password, $firstname, $lastname, $email, $phonenumber);
			
			$service = new CredentialsService();
			$status = $service->register($user);
			
			if($status){
				MyLogger::info("Exiting RegisterController.userRegister with passed");
				$data = ['model' => $user];
				$eventService = new EventsService();
				// status should hold all events
				$eventStatus = $eventService->getAllEvents();
				
				if($eventStatus){
				    MyLogger::info("Exiting LoginController.userLogin with events");
				    // should be an event in the session variable for event
				    $data = ['model' => $user, 'events' => $eventStatus];
				    return view('showEvents')->with($data);
				}else{
				    MyLogger::info("Exiting LoginController.userLogin with no events");
				    $data = ['model' => $user, 'events' => array()];
				    return view('showEvents')->with($data);
				}
				// register passed view does not yet exist
				// return view('registerPassed')->with($data);
			}else{
				MyLogger::info("Exiting RegisterController.userRegister with failed");
				return view('registerFailed');
			}
		}catch(ValidationException $e1){
			throw $e1;
		}
	}
	/**
	 * 
	 * @param Request $request
	 */
	private function validateForm(Request $request){
		$rules = ['firstname' => 'Required | Between:2,18',
				'lastname' => 'Required | Between:2,18',
				'email' => 'Required | Between:5,25',
				'phonenum' => 'Required',
				'username' => 'Required | Between:4,15',
				'password' => 'Required | Between:4,15'];
		
		//run data validation rules
		$this->validate($request, $rules);
	}
	
}
