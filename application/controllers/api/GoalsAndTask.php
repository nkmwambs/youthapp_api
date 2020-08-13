<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . '/libraries/REST_Controller.php');
class GoalsAndTask extends REST_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> database();
		$this -> load -> model('goalstask_model');

	}
	
	 public function insert_goals_post() {
        // Get the post goals in goal table
        $goal_name = strip_tags($this->post('goal_name'));
        $user_id = strip_tags($this->post('user_id'));
        $theme_id=strip_tags($this->post('theme_id'));
        $created_by = strip_tags($this->post('created_by'));
        $created_date = date("Y-m-d");
        $modified_date=date("Y-m-d H:i:s");
        
        // Insert user data
        $goalData = [
            'goal_name' => $goal_name,
            'user_id' => $user_id,
            'theme_id'=>$theme_id,
            'created_by' => $created_by,
            'created_date' => $created_date,
            'modified_date'=>$modified_date,
        ];

        $insert = $this->goalstask_model->insert_goals($goalData);

        if($insert){

             // Set the response and exit
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Your Goal has been saved',
                         'data' => $insert,
                    ], REST_Controller::HTTP_OK);

       }
        
        //Get the post tasks in tasks table
        
        
        
        // Validate the post data
    //     if(!empty($first_name)&& !empty($last_name) && !empty($email) && !empty($password)){
            
    //         // Check if the given email already exists
    //         $con['returnType'] = 'count';
    //         $con['conditions'] = array(
    //             'email' => $email,
    //         );
			
    //         $userCount = $this->user_model->getAllUsers($con);
            
    //         if($userCount > 0){
    //             // Set the response and exit
    //             $this->response(array('message'=>"The given email already exists."), REST_Controller::HTTP_BAD_REQUEST);
    //         }else{
    //             // Insert user data
    //             $userData = array(
    //                 'first_name' => $first_name,
    //                 'last_name' => $last_name,
    //                 'email' => $email,
    //                 'password' => md5($password),
    //                 'status'=>0,
    //                 'user_type' => 3,//Admin=1,2=You Specialist, 3=Student 
    //                 //'phone' => $phone
    //             );
    //             $insert = $this->user_model->insert($userData);
                
    //             // Check if the user data is inserted
    //             if($insert){
    //                 // Set the response and exit
    //                 $this->response([
    //                     'status' => TRUE,
    //                     'message' => 'Account created,Youth Specialist will activate you 48-72 hrs and u can login',
    //                     'data' => $insert
    //                 ], REST_Controller::HTTP_OK);
    //             }else{
    //                 // Set the response and exit
    //                 $this->response(
    //                            array(
    //                            'status'=> FALSE,
    //                            'message'=>"Some problems occurred, please try again."
							   
	// 						   ), REST_Controller::HTTP_BAD_REQUEST
	// 						   );
    //             }
    //         }
    //    }
    //     else{
    //         // Set the response and exit
    //         $this->response(
    //                array(
    //                'status'=> FALSE,
    //                'message'=>"Complete all user info to sign up."
	// 			   ), REST_Controller::HTTP_BAD_REQUEST
	// 			   );
    //     }
    }
    


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
