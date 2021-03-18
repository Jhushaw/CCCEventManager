<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Http\BusinessService\CredentialsService;
use App\Http\Model\User;
use App\Http\Utillity\MyLogger;

class LoginController extends Controller{
	
	public function userLogin(Request $request){
		MyLogger::info("Entering LoginController.userLogin()");
		
		try{
			$this->validateForm($request);
			
			$username = $request->input("username");
			$password = $request->input("password");
			MyLogger::info("Paremeters: with data array" , array("username" => $username, "password" => $password));
			
			$user = new User(null, $username, $password, "", "", "", 0);
			
			$service = new CredentialsService();
			$status = $service->login($user);
			
			if($status){
				MyLogger::info("Exiting LoginController.userLogin with passed");
				return view('showEvents');
			}else{
				MyLogger::info("Exiting LoginController.userLogin with failed");
				return view('loginFailed');
			}
		}catch(ValidationException $e1){
			throw $e1;
		}catch(Exception $e){
			MyLogger::info("Exceptions", array("Message" =>$e->getMessage()));
			throw $e;
		}
	}
	
	//Clears the session so the user logs out
	public function logoutUser(){
		Session::flush();
		return view('showLogin');
	}
	
	private function validateForm(Request $request){
		$rules = ['username' => 'Required | Between:2,12',
				'password' => 'Required | Between:5,15'];
		
		//run data validation rules
		$this->validate($request, $rules);
	}
	
}
