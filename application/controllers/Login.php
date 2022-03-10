<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Public_controller {
    public function __construct()
	{
		parent::__construct();
        if ($this->session->userId)
            return redirect('');
    }

    private $table = 'users';

    public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');

        $data['title'] = 'Login';
        $data['name'] = 'login';

        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "login", $data);
        else{
            $post = [
                'mobile'   => $this->input->post('mobile'),
                'password' => my_crypt($this->input->post('password'))
            ];

            $id = $this->main->get($post, $this->table);

            /* flashMsg($id, "$this->title added.", "$this->title not added. Try again.", 'login'); */
            
        }
    }

    public function logout()
	{
		
    }
}