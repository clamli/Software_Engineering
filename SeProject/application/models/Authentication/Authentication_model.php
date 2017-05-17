<?php

/**
 * Created by PhpStorm.
 * User: BoYiLi
 * Date: 17/5/12
 * Time: 上午10:09
 */
class Authentication_model extends CI_Model
{
	private $salt = "authentication";

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * @param $accountId
     * @param $password
     * @return bool true：success， false： failed
     *
     * 验证用户授权账号密码是否正确
     */
    public function validate($username, $password)
    {
        $sql = "SELECT * FROM PerStockAccount WHERE accountId=?";

        $query = $this->db->query($sql, array($username));
        $row = $query->row();

        /*
         * 对明文密码进行加密，然后与数据库中的密码进行对比
         * 若两者匹配，则返回true，表示登陆密码正确
         */
        if (isset($row) && ($row->statOfAccount == "normal") && (/*crypt*/($password/*, $this->salt*/) == $row->accPassword)) {
			
			/* save session of current user */
			$newdata = array(
				'username'  => $username
			);
			$this->session->set_userdata($newdata);
			//echo newdata;
            return "true";
        } else {
            return $row->statOfAccount;
        }
    }
	
	/**
     * @param $str
     * @param null $salt
     * @param $str
     * 对crypt函数做一个封装，使之默认使用User_model里面的salt
     */
    public function crypt($str, $salt=null){
        if($salt == null){
            $salt = $this->salt;
        }
        return crypt($str, $salt);
    }
	
	
	/**
     * @param $username
     * 超过五次尝试导致账户锁定
     */
	public function lock_account($username) {
		$sql = "UPDATE PerStockAccount SET statOfAccount=? Where accountId=?";
		$query = $this->db->query($sql, array("locked",$username));	
	}
	
	/**
     * @param $username
     * 得到用户尝试次数
     */
	public function get_error_times($username) {
		$sql = "SELECT * FROM PerStockAccount Where accountId=?";
		$query = $this->db->query($sql, array($username));
		$row = $query->row();
		
		return $row->loginErrorTimes;
	}
	
	/**
     * @param $username
     * 更改用户尝试次数
     */
	public function update_error_times($username, $times) {
		$sql = "UPDATE PerStockAccount SET loginErrorTimes=? Where accountId=?";
		$query = $this->db->query($sql, array($times, $username));		
	}
	
	/**
     * @param $username
     * 恢复用户尝试次数
     */
	public function recover_error_times($username) {
		$sql = "UPDATE PerStockAccount SET loginErrorTimes=?, statOfAccount=? Where accountId=?";
		$query = $this->db->query($sql, array(0, "normal", $username));		
	}

}