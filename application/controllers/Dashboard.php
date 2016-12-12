<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('mkantor','mjeniskantor','matm','mzona'));
        
        if ($this->session->userdata('isLogin')==FALSE) {
			redirect('login');
		}
    }

	public function index()
	{		
		$data = array(
			'title'		=> 'Dashboard',
		);
		return view('dashboard',$data);
	}
}
