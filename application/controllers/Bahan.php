<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bahan extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('mbahan'));
        
        if ($this->session->userdata('isLogin')==FALSE) {
			redirect('login');
		}
    }

	public function index()
	{		
		$data = array(
			'title'		=> 'Sub Kontraktor',
			'msg'		=> $this->session->flashdata('msg'),
			'table'		=> Mbahan::get(),
		);
		return view('bahan.index',$data);
	}

	public function create()
	{
		$data = array(
			'title'		=> 'Tambah Sub Kontraktor',
			'msg'		=> '',
			'form'		=> $this->form('insert')
		);

		return view('bahan.form',$data);
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

			return view('bahan.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = new Mbahan;
	        $db->kode_b = $request['kode_b'];
	        $db->nama_b = $request['nama_b'];
	        $db->harga_tukang_b = $request['harga_tukang_b'];
	        $db->save();

        	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil dimasukkan!!!</div>');

            redirect('bahan');
        }
    }

	public function edit($id="")
	{
		$data = array(
			'title'		=> 'Edit Sub Kontraktor',
			'msg'		=> '',
			'form'		=> $this->form('update',Mbahan::find($id))
		);

		return view('bahan.form',$data);
	}

	public function update($id)
	{
		$this->validation();

		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Edit Sub Kontraktor',
				'msg'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('update',Mbahan::find($id))
			);

			return view('bahan.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = Mbahan::find($id);
	        $db->kode_b = $request['kode_b'];
	        $db->nama_b = $request['nama_b'];
	        $db->harga_tukang_b = $request['harga_tukang_b'];
	        $db->save();

	    	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil diubah!!!</div>');

	        redirect('bahan');
        }		
	}

	public function delete($id="")
	{		
		$db = Mbahan::find($id);
		$db->delete();
		$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
		redirect('bahan');
	}

	function validation()
	{
		
		$config = array(
		        array(
		                'field' => 'kode_b',
		                'label' => 'Kode',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Anda harus mengisi kolom %s.',
		                ),
		        ),
		        array(
		                'field' => 'nama_b',
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
			$form = $this->form_builder->open_form(array('action' => 'bahan/insert'));
		}elseif ($type=="update") {
			$form = $this->form_builder->open_form(array('action' => 'bahan/update/'.$data->id_b));
		}
		$defaults_object_or_array_from_db = NULL;

		$form .= $this->form_builder->build_form_horizontal(
        array(
                array(
                        'id' => 'kode',
                        'placeholder' => 'Kode',
                        'name' => 'kode_b',
                        'help' => form_error('kode_b'), 
                        'value' => set_value('kode_b',@$data->kode_b)
                ),
                array(
                        'id' => 'bahan',
                        'placeholder' => 'Sub Kontraktor',
                        'name' => 'nama_b',
                        'help' => form_error('nama_b'),                   
                        'value' => set_value('nama_b',@$data->nama_b)
                ),
                array(
                        'id' => 'harga_tukang',
                        'placeholder' => 'Harga Tukang',
                        'name' => 'harga_tukang_b',
                        'help' => form_error('harga_tukang_b'),                   
                        'value' => set_value('harga_tukang_b',@$data->harga_tukang_b)
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
