<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('mpengguna'));
    }

	public function index()
	{
		$data = array(
			'title'		=> 'Login',
		);
		return view('login',$data);
	}

	public function check()
	{
		$input = $this->input->post();

		$db = Mpengguna::where('username',$input['username'])
							->where('password',md5($input['password']))
							->first();

		if (empty($db)) {
			echo "<script>alert('Gagal Login!')</script>";
			redirect('login','refresh');
		}else{
            $this->session->set_userdata(array(
                'isLogin'   	=> TRUE,
                'username'  	=> $db->username,
                'level'     	=> $db->level,
                'nama_lengkap'	=> $db->nama_lengkap,
            ));
			echo "<script>alert('Berhasil Login!')</script>";
            redirect('dashboard','refresh');
		}

	}
	
	public function destroy()
	{
		$this->session->sess_destroy();
		echo "<script>alert('Berhasil Logout!')</script>";
		redirect('login','refresh');
	}	
}
