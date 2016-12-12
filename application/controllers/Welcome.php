<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data = array(
			'title'		=> 'Codeigniter + Blade & Eloquent Create By Rizky Aidil Adha',
			'content'	=> "<p>The page you are looking at is being generated dynamically by CodeIgniter + Blade.</p>

							<p>If you would like to edit this page you'll find it located at:</p>
							<code>application/views/welcome_message.php</code>

							<p>The corresponding controller for this page is found at:</p>
							<code>application/controllers/Welcome.php</code>

							<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href='user_guide/'>User Guide</a>.</p>"
		);
		return view('welcome_message',$data);
	}

	public function adminlte()
	{
		$data = array(
			'title'		=> 'Codeigniter + Blade & Eloquent Create By Rizky Aidil Adha',
			'content'	=> ""
		);
		return view('test',$data);
	}

	public function test()
	{
		
        print_r($this->session->userdata());
            
	}
}
