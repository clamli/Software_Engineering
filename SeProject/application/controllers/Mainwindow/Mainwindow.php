<?php

/**
 * Created by PhpStorm.
 * User: BoYiLi
 * Date: 17/5/17
 * Time: 下午14:38
 */
class Mainwindow extends CI_Controller
{
    /**
     * Home constructor.
     */
	
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
		$this->load->library('session');
    }
	
	public function index()
	{
		$this->load->view("Mainwindow/index.html");
	}
}
