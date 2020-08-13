<?php

defined('BASEPATH') or exit('No direct script access allowed');

class GoalsTask_model extends CI_Model
{

    
     /**
     * @Todo to be implemented
    
     */

    public function insert_goals($data)
    {
        //add created and modified date if not exists
        if (!array_key_exists("created_date", $data)) {
        	$data['created_date'] = date("Y-m-d");
        }
        if (!array_key_exists("modified_date", $data)) {
        	$data['modified_date'] = date("Y-m-d H:i:s");
        }

        

        //insert user data to users table
        $insert = $this -> db -> insert('goal', $data);

        //return the status
        return $insert ? $this -> db -> insert_id() : false;
    }
    
    /**
     * @author: Livingstone Onduso
     * @Date: 12/8/2020
     * @return: Array()
     * @param: $id Integer
     */
    function get_goals($id = 0)
    {

        $data = [];

        if (!empty($id)) {
            $data = $this->db->get_where("goal", ['goal_id' => $id])->row_array();
        } else {
            $data = $this->db->get("goal")->result();
        }

        return $data;
    }


   

    /**
     * @Todo to be implemented
     * @author: Livingstone Onduso
    
     */

    public function update_theme($id, $data)
    {

        // $this -> name = $data['name'];
        // // please read the below note

        // $this -> password = $data['pass'];

        // $this -> user_type = $data['type'];

        // $result = $this -> db -> update('user', $this, array('id' => $id));

        // if ($result) {

        // 	return "Data is updated successfully";

        // } else {

        // 	return "Error has occurred";

        // }

    }

   
}
