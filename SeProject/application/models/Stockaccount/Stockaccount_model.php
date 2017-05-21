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
        if($this->check_account($datasent)==true)
        {
             $this->db->insert('PerStockAccount',$datasent);
             return true;
        }          
        else{
             echo "<script>alert('改账户已经被注册')</script>";
              return false;
        }
          
    }

    public function check_account($datasent)
    {
       $query=$this->db->get_where('PerStockAccount',array('accountId'=>$datasent['accountId']));
       if(is_null($query->row_array())){
          $query=$this->db->get_where('PerStockAccount',array('idNumber'=>$datasent['idNumber']));
          if(is_null($query->row_array())){
            return true;
          }
          else
            return false;
       }
       else
         return false;
    }

   

    
    
	
	public function report_loss($typeOfAccount, $idNumber)
    {

        //echo "guashi";
        $data=array(
            'typeOfAccount'=>$typeOfAccount,
            'idNumber'=>$idNumber,
            'statOfAccount'=>'loss'
            );
        if($this->check_account1($typeOfAccount,$idNumber)==true)
        {
             $this->db->replace('PerStockAccount',$data);
             return true;
        }          
        else{
              //echo "该证件号未注册，请重新输入或退出";
              return false;
        }
          
    }
	
	public function check_account2($typeOfAccount,$idNumber)
    {
        //echo "check account";

            if(!preg_match("/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/", $idNumber)){
               
                echo "<script>alert('证件号格式不正确，请输入18位证件号')</script>";
                return false;
            }
        $query=$this->db->get_where('PerStockAccount',array('typeOfAccount'=>$typeOfAccount,'idNumber'=>$idNumber));
        if(is_null($query->row_array())) {
            echo "<script>alert('该证件号未注册，请重新输入或退出')</script>";
            return false;
        }
        else {
             echo "<script>alert('恭喜你注销成功')</script>";  
            return true;
        }
    }


    public function check_account1($typeOfAccount,$idNumber)
    {
		//echo "check account";

            if(!preg_match("/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/", $idNumber)){
               
                echo "<script>alert('证件号格式不正确，请输入18位证件号')</script>";
                return false;
            }
         
		$query=$this->db->get_where('PerStockAccount',array('typeOfAccount'=>$typeOfAccount,'idNumber'=>$idNumber));
		if(is_null($query->row_array())) {
            echo "<script>alert('该证件号未注册，请重新输入或退出')</script>";
			return false;
		}
		else {

            if($query->row_array()['statOfAccount']=='loss'){
                 echo "<script>alert('该账户已经挂失')</script>";
                 return true;
            }
             echo "<script>alert('恭喜你挂失成功，请选择解挂进行重新注册')</script>";  
			return true;
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
            if($this->check_account2($typeOfAccount,$idNumber)==true)
        {
             $this->db->delete('PerStockAccount', array('typeOfAccount'=>$typeOfAccount,'idNumber'=>$idNumber));
             return true;
        }          
        else{
              //echo "该证件号未注册，请重新输入或退出";
             
              return false;
        }
    }
	
	public function lock_validate($idNumber, $username, $newpassword, $confirmpassword)
	{
		$query1 = $this->db->get_where('PerStockAccount',array('idNumber'=>$idNumber));
		$query2 = $this->db->get_where('PerStockAccount',array('accountId'=>$username));
		$row1 = $query1->row();
		$row2 = $query2->row();
		$username1 = $row1->accountId;
		if(!isset($row1)) {
			return "No_idNumber";
		} else if(!isset($row2)) {
			return "No_username";
			//return $idNumber;
		} else if($username != $username1) {
			return "Not_match_id_acc";
		} else if($newpassword != $confirmpassword) {
			return "Not_match_pass";
		} else {
			return "Match";
		}
	}
	
	public function change_password($username, $newpassword)
	{
		$sql = "UPDATE PerStockAccount SET accPassword=? Where accountId=?";
		$query = $this->db->query($sql, array($newpassword, $username));
	}

    public function crypt($str,$salt=null)
    {
        if($salt==null)
            $salt=$this->salt;
        return crypt($str,$salt);
    }
}