<?php

/**
 * Created by PhpStorm.
 * User: BoYiLi
 * Date: 17/5/18
 * Time: 上午14:28
 */
class Help extends CI_Controller
{
    /**
     * Home constructor.
     */
	public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
		$this->load->library('session');
        $this->load->model("Help/help_model");
    }
	
	public function help_index()
	{
		$this->load->view("Help/help.html");
	}

}
