<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class E404 extends CI_Controller {

	public function index()
	{
		$data = array(
			'title'		=> "404 Error Page",
		);
		return view('404',$data);
	}
}
