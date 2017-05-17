<?php
class Stockaccount_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        //echo "hhh";
    }

    public function open_account($datasent)
    {

        
        if($this->check_account2($datasent)==true)
        {
             $this->db->insert('PerStockAccount',$datasent);
             return true;
        }          
        else{
              //echo "该证件号未注册，请重新输入或退出";
              return false;
        }
          
    }
	
	public function report_loss($typeOfAccount, $idNumber)
    {

        //echo "guashi";
        $data=array(
            'typeOfAccount'=>$typeOfAccount,
            'idNumber'=>$idNumber,
            'statOfAccount'=>'loss'
            );
        if($this->check_account($idNumber)==true)
        {
             $this->db->replace('PerStockAccount',$data);
             return true;
        }          
        else{
              //echo "该证件号未注册，请重新输入或退出";
              return false;
        }
          
    }
	
	public function check_account2($datasent)
    {
		//echo "check account";
		$query=$this->db->get_where('PerStockAccount',array('accountId'=>$datasent['accountId']));
		if(is_null($query->row_array())) {
			return true;
		}
		else {
			return false;
		}
    }

    public function check_account($idNumber)
    {
		//echo "check account";
		$query=$this->db->get_where('PerStockAccount',array('accountId'=>$idNumber));
		if(is_null($query->row_array())) {
			return true;
		}
		else {
			return false;
		}
    }

    public function insert_account($typeOfAccount,$idNumber)
    {
     
        //echo "insert now";
        $data=array(
            'typeOfAccount'=>$typeOfAccount,
            'idnumber'=>$idNumber);

        return $this->db->insert('PerStockAccount', $data);
    }

    public function delete_account($typeOfAccount,$idNumber)
    {
        //echo "delete account";
            if($this->check_account($typeOfAccount,$idNumber)==true)
        {
             $this->db->delete('PerStockAccount', array('idNumber'=>$idNumber));
             return true;
        }          
        else{
              //echo "该证件号未注册，请重新输入或退出";
              return false;
        }
    }

    public function crypt($str,$salt=null)
    {
        if($salt==null)
            $salt=$this->salt;
        return crypt($str,$salt);
    }
}