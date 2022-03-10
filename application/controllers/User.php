<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Public_controller {
    public function __construct()
	{
		parent::__construct();
        if (! $this->session->userId)
            flashMsg(0, "", "Login to continue.", "login");
    }

    public function checkout()
	{
		
    }
}