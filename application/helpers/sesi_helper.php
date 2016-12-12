<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//if (!empty($this->session->userdata())) {
	function sesi($name){
		$CI    =& get_instance();
		return $CI->session->userdata($name);
	}
//}