<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends Public_controller {
    public function __construct()
	{
		parent::__construct();
        if ($this->session->userId)
            return redirect('');
    }

    private $table = 'users';

    public function index()
	{
		$this->form_validation->set_rules('reg_mobile', 'Mobile No.', 'required|is_unique[users.mobile]|exact_length[10]|integer', [
                'required'      => '%s is required.',
                'exact_length'  => '%s is invalid.',
                'integer'       => '%s is invalid.',
                'is_unique'     => 'This %s already in use.']);

        $data['title'] = 'Register';
        $data['name'] = 'register';

        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "login", $data);
        else{
            $otp = rand(1000, 9999);
            $post = [
                'mobile'   => $this->input->post('reg_mobile'),
                'otp'      => $otp,
                'expiry'   => date('Y-m-d H:i:s', strtotime('+5 minutes'))
            ];
            
            $this->main->delete('check_otp', ['mobile' => $post['mobile']]);
            $id = $this->main->add($post, "check_otp");
            
            if ($id) $this->session->set_flashdata('reg_mobile', $post['mobile']);

            flashMsg($id, "OTP send success.", "OTP send not success. Try again.", 'register/check');
        }
    }

    public function check()
	{
        $reg_mobile = $this->session->reg_mobile;
        if (!$reg_mobile) return redirect('register');
        $this->session->set_flashdata('reg_mobile', $reg_mobile);

		$this->form_validation->set_rules('otp', 'Mobile No.', 'required|exact_length[4]|integer', [
                'required'      => '%s is required.',
                'exact_length'  => '%s is invalid.',
                'integer'       => '%s is invalid.']);

        $data['title'] = 'Verify otp';
        $data['name'] = 'register';

        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "login", $data);
        else{
            $otp = rand(1000, 9999);
            $post = [
                'mobile'   => $this->session->reg_mobile,
                'otp'      => $this->input->post('otp'),
                'expiry'   => date('Y-m-d H:i:s')
            ];
            
            $this->main->delete('check_otp', ['mobile' => $post['mobile']]);
            $id = $this->main->add($post, "check_otp");
            
            if ($id) $this->session->set_flashdata('reg_mobile', $post['mobile']);

            flashMsg($id, "OTP send success.", "OTP send not success. Try again.", 'register');
            
        }
    }
}