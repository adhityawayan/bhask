<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harga extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('mrepairharga','mrepairsubkon','mzona'));
        
        if ($this->session->userdata('isLogin')==FALSE) {
			redirect('login');
		}
    }

	public function index()
	{		
		$data = array(
			'title'		=> 'Harga Jual',
			'msg'		=> $this->session->flashdata('msg'),
			'table'		=> Mrepairharga::join("zona","zona.id_z","=","repair_harga.id_z")
							->join("repair_subkon","repair_subkon.id_repair_subkon","=","repair_harga.id_repair_subkon")
							->get(),
		);
		return view('repair.harga.index',$data);
	}

	public function create()
	{
		$data = array(
			'title'		=> 'Tambah Harga Jual',
			'msg'		=> '',
			'form'		=> $this->form('insert')
		);

		return view('repair.harga.form',$data);
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

			return view('repair.harga.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = new Mrepairharga;
	        $db->id_repair_subkon = $request['id_repair_subkon'];
	        $db->id_z = $request['id_z'];
	        $db->harga_repair_harga = $request['harga_repair_harga'];
	        $db->save();

        	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil dimasukkan!!!</div>');

            redirect('repair/harga');
        }
    }

	public function edit($id="")
	{
		$data = array(
			'title'		=> 'Edit Harga Jual',
			'msg'		=> '',
			'form'		=> $this->form('update',Mrepairharga::find($id))
		);

		return view('repair.harga.form',$data);
	}

	public function update($id)
	{
		$this->validation();

		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Edit Harga Jual',
				'msg'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('update',Mrepairharga::find($id))
			);

			return view('repair.harga.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = Mrepairharga::find($id);
	        $db->id_z = $request['id_z'];
	        $db->harga_repair_harga = $request['harga_repair_harga'];
	        $db->save();

	    	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil diubah!!!</div>');

	        redirect('repair/harga');
        }		
	}

	public function delete($id="")
	{		
		$db = Mrepairharga::find($id);
		$db->delete();
		$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
		redirect('repair/harga');
	}

	function validation()
	{
		$config = array(
		        array(
		                'field' => 'harga_repair_harga',
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
			$form = $this->form_builder->open_form(array('action' => 'repair/harga/insert'));
		}elseif ($type=="update") {
			$form = $this->form_builder->open_form(array('action' => 'repair/harga/update/'.$data->id_repair_harga));
		}

		$zona = Mzona::get();
		foreach ($zona as $z) {
			$zona_options[$z->id_z] = $z->nama_z;
		}

		$subkon = mrepairsubkon::get();
		foreach ($subkon as $k) {
			$subkon_option[$k->id_repair_subkon] = $k->nama_repair_subkon;
		}

		$defaults_object_or_array_from_db = NULL;

		$form .= $this->form_builder->build_form_horizontal(
        array(
        		array(
                        'id' => 'sub_kontraktor',
                        'type' => 'dropdown',
                        'name'	=> 'id_repair_subkon',	
                        'options' => $subkon_option,
                        'value' => set_value('id_repair_subkon',@$data->id_repair_subkon)
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
                        'name' => 'harga_repair_harga',
                        'help' => form_error('harga_repair_harga'),                   
                        'value' => set_value('harga_repair_harga',@$data->harga_repair_harga)
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
