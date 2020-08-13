<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Theme_model extends CI_Model
{


    /**
     * @author: Livingstone Onduso
     * @Date: 5/5/2020
     * @return: Array()
     * @param: $id Integer
     */
    function get_themes($id = 0)
    {

        $data = [];

        if (!empty($id)) {
            $data = $this->db->get_where("theme", ['theme_id' => $id])->row_array();
        } else {
            $data = $this->db->get("theme")->result();
        }

        return $data;
    }


    /**
     * @Todo to be implemented
    
     */

    public function insert_theme($data)
    {
        // //add created and modified date if not exists
        // if (!array_key_exists("created_date", $data)) {
        // 	$data['created_date'] = date("Y-m-d");
        // }
        // if (!array_key_exists("modified_date", $data)) {
        // 	$data['modified_date'] = date("Y-m-d H:i:s");
        // }

        // //insert user data to users table
        // $insert = $this -> db -> insert('user', $data);

        // //return the status
        // return $insert ? $this -> db -> insert_id() : false;
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

    /**
     * @Todo to be implemented
     * @author: Livingstone Onduso
     * @Date: 5/5/2020
    
     */
    public function delete_theme($id)
    {

        // $result = $this -> db -> query("delete from `user` where id = $id");

        // if ($result) {

        // 	return "Data is deleted successfully";

        // } else {

        // 	return "Error has occurred";

        // }

    }
}
