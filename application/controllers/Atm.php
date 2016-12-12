<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atm extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('matm'));

        if ($this->session->userdata('isLogin')==FALSE) {
			redirect('login');
		}
    }

	public function create($id)
	{
		$data = array(
			'title'		=> 'Tambah ATM',
			'msg'		=> '',
			'form'		=> $this->form('insert',$id)
		);

		return view('kantor.form',$data);
	}

	public function insert($id)
	{	
		$this->validation();
		
		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Tambah ATM',
				'msg'		=> '<div class="alert alert-danger text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('insert',$id)
			);

			return view('kantor.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = new Matm;
	        $db->id_k = $id;
	        $db->kode_a = $request['kode_a'];
	        $db->type_a = $request['type_a'];
	        $db->alamat_a = $request['alamat_a'];
	        $db->save();

        	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil dimasukkan!!!</div>');

            redirect('kantor/detail/'.$id);
        }
    }

	public function edit($id="")
	{
		$id_a = $this->input->get('id_a');
		$data = array(
			'title'		=> 'Edit ATM',
			'msg'		=> '',
			'form'		=> $this->form('update',$id,Matm::find($id_a))
		);

		return view('kantor.form',$data);
	}

	public function update($id)
	{
		$this->validation();
		$id_a = $this->input->get('id_a');
		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Edit ATM',
				'msg'		=> '<div class="alert alert-danger text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('update',$id,Matm::find($id_a))
			);

			return view('kantor.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = Matm::find($id_a);
	        $db->kode_a = $request['kode_a'];
	        $db->type_a = $request['type_a'];
	        $db->alamat_a = $request['alamat_a'];
	        $db->save();

	    	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil diubah!!!</div>');

	        redirect('kantor/detail/'.$id);
        }		
	}

	public function delete($id="")
	{		
		$id_a = $this->input->get('id_a');
		$db = Matm::find($id_a);
		$db->delete();
		$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
		redirect('kantor/detail/'.$id);
	}

	function validation()
	{
		
		$config = array(
				array(
		                'field' => 'kode_a',
		                'label' => 'Kode',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Anda harus mengisi kolom %s.',
		                ),
		        ),
		        array(
		                'field' => 'alamat_a',
		                'label' => 'Alamat ATM',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Anda harus mengisi kolom %s.',
		                ),
		        ),
		);
		return $this->form_validation->set_rules($config);
	}
	function form($type="",$id="",$data="")
	{
		if ($type=="insert") {
			$form = $this->form_builder->open_form(array('action' => 'atm/insert/'.$id));
		}elseif ($type=="update") {
			$form = $this->form_builder->open_form(array('action' => 'atm/update/'.$id.'?id_a='.$data->id_a));
		}
		$defaults_object_or_array_from_db = NULL;
		$form .= $this->form_builder->build_form_horizontal(
        array(
        		array(/* HIDDEN */
                        'id' => 'id_k',
                        'type' => 'hidden',
                        'name'	=> 'id_k',
                        'value' => set_value('id_k',$id)
                ),
                array(
                        'id' => 'kode',
                        'placeholder' => 'Kode',
                        'name' => 'kode_a',
                        'help' => form_error('kode_a'),                   
                        'value' => set_value('kode_a',@$data->kode_a)
                ),
        		array(
                        'id' => 'type_atm',
                        'type' => 'dropdown',
                        'name'	=> 'type_a',	
                        'options' => array(
	                        '1' => 'On Site',
	                        '0' => 'Off Site'
                        ),
                        'value' => set_value('id_jk',@$data->id_jk)
                ),	
                array(
                        'id' => 'alamat',
                        'placeholder' => 'Alamat',
                        'name' => 'alamat_a',
                        'help' => form_error('alamat_a'),                   
                        'value' => set_value('alamat_a',@$data->alamat_a)
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