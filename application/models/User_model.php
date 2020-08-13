<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

	/**
	 * @author: Livingstone Onduso
	 * @Date: 5/5/2020
	 * @return: Array()
	 * @param: $params Array()
	 */
	function getAllUsers($params = array())
	{

		$this->db->select('*');
		$this->db->from('user');

		//fetch data by conditions
		if (array_key_exists("conditions", $params)) {
			foreach ($params['conditions'] as $key => $value) {
				$this->db->where($key, $value);
			}
		}

		if (array_key_exists("user_id", $params)) {
			$this->db->where('user_id', $params['user_id']);
			$query = $this->db->get();
			$result = $query->row_array();
		} else {
			//set start and limit
			if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
				$this->db->limit($params['limit'], $params['start']);
			} elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
				$this->db->limit($params['limit']);
			}

			if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
				$result = $this->db->count_all_results();
			} elseif (array_key_exists("returnType", $params) && $params['returnType'] == 'single') {
				$query = $this->db->get();
				$result = ($query->num_rows() > 0) ? $query->row_array() : false;
			} else {
				$query = $this->db->get();
				$result = ($query->num_rows() > 0) ? $query->result_array() : false;
			}
		}

		//return fetched data
		return $result;
	}
	/**
	 * @author: Livingstone Onduso
	 * @Date: 5/5/2020
	 * @return: Array()
	 * @param: $param Array()
	 */
	public function login($params = array())
	{

		$this->db->select('*')->from('user');

		if (array_key_exists('conditions', $params)) {
			foreach ($params['conditions'] as $key => $value) {

				$this->db->where($key, $value);
			}
		}
		if (array_key_exists('id', $params)) {
			$query = $this->db->where('id', $params['id'])->get();
			$result = $query->row_array();
		} else {
			if (array_key_exists("start", $params) && array_key_exists('limit', $params)) {
				$this->db->limit($params['limit'], $params['start']);
			} elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
				$this->db->limit($params['limit']);
			}
			if (array_key_exists('returnType', $params) && $params['returnType'] == 'count') {
				$result = $this->db->count_all_results();
			} elseif (array_key_exists('returnType', $params) && $params['returnType'] == 'single') {
				$query = $this->db->get();
				$result = ($query->num_rows() > 0) ? $query->result_array() : false;
			} else {
				$query = $this->db->get();
				$result = ($query->num_rows() > 0) ? $query->row_array() : false;
			}
		}
		return $result;
	}
	/**
	 * @author: Livingstone Onduso
	 * @Date: 5/5/2020
	 * @return: boalean
	 * @param: $param Array()
	 */
	public function insert($data)
	{
		//add created and modified date if not exists
		if (!array_key_exists("created_date", $data)) {
			$data['created_date'] = date("Y-m-d");
		}
		if (!array_key_exists("modified_date", $data)) {
			$data['modified_date'] = date("Y-m-d H:i:s");
		}

		//insert user data to users table
		$insert = $this->db->insert('user', $data);

		//return the status
		return $insert ? $this->db->insert_id() : false;
	}

	/**
	 * @author: Livingstone Onduso
	 * @Date: 5/5/2020
	 * @return: String
	 * @param: $id Integer, $data Array()
	 */

	public function update($id, $data)
	{

		$this->name = $data['name'];

		$this->password = $data['pass'];

		$this->user_type = $data['type'];

		$result = $this->db->update('user', $this, array('id' => $id));

		if ($result) {

			return "Data is updated successfully";
		} else {

			return "Error has occurred";
		}
	}
	/**
	 * @author: Livingstone Onduso
	 * @Date: 5/5/2020
	 * @return: String
	 * @param: $id Integer,
	 */
	public function delete($id)
	{

		$result = $this->db->query("delete from `user` where id = $id");

		if ($result) {

			return "Data is deleted successfully";
		} else {

			return "Error has occurred";
		}
	}
}
