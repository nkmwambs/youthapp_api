<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . '/libraries/REST_Controller.php');
class Users extends REST_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> database();
		$this -> load -> model('user_model');

	}
	

	public function login_post() {

		$email = $this -> post('email');
		$password = $this -> post('password');

		if (!empty($email) && !empty($password)) {
			$con['returnType'] = 'single';
			$con['conditions'] = array('email' => $email, 'password' => md5($password),
			//'status'=>1

			);
			$user = $this -> user_model -> login($con);

			if ($user) {
				$this -> response(array('status' => TRUE, 'message' => 'user login successful', 'data' => $user), REST_Controller::HTTP_OK);

			} else {
				$this -> response(array('status' => FALSE, 'message' => 'Invalid password and/or email'), REST_Controller::HTTP_OK);
			}
		}

	}
	
	 public function user_registration_post() {
        // Get the post data
        $first_name = strip_tags($this->post('first_name'));
		$last_name = strip_tags($this->post('last_name'));
        $email = strip_tags($this->post('email'));
        $password = $this->post('password');
		
        
        
        // Validate the post data
        if(!empty($first_name)&& !empty($last_name) && !empty($email) && !empty($password)){
            
            // Check if the given email already exists
            $con['returnType'] = 'count';
            $con['conditions'] = array(
                'email' => $email,
            );
			
            $userCount = $this->user_model->getAllUsers($con);
            
            if($userCount > 0){
                // Set the response and exit
                $this->response(array('message'=>"The given email already exists."), REST_Controller::HTTP_BAD_REQUEST);
            }else{
                // Insert user data
                $userData = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'password' => md5($password),
                    'status'=>0,
                    'user_type' => 3,//Admin=1,2=You Specialist, 3=Student 
                    //'phone' => $phone
                );
                $insert = $this->user_model->insert($userData);
                
                // Check if the user data is inserted
                if($insert){
                    // Set the response and exit
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Account created,Youth Specialist will activate you 48-72 hrs and u can login',
                        'data' => $insert
                    ], REST_Controller::HTTP_OK);
                }else{
                    // Set the response and exit
                    $this->response(
                               array(
                               'status'=> FALSE,
                               'message'=>"Some problems occurred, please try again."
							   
							   ), REST_Controller::HTTP_BAD_REQUEST
							   );
                }
            }
       }
        else{
            // Set the response and exit
            $this->response(
                   array(
                   'status'=> FALSE,
                   'message'=>"Complete all user info to sign up."
				   ), REST_Controller::HTTP_BAD_REQUEST
				   );
        }
    }
    

	// public function sign_up_post() 
	// {
		// $data = array(
		            // 'name' => $this -> input -> post('name'), 
		            // 'password' => md5($this -> input -> post('password')),
		            // 'email' =>$this -> input -> post('email'),
		            // 'user_type' => 'Student',
					// 'created_by'=> 1);
// 					
		// $user = $this -> user_model -> insert($data);
		// $this -> response($user);
		// // if($user){
// // 			
			// // $this -> response(
			 // // array(
// // 			 
			 // // 'message'=>'Data is inserted successfully',
// // 			 
			 // // )
// // 			
// // 			
			// // );
// // 			
		// // }
		// // else{
// // 			
			// // $this -> response(
			 // // array(
// // 			 
			 // // 'message'=>'Data not saved. Error occured',
// // 			 
			 // // )
// // 			
// // 			
			// // );
// // 			
		// // }
// 		
	// }

	public function user_put() {
		$id = $this -> uri -> segment(3);

		$data = array('name' => $this -> input -> get('name'), 'pass' => $this -> input -> get('pass'), 'type' => $this -> input -> get('type'));

		$r = $this -> user_model -> update($id, $data);
		$this -> response($r);
	}

	public function user_post() {
		$data = array('name' => $this -> input -> post('name'), 'pass' => $this -> input -> post('pass'), 'type' => $this -> input -> post('type'));
		$r = $this -> user_model -> insert($data);
		$this -> response($r);
	}

	public function user_delete() {
		$id = $this -> uri -> segment(3);
		$r = $this -> user_model -> delete($id);
		$this -> response($r);
	}

}
