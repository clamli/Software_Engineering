<?php

/**
 * Created by PhpStorm.
 * User: boYiLi
 * Date: 17/5/11
 * Time: 下午13:26
 */
class Manager extends CI_Controller
{
    /**
     * Home constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
		//$this->load->library('email');
        $this->load->library('session');
		$this->load->helper('cookie');
        $this->load->model("manager_model");
    }

    public function index()
    {
        $this->load->view("neon/index.html");
    }

    public function login()
    {
        $this->load->view("neon/extra-login.html");
    }

    public function register()
	{
        $this->load->view("neon/extra-register.html");
    }
	
	public function forget_password()
	{
		$this->load->view("neon/extra-forgot-password.html");
	}

    public function register_check()
	{
        # Response Data Array
        $resp = array();
        $username   = $this->input->post("username");
        $email      = $this->input->post("email");
        $password   = $this->input->post("password");

        $query = $this->manager_model->create($username, $password, $email);
		
		# Send Check Email
		//$source = '3140102256@zju.edu.cn';
		//$destination = $email;
		//$this->manager_model->email($source, $destination);
		# Send Check Email
		
        $resp['submitted_data'] = $_POST; 

        echo json_encode($resp);
    }

    public function login_check()
    {
        $resp = array();

        $username = $this->input->post("username");
        $password = $this->input->post("password");

		
		# Send Check Email
		//$source = '3140102256@zju.edu.cn';
		//$destination = $email;
		//$this->manager_model->email($source, $destination);
		# Send Check Email
		
        $resp['submitted_data'] = $_POST; 


        $login_status = 'invalid';

        if ($this->manager_model->validate($username, $password)) {
            $login_status = 'success';
        }

        $resp['login_status'] = $login_status;

        if ($login_status == 'success') {
            $username_crypted = $this->manager_model->crypt($username);
            $this->session->set_userdata("username", $username_crypted);
            set_cookie("username", $username_crypted);
            $resp['redirect_url'] = 'index';
        }
		
		echo json_encode($resp);

    }
	
	public function forget_password_check()
	{
		$resp = array();
        $email = $this->input->post("email");
		$resp['submitted_data'] = $_POST;
       
        $check_status = 'invalid';

        if ($this->manager_model->fetch($email)) {
            $check_status = 'success';
        }
		
		$resp['check_status'] = $check_status;

		if ($check_status == 'success') {
            
        }
		
        echo json_encode($resp);
	}
}