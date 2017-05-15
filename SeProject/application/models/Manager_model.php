<?php

/**
 * Created by PhpStorm.
 * User: BoYiLi
 * Date: 17/5/11
 * Time: 下午13:51
 */
class Manager_model extends CI_Model
{
    private $salt = "se_proj";

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * @param $username
     * @param $password
     * @return bool true：success， false： failed
     *
     * 验证用户登陆账号密码是否正确
     */
    public function validate($username, $password)
    {
        $sql = "SELECT * FROM manager WHERE username=?";

        $query = $this->db->query($sql, array($username));
        $row = $query->row();

        /*
         * 对明文密码进行加密，然后与数据库中的密码进行对比
         * 若两者匹配，则返回true，表示登陆密码正确
         */
        if (isset($row) && (crypt($password, $this->salt) == $row->password)) {
            return true;
        } else {
            return false;
        }
    }
	
	/**
     * @param $email
     * @return bool true：success， false： failed
     *
     * 验证用户登陆账号密码是否正确
     */
    public function fetch($email)
    {
        $sql = "SELECT * FROM manager WHERE email=?";

        $query = $this->db->query($sql, array($email));
        $row = $query->row();

        /*
         * 对明文密码进行加密，然后与数据库中的密码进行对比
         * 若两者匹配，则返回true，表示登陆密码正确
         */
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $username
     * @param $password
     * @param $email
     * @return mixed
     * 用户注册
     */
    public function create($username, $password, $email)
    {
        $sql = "INSERT INTO manager(username, password, email) VALUES(?, ?, ?)";
        $password_crypted = crypt($password, $this->salt);
        $query = $this->db->query($sql, array($username, $password_crypted, $email));
        return $query;
    }
	
	
	/**
     * @param $source
     * @param $destination
     * 验证邮件
     */
    public function email($source, $destination)
    {
        $this->load->library('email');

		$this->email->from($source, 'Ben the King');
		$this->email->to($destination);

		$this->email->subject('Check Email');
		$this->email->message('This is a check email, welcome!');

		$this->email->send();
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
}