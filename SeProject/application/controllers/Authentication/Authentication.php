<?php

/**
 * Created by PhpStorm.
 * User: BoYiLi
 * Date: 17/5/12
 * Time: 上午09:26
 */
class Authentication extends CI_Controller
{
    /**
     * Home constructor.
     */
	
	/* calculate the try times */
	private $auth_cnt = 0;
	private $last_usrName = "";
	
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
		$this->load->library('session');
		$this->load->library('xmlrpc');
        $this->load->model("Authentication/authentication_model");
    }
	
	public function auth_start()
	{
		$data['auth_cnt'] = 0;
		$data['locked'] = "false";
		$this->load->view("authentication/authentication.html", $data);
	}
	
<<<<<<< HEAD
=======
	
	public function index()
    {
        $this->load->view("authentication/index.html");
    }
	
>>>>>>> 7b0c205d1f6059cbb66d9b3c9ae3158c94cfeb02
	public function authenticate()
	{
		$resp = array();

        $username = $this->input->post("username");
        $password = $this->input->post("password");
		
		$resp['submitted_data'] = $_POST; 

        $auth_status = 'invalid';

        if (($status=$this->authentication_model->validate($username, $password))=="true") {
            $auth_status = 'success';
        }
		else if($status=="locked"){
			echo $status;
			$data['locked'] = "true";
			$data['auth_cnt'] = 5;
			$this->load->view("authentication/authentication.html", $data);
			return;
		}
		
        $resp['auth_status'] = $auth_status;

        if ($auth_status == 'success') {
            //$username_crypted = $this->authentication_model->crypt($username);
			$_SESSION['username']=$username;
			$sessionID=session_id();
			//redirect("/Searchmessage/Searchmessage/index/$sessionID");
			redirect("/Searchmessage/Searchmessage/index/$username");
        }
		else
		{
			$times = $this->authentication_model->get_error_times($username);
			if ( $times >= 4) {
				$data['locked']="true";
				$times += 1;
				$this->authentication_model->lock_account($username);
			} else {
				$data['locked']="false";
				$times += 1;
				$this->authentication_model->update_error_times($username, $times);
			}
			$data['auth_cnt'] = $times;
			
			$this->load->view("authentication/authentication.html", $data);
		}
		
		/* record last username */
		$this->last_usrName = $username;
		//echo json_encode($resp);
	}

	
<<<<<<< HEAD
	public function log_out()
	{
		$this->load->view("Mainwindow/index.html");
=======
	public function auth_failure_five_times()
	{
		$this->load->view("authentication/authentication.html");
>>>>>>> 7b0c205d1f6059cbb66d9b3c9ae3158c94cfeb02
	}

    public function auth_failure()
	{
		$this->load->view("authentication/authentication.html");
	}
}
