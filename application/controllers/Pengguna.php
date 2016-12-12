<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('mpengguna'));

        
        if ($this->session->userdata('isLogin')==FALSE) {
			redirect('login');
		}
    }

	public function index()
	{		
		$data = array(
			'title'		=> 'Pengguna',
			'msg'		=> $this->session->flashdata('msg'),
			'table'		=> Mpengguna::get(),
		);
		return view('pengguna.index',$data);
	}

	public function create()
	{
		$data = array(
			'title'		=> 'Tambah Pengguna',
			'msg'		=> '',
			'form'		=> $this->form('insert')
		);

		return view('pengguna.form',$data);
	}

	public function insert()
	{	
		$this->validation();
		
		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Tambah Pengguna',
				'msg'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('insert')
			);

			return view('pengguna.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = new Mpengguna;
	        $db->username = $request['username'];
	        $db->password = md5($request['password']);
	        $db->nama_lengkap = $request['nama_lengkap'];
	        $db->level = $request['level'];
	        $db->save();

        	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil dimasukkan!!!</div>');

            redirect('pengguna');
        }
    }

	public function edit($id="")
	{
		$data = array(
			'title'		=> 'Edit Pengguna',
			'msg'		=> '',
			'form'		=> $this->form('update',Mpengguna::find($id))
		);

		return view('pengguna.form',$data);
	}

	public function update($id)
	{
		$this->validation();

		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Edit Pengguna',
				'msg'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('update',Mpengguna::find($id))
			);

			return view('pengguna.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = Mpengguna::find($id);
	        $db->username = $request['username'];
	        $db->password = md5($request['password']);
	        $db->nama_lengkap = $request['nama_lengkap'];
	        $db->level = $request['level'];
	        $db->save();

	    	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil diubah!!!</div>');

	        redirect('pengguna');
        }		
	}

	public function delete($id="")
	{		
		$db = Mpengguna::find($id);
		$db->delete();
		$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
		redirect('pengguna');
	}

	function validation()
	{
		
		$config = array(
		        array(
		                'field' => 'username',
		                'label' => 'Username',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Anda harus mengisi kolom %s.',
		                ),
		        ),
		        array(
		                'field' => 'nama_lengkap',
		                'label' => 'Nama Lengkap',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Anda harus mengisi kolom %s.',
		                ),
		        ),
		);
		return $this->form_validation->set_rules($config);
	}
	function form($type="",$data="")
	{
		if ($type=="insert") {
			$form = $this->form_builder->open_form(array('action' => 'pengguna/insert'));
		}elseif ($type=="update") {
			$form = $this->form_builder->open_form(array('action' => 'pengguna/update/'.$data->id_u));
		}
		$defaults_object_or_array_from_db = NULL;

		$form .= $this->form_builder->build_form_horizontal(
        array(
                array(
                        'id' => 'username',
                        'placeholder' => 'Username',
                        'name' => 'username',
                        'help' => form_error('username'), 
                        'value' => set_value('username',@$data->username)
                ),
                array(
                        'id' => 'password',
                        'placeholder' => 'Password',
                        'type' => 'password',
                        'name' => 'password',
                        'help' => form_error('password'),                  
                ),
                array(
                        'id' => 'nama_lengkap',
                        'placeholder' => 'Nama Lengkap',
                        'name' => 'nama_lengkap',
                        'help' => form_error('nama_lengkap'),                   
                        'value' => set_value('nama_lengkap',@$data->nama_lengkap)
                ),
                array(
                        'id' => 'level',
                        'type' => 'dropdown',
                        'name'	=> 'level',	
                        'options' => array(
                                'member' => 'Member',
                                'admin' => 'Administrator',
                        ),
                        'value' => set_value('level',@$data->level)
                ),
                array(
                        'id' => 'submit',
                        'type' => 'submit',
                        'label'	=> 'Simpan'
                )
        ), $defaults_object_or_array_from_db);
		$form .= $this->form_builder->close_form();

		return $form;
	}
}
