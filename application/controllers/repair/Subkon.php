<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subkon extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('mrepairsubkon'));
        
        if ($this->session->userdata('isLogin')==FALSE) {
			redirect('login');
		}
    }

	public function index()
	{		
		$data = array(
			'title'		=> 'Sub Kontraktor',
			'msg'		=> $this->session->flashdata('msg'),
			'table'		=> Mrepairsubkon::get(),
		);
		return view('repair.subkon.index',$data);
	}

	public function create()
	{
		$data = array(
			'title'		=> 'Tambah Sub Kontraktor',
			'msg'		=> '',
			'form'		=> $this->form('insert')
		);

		return view('repair.subkon.form',$data);
	}

	public function insert()
	{	
		$this->validation();
		
		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Tambah Sub Kontraktor',
				'msg'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('insert')
			);

			return view('repair.subkon.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = new Mrepairsubkon;
	        $db->kode_repair_subkon = $request['kode_repair_subkon'];
	        $db->nama_repair_subkon = $request['nama_repair_subkon'];
	        $db->harga_repair_subkon = $request['harga_repair_subkon'];
	        $db->save();

        	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil dimasukkan!!!</div>');

            redirect('repair/subkon');
        }
    }

	public function edit($id="")
	{
		$data = array(
			'title'		=> 'Edit Sub Kontraktor',
			'msg'		=> '',
			'form'		=> $this->form('update',Mrepairsubkon::find($id))
		);

		return view('repair.subkon.form',$data);
	}

	public function update($id)
	{
		$this->validation();

		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Edit Sub Kontraktor',
				'msg'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('update',Mrepairsubkon::find($id))
			);

			return view('repair.subkon.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = Mrepairsubkon::find($id);
	        $db->kode_repair_subkon = $request['kode_repair_subkon'];
	        $db->nama_repair_subkon = $request['nama_repair_subkon'];
	        $db->harga_repair_subkon = $request['harga_repair_subkon'];
	        $db->save();

	    	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil diubah!!!</div>');

	        redirect('repair/subkon');
        }		
	}

	public function delete($id="")
	{		
		$db = Mrepairsubkon::find($id);
		$db->delete();
		$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
		redirect('repair/subkon');
	}

	function validation()
	{
		
		$config = array(
		        array(
		                'field' => 'kode_repair_subkon',
		                'label' => 'Kode',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Anda harus mengisi kolom %s.',
		                ),
		        ),
		        array(
		                'field' => 'nama_repair_subkon',
		                'label' => 'Bahan',
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
			$form = $this->form_builder->open_form(array('action' => 'repair/subkon/insert'));
		}elseif ($type=="update") {
			$form = $this->form_builder->open_form(array('action' => 'repair/subkon/update/'.$data->id_repair_subkon));
		}
		$defaults_object_or_array_from_db = NULL;

		$form .= $this->form_builder->build_form_horizontal(
        array(
                array(
                        'id' => 'kode',
                        'placeholder' => 'Kode',
                        'name' => 'kode_repair_subkon',
                        'help' => form_error('kode_repair_subkon'), 
                        'value' => set_value('kode_repair_subkon',@$data->kode_repair_subkon)
                ),
                array(
                        'id' => 'sub_kontraktor',
                        'placeholder' => 'Sub Kontraktor',
                        'name' => 'nama_repair_subkon',
                        'help' => form_error('nama_repair_subkon'),                   
                        'value' => set_value('nama_repair_subkon',@$data->nama_repair_subkon)
                ),
                array(
                        'id' => 'harga',
                        'placeholder' => 'Harga',
                        'name' => 'harga_repair_subkon',
                        'help' => form_error('harga_repair_subkon'),                   
                        'value' => set_value('harga_repair_subkon',@$data->harga_repair_subkon)
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
