<?php

/**
 * Created by PhpStorm.
 * User: BoYiLi
 * Date: 17/5/14
 * Time: 上午08:28
 */
class Searchmessage extends CI_Controller
{
    /**
     * Home constructor.
     */
	
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
		$this->load->library('session');
        $this->load->model("Searchmessage/searchmessage_model");
    }
	
	public function search()
	{
		//$username = $_SESSION['username'];
		$data['status'] = "Not Null";
		$data['username'] = $username;
		$data['records'] = $this->searchmessage_model->get_message($username);
		$this->load->view("Searchmessage/tables-datatable.html", $data);
	}
	
	/* initial status, no message return */
	public function index($username)
    {
		// $this->session->sess_destroy();
		// session_id($sessionID);
		// echo(session_id());
		// session_start();

		$data['username'] = "$username";
		$data['status'] = "Not Null";
		$data['records'] = $this->searchmessage_model->get_message($username);
        $this->load->view("Searchmessage/tables-datatable.html", $data);
    }
	
}
