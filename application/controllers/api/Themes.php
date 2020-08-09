<?php
   
   require APPPATH . 'libraries/REST_Controller.php';
  // use Restserver\Libraries\REST_Controller;

  //END point uri: http://localhost/youthapp_api/index.php/api/goals
     
class Themes extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
	public function themesdata_get($id = 0)
	{
        if(!empty($id)){
            $data = $this->db->get_where("theme", ['theme_id' => $id])->row_array();
        }else{
            $data = $this->db->get("theme")->result();
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
	}
      
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_post()
    {
        $input = $this->input->post();
        $this->db->insert('theme',$input);
     
        $this->response(['themes created successfully.'], REST_Controller::HTTP_OK);
    } 
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('theme', $input, array('theme_id'=>$id));
     
        $this->response(['theme updated successfully.'], REST_Controller::HTTP_OK);
    }
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_delete($id)
    {
        $this->db->delete('theme', array('id'=>$id));
       
        $this->response(['themes deleted successfully.'], REST_Controller::HTTP_OK);
    }
    	
}





// <?php
//    
   // require APPPATH . 'libraries/REST_Controller.php';
  // // use Restserver\Libraries\REST_Controller;
// 
  // //END point uri: http://localhost/youthapp_api/index.php/api/goals
//      
// class Goals extends REST_Controller {
//     
	  // /**
     // * Get All Data from this method.
     // *
     // * @return Response
    // */
    // public function __construct() {
       // parent::__construct();
       // $this->load->database();
    // }
//        
    // /**
     // * Get All Data from this method.
     // *
     // * @return Response
    // */
	// public function index_get($id = 0)
	// {
        // if(!empty($id)){
            // $data = $this->db->get_where("goals", ['id' => $id])->row_array();
        // }else{
            // $data = $this->db->get("goals")->result();
        // }
//      
        // $this->response($data, REST_Controller::HTTP_OK);
	// }
//       
    // /**
     // * Get All Data from this method.
     // *
     // * @return Response
    // */
    // public function index_post()
    // {
        // $input = $this->input->post();
        // $this->db->insert('goals',$input);
//      
        // $this->response(['Goals created successfully.'], REST_Controller::HTTP_OK);
    // } 
//      
    // /**
     // * Get All Data from this method.
     // *
     // * @return Response
    // */
    // public function index_put($id)
    // {
        // $input = $this->put();
        // $this->db->update('goals', $input, array('id'=>$id));
//      
        // $this->response(['Goals updated successfully.'], REST_Controller::HTTP_OK);
    // }
//      
    // /**
     // * Get All Data from this method.
     // *
     // * @return Response
    // */
    // public function index_delete($id)
    // {
        // $this->db->delete('goals', array('id'=>$id));
//        
        // $this->response(['Goals deleted successfully.'], REST_Controller::HTTP_OK);
    // }
//     	
// }