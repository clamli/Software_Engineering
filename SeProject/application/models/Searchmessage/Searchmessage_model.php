<?php
class Searchmessage_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_message($username)
	{
		$sql = "SELECT * FROM Trade WHERE buyer=? or seller=?";
		$query = $this->db->query($sql, array($username, $username));
        return $query->result_array();
	}
}