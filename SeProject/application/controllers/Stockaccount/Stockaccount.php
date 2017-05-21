<?php
class Stockaccount extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Stockaccount/stockaccount_model');
        $this->load->helper('url_helper');
    }

    public function idnumber_check($str)
    {
        if($str==='')
            return true;
        if(!preg_match("/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/", $str)){
            $this->form_validation->set_message('idnumber_check','请输入正确的证件号');
            return false;
        }
        return true;
    }

    public function phonenumber_check($str){
        if($str==='')
            return true;
        if(!preg_match("/^([0-9]{3,4}-)?[0-9]{7,8}$/", $str)&&
            !preg_match("/^1[34578]\d{9}$/", $str)){
            $this->form_validation->set_message('phonenumber_check','请输入正确的电话号码');
            return false;
        }
        return true;
    }

    public function indexPerson()
    {
         $this->load->helper('form');
         $this->load->helper('url');
         $this->load->library('form_validation');

         $this->form_validation->set_rules('accountId','AccountId','required',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('accPassword','AccPassword','required',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('rgstDate','RgstDate','required',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('userName','UserName','required',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('userGender','UserGender','required',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('idNumber','idNumber','required|callback_idnumber_check',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('houAddress','HouAddress','required',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('perOccupation','PerOccupation','required',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('perEducation','PerEducation','required',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('workPlace','WorkPlace','required',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('phoneNumber','phoneNumber','required|callback_phonenumber_check',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('subsIdNumber','subsIdNumber',"callback_idnumber_check");
        
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('Stockaccount/open_account_view_person.html');
        } 
        else{
            //如果提交了
            $datasent=array(
                'accountId'=>$this->input->post('accountId'),
                'accPassword'=>$this->input->post('accPassword'),
                'rgstDate'=>$this->input->post('rgstDate'),
                'userName'=>$this->input->post('userName'),
                'userGender'=>$this->input->post('userGender'),
                'idNumber'=>$this->input->post('idNumber'),
                'houAddress'=>$this->input->post('houAddress'),
                'perOccupation'=>$this->input->post('perOccupation'),
                'perEducation'=>$this->input->post('perEducation'),
                'workPlace'=>$this->input->post('workPlace'),
                'phoneNumber'=>$this->input->post('phoneNumber'),
                'subsIdNumber'=>$this->input->post('subsIdNumber')
                );
            
            if($this->stockaccount_model->open_account($datasent)== TRUE)
            {
                $this->load->view('Stockaccount/open_account_view_person.html');
                echo "<script>alert('恭喜你开户成功')</script>";  
            }
            else $this->load->view('Stockaccount/open_account_view_person.html');
        }
    }

    public function indexLegal()
    {
         $this->load->helper('form');
         $this->load->helper('url');
         $this->load->library('form_validation');

         $this->form_validation->set_rules('accountId','AccountId','required',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('accPassword','AccPassword','required',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('rgstDate','RgstDate','required',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('rgstNumber','RgstNumber','required',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('bLisnNumber','BLisnNumber','required',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('idNumber','IdNumber','required|callback_idnumber_check',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('userName','UserName','required',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('phoneNumber','PhoneNumber','required|callback_phonenumber_check',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('houAddress','HouAddress','required',
            array('required'=>'此项为必填项'));
         $this->form_validation->set_rules('authName','AuthName');
         $this->form_validation->set_rules('authIdNumber','AuthIdNumber','callback_idnumber_check');
         $this->form_validation->set_rules('authPhoneNumber','AuthPhoneNumber','callback_phonenumber_check');
         $this->form_validation->set_rules('authhouAddress','AuthhouAddress');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('Stockaccount/open_account_view_legal.html');
        } 
        else{
            //如果提交了
            $datasent=array(
                'accountId'=>$this->input->post('accountId'),
                'accPassword'=>$this->input->post('accPassword'),
                'rgstDate'=>$this->input->post('rgstDate'),
                'rgstNumber'=>$this->input->post('rgstNumber'),
                'bLisnNumber'=>$this->input->post('bLisnNumber'),
                'idNumber'=>$this->input->post('idNumber'),
                'userName'=>$this->input->post('userName'),
                'phoneNumber'=>$this->input->post('phoneNumber'),
                'houAddress'=>$this->input->post('houAddress'),
                'authName'=>$this->input->post('authName'),
                'authIdNumber'=>$this->input->post('authIdNumber'),
                'authPhoneNumber'=>$this->input->post('authPhoneNumber'),
                'authhouAddress'=>$this->input->post('authhouAddress')
                );  
            if($this->stockaccount_model->open_account($datasent) == TRUE)
            {
                echo "<script>alert('恭喜你开户成功')</script>";  
                $this->load->view('Stockaccount/open_account_view_legal.html');
            }
            else $this->load->view('Stockaccount/open_account_view_legal.html');

        }
    }

    public function showSuccess()
    {
         $this->load->view('Stockaccount/success');
    }

    public function cancelAccount()
    {
         $this->load->helper('form');
         $this->load->helper('url');
         $this->load->library('form_validation');

         $this->form_validation->set_rules('typeOfAccount','typeOfAccount','required',
            array('required'=>'请填入证件号'));
         $this->form_validation->set_rules('idNumber','idNumber','required|callback_idnumber_check',
            array('required'=>'请填入证件号'));
      
        $typeOfAccount=$this->input->post('typeOfAccount');
        $idNumber=$this->input->post('idNumber');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('Stockaccount/cancel_account.html');
        } 
        else{
            //如果提交了
           
                
            if($this->stockaccount_model->delete_account($typeOfAccount,$idNumber)==true){
                //echo "<script>alert('恭喜你注销成功')</script>";
                $this->load->view('Stockaccount/cancel_account.html');
            }
                //$this->load->view('stockaccount/success.html');
                
            else {
                //echo "<script>alert('该证件号未注册，请重新输入或退出')</script>";
                $this->load->view('Stockaccount/cancel_account.html');
            } 
        }

    }
	
	public function reportLoss()
    {
        $this->load->helper('form');
         $this->load->helper('url');
         $this->load->library('form_validation');

         $this->form_validation->set_rules('typeOfAccount','typeOfAccount','required',
            array('required'=>'请填入证件号'));
         $this->form_validation->set_rules('idNumber','idNumber','required|callback_idnumber_check',
            array('required'=>'请填入证件号'));
      
        $typeOfAccount=$this->input->post('typeOfAccount');
        $idNumber = $this->input->post('idNumber');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('Stockaccount/report_loss.html');
        } 
        else{
            //如果提交了
           
            if($this->stockaccount_model->report_loss($typeOfAccount, $idNumber)==true){
                 
                $this->load->view('Stockaccount/report_loss.html');
            }
                //$this->load->view('Stockaccount/success.html');              
            else {
                
                $this->load->view('Stockaccount/report_loss.html');
            }
        }

        /*$this->load->view("stockaccount/report_loss.html");  
        $resp=array();
        $typeOfAccount=$this->input->post("typeOfAccount");
        $idNumber=$this->input->post("idNumber");
        $resp['submitted_data']=$_POST;
        

        if($this->stockaccount_model->check_account($idNumber)==false){
                $this->load->view("stockaccount/report_loss.html");  
                echo "failed";        
        } 
        else{
            $this->stockaccount_model->report_loss($typeOfAccount, $idNumber);
             $this->load->view('Stockaccount/success');
        }*/
       
            
    }
	
	public function unlock_index()
    {
		$data['status'] = "No_status";
		$data['idNumber'] = "输入18位身份证号（字母一律大写）";
        $data['username'] = "输入证券账户";
        $this->load->view('Stockaccount/unlock.html', $data);
    }
	
	public function unlock()
    {
        $resp = array();
		
		$data['idNumber'] = $this->input->post("idNumber");
        $data['username'] = $this->input->post("username");
        $data['newpassword'] = $this->input->post("newpassword");
		$data['confirmpassword'] = $this->input->post("confirmpassword");
		
		$resp['submitted_data'] = $_POST; 
		
		$data['status'] = $this->stockaccount_model->lock_validate($data['idNumber'], $data['username'], $data['newpassword'], $data['confirmpassword']);
		
		$this->load->view('Stockaccount/unlock.html', $data);
		
		if($data['status'] == "Match") {
			$this->stockaccount_model->change_password($data['username'], $data['newpassword']);
		}
		
/* 		echo json_encode($data);
		echo json_encode($resp); */
    }
}