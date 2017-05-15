<?php
class Stockaccount extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Stockaccount/stockaccount_model');
        $this->load->helper('url_helper');
    }


    public function indexPerson()
    {
         $this->load->helper('form');
         $this->load->helper('url');
         $this->load->library('form_validation');

         $this->form_validation->set_rules('accountId','AccountId','required');
         $this->form_validation->set_rules('accPassword','AccPassword','required');
         $this->form_validation->set_rules('rgstDate','RgstDate','required');
         $this->form_validation->set_rules('userName','UserName','required');
         $this->form_validation->set_rules('userGender','UserGender','required');
         $this->form_validation->set_rules('idNumber','IdNumber','required');
         $this->form_validation->set_rules('houAddress','HouAddress','required');
         $this->form_validation->set_rules('perOccupation','PerOccupation','required');
         $this->form_validation->set_rules('perEducation','PerEducation','required');
         $this->form_validation->set_rules('workPlace','WorkPlace','required');
         $this->form_validation->set_rules('phoneNumber','PhoneNumber','required');
         $this->form_validation->set_rules('subsIdNumber','SubsIdNumber','required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('Stockaccount/open_account_view_person');
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
                $this->load->view('Stockaccount/success');
            else echo "该证件号已经开户，请重新输入或退出";
        }
    }

    public function indexLegal()
    {
         $this->load->helper('form');
         $this->load->helper('url');
         $this->load->library('form_validation');

         $this->form_validation->set_rules('accountId','AccountId','required');
         $this->form_validation->set_rules('accPassword','AccPassword','required');
         $this->form_validation->set_rules('rgstDate','RgstDate','required');
         $this->form_validation->set_rules('rgstNumber','RgstNumber','required');
         $this->form_validation->set_rules('bLisnNumber','BLisnNumber','required');
         $this->form_validation->set_rules('idNumber','IdNumber','required');
         $this->form_validation->set_rules('userName','UserName','required');
         $this->form_validation->set_rules('phoneNumber','PhoneNumber','required');
         $this->form_validation->set_rules('houAddress','HouAddress','required');
         $this->form_validation->set_rules('authName','AuthName','required');
         $this->form_validation->set_rules('authIdNumber','AuthIdNumber','required');
         $this->form_validation->set_rules('authPhoneNumber','AuthPhoneNumber','required');
         $this->form_validation->set_rules('authhouAddress','AuthhouAddress','required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('Stockaccount/open_account_view_legal');
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
                $this->load->view('Stockaccount/success');
            else echo "该证件号已经，请重新输入或退出";
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

         $this->form_validation->set_rules('typeOfAccount','typeOfAccount','required');
         $this->form_validation->set_rules('idNumber','idNumber','required');
      
        $typeOfAccount=$this->input->post('typeOfAccount');
        $idNumber=$this->input->post('idNumber');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('Stockaccount/cancel_account');
        } 
        else{
            //如果提交了
            if(!preg_match("/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/", $idNumber)){
                echo "证件号格式不正确，请输入18位证件号";
                return;
            }
                
            if($this->stockaccount_model->delete_account($typeOfAccount,$idNumber))
                $this->load->view('stockaccount/success');
            else echo "该证件号未注册，请重新输入或退出";
        }

    }
	
	public function reportLoss()
    {
         $this->load->helper('form');
         $this->load->helper('url');
         $this->load->library('form_validation');

         $this->form_validation->set_rules('typeOfAccount','typeOfAccount','required');
         $this->form_validation->set_rules('idNumber','idNumber','required');
      
        $typeOfAccount=$this->input->post('typeOfAccount');
        $idNumber = $this->input->post('idNumber');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('Stockaccount/report_loss');
        } 
        else{
            //如果提交了
            if(!preg_match("/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/", $idNumber)){
                echo "证件号格式不正确，请输入18位证件号";
                return;
            }
            if($this->stockaccount_model->report_loss($typeOfAccount, $idNumber))
                $this->load->view('Stockaccount/success');
            else echo "该证件号未注册，请重新输入或退出";
        }
    }
    
}