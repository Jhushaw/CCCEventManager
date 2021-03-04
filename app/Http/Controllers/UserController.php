<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;


class UserController extends Controller
{
    
    
    /**
     * Validates the Login Form
     *
     * @param
     * Request
     */
    private function loginValidateForm(Request $request)
    {
        $rules = [
            'username' => 'Required | Max:30',
            'password' => 'Required | Between:5,30'
        ];
        
        $this->validate($request, $rules);
    }
    
    
    /**
     * Logs user in, set up session, send login credentials to dao
     * @param Request $request
     * @throws ValidationException
     * @throws Exception
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function Login(Request $request)
    {
        // trys to validate throws validation error if failed rules
        try {
            $this->loginValidateForm($request);
        } catch (ValidationException $e1) {
            throw $e1;
        }
        try {
            //get fields from view
            $userN = $request->input('username');
            $uPass = $request->input('password');
            //$userN = $userN->strtolower();
            
            if ($userN == "jacob@gmail.com" && $uPass == "hushaw"){
                return view('showEvents');
            } else {
                return view('showLogin')->with('msg', 'Login failed please try again');
            }
        }
             catch (Exception $e2) {
            throw $e2;
        }
    }
}
