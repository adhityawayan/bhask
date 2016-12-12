<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zona extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('mzona'));

        
        if ($this->session->userdata('isLogin')==FALSE) {
			redirect('login');
		}
    }

	public function index()
	{		
		$data = array(
			'title'		=> 'Zona',
			'msg'		=> $this->session->flashdata('msg'),
			'table'		=> Mzona::get(),
		);
		return view('zona.index',$data);
	}

	public function create()
	{
		$data = array(
			'title'		=> 'Tambah Zona',
			'msg'		=> '',
			'form'		=> $this->form('insert')
		);

		return view('zona.form',$data);
	}

	public function insert()
	{	
		$this->validation();
		
		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Tambah Zona',
				'msg'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('insert')
			);

			return view('zona.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = new Mzona;
	        $db->nama_z = $request['nama_z'];
	        $db->deskripsi_z = $request['deskripsi_z'];
	        $db->save();

        	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil dimasukkan!!!</div>');

            redirect('zona');
        }
    }

	public function edit($id="")
	{
		$data = array(
			'title'		=> 'Edit Zona',
			'msg'		=> '',
			'form'		=> $this->form('update',Mzona::find($id))
		);

		return view('zona.form',$data);
	}

	public function update($id)
	{
		$this->validation();

		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Edit Zona',
				'msg'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('update',Mzona::find($id))
			);

			return view('zona.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = Mzona::find($id);
	        $db->nama_z = $request['nama_z'];
	        $db->deskripsi_z = $request['deskripsi_z'];
	        $db->save();

	    	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil diubah!!!</div>');

	        redirect('zona');
        }		
	}

	public function delete($id="")
	{		
		$db = Mzona::find($id);
		$db->delete();
		$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
		redirect('zona');
	}

	function validation()
	{
		
		$config = array(
		        array(
		                'field' => 'nama_z',
		                'label' => 'Zona',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Anda harus mengisi kolom %s.',
		                ),
		        ),
		        array(
		                'field' => 'deskripsi_z',
		                'label' => 'Deskripsi',
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
			$form = $this->form_builder->open_form(array('action' => 'zona/insert'));
		}elseif ($type=="update") {
			$form = $this->form_builder->open_form(array('action' => 'zona/update/'.$data->id_z));
		}
		$defaults_object_or_array_from_db = NULL;

		$form .= $this->form_builder->build_form_horizontal(
        array(
                array(
                        'id' => 'Zona',
                        'placeholder' => 'Zona',
                        'name' => 'nama_z',
                        'help' => form_error('nama_z'), 
                        'value' => set_value('nama_z',@$data->nama_z)
                ),
                array(
                        'id' => 'deskripsi',
                        'placeholder' => 'Deskripsi',
                        'name' => 'deskripsi_z',
                        'help' => form_error('deskripsi_z'),                   
                        'value' => set_value('deskripsi_z',@$data->deskripsi_z)
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
