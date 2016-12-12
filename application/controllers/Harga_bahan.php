<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harga_bahan extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('mharga_bahan','mbahan','mzona'));
        
        if ($this->session->userdata('isLogin')==FALSE) {
			redirect('login');
		}
    }

	public function index()
	{		
		$data = array(
			'title'		=> 'Harga Jual',
			'msg'		=> $this->session->flashdata('msg'),
			'table'		=> Mharga_bahan::join("zona","zona.id_z","=","harga_bahan.id_z")
							->join("bahan","bahan.id_b","=","harga_bahan.id_b")
							->get(),
		);
		return view('harga_bahan.index',$data);
	}

	public function create()
	{
		$data = array(
			'title'		=> 'Tambah Harga Jual',
			'msg'		=> '',
			'form'		=> $this->form('insert')
		);

		return view('harga_bahan.form',$data);
	}

	public function insert()
	{	
		$this->validation();
		
		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Tambah Harga Jual',
				'msg'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('insert')
			);

			return view('harga_bahan.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = new Mharga_bahan;
	        $db->id_b = $request['id_b'];
	        $db->id_z = $request['id_z'];
	        $db->harga_b = $request['harga_b'];
	        $db->save();

        	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil dimasukkan!!!</div>');

            redirect('harga_bahan');
        }
    }

	public function edit($id="")
	{
		$data = array(
			'title'		=> 'Edit Harga Jual',
			'msg'		=> '',
			'form'		=> $this->form('update',Mharga_bahan::find($id))
		);

		return view('harga_bahan.form',$data);
	}

	public function update($id)
	{
		$this->validation();

		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Edit Harga Jual',
				'msg'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('update',Mharga_bahan::find($id))
			);

			return view('harga_bahan.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = Mharga_bahan::find($id);
	        $db->id_b = $request['id_b'];
	        $db->id_z = $request['id_z'];
	        $db->harga_b = $request['harga_b'];
	        $db->save();

	    	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil diubah!!!</div>');

	        redirect('harga_bahan');
        }		
	}

	public function delete($id="")
	{		
		$db = Mharga_bahan::find($id);
		$db->delete();
		$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
		redirect('harga_bahan');
	}

	function validation()
	{
		
		$config = array(
		        array(
		                'field' => 'harga_b',
		                'label' => 'Harga',
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
			$form = $this->form_builder->open_form(array('action' => 'harga_bahan/insert'));
		}elseif ($type=="update") {
			$form = $this->form_builder->open_form(array('action' => 'harga_bahan/update/'.$data->id_hb));
		}

		$zona = Mzona::get();
		foreach ($zona as $z) {
			$zona_options[$z->id_z] = $z->nama_z;
		}

		$bahan = Mbahan::get();
		foreach ($bahan as $k) {
			$bahan_option[$k->id_b] = $k->nama_b;
		}

		$defaults_object_or_array_from_db = NULL;

		$form .= $this->form_builder->build_form_horizontal(
        array(
        		array(
                        'id' => 'bahan',
                        'type' => 'dropdown',
                        'name'	=> 'id_b',	
                        'options' => $bahan_option,
                        'value' => set_value('id_b',@$data->id_b)
                ),

        		array(
                        'id' => 'zona',
                        'type' => 'dropdown',
                        'name'	=> 'id_z',	
                        'options' => $zona_options,
                        'value' => set_value('id_z',@$data->id_z)
                ),

                array(
                        'id' => 'harga',
                        'placeholder' => 'Harga Jual',
                        'name' => 'harga_b',
                        'help' => form_error('harga_b'),                   
                        'value' => set_value('harga_b',@$data->harga_b)
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
