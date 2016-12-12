<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kantor extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('mkantor','mjeniskantor','matm','mzona'));
        
        if ($this->session->userdata('isLogin')==FALSE) {
			redirect('login');
		}
    }

	public function index()
	{		
		$data = array(
			'title'		=> 'Kantor/ATM BRI',
			'msg'		=> $this->session->flashdata('msg'),
			'table'		=> Mkantor::select('kantor.id_k',
											'kantor.kode_k',
											'kantor.nama_k',
											'kantor.id_parent',
											'kantor.alamat_k',
											'kantor.status_k',
											't2.nama_k as nama_parent',
											'jk.nama_jk',
											'z.nama_z')
							->leftjoin('kantor as t2', 't2.id_k','=','kantor.id_parent')
							->join("jenis_kantor as jk","kantor.id_jk","=","jk.id_jk")
							->leftjoin("zona as z","kantor.id_z","=","z.id_z")
							->orderBy('kantor.id_k', 'desc')
							->get(),
		);
		return view('kantor.index',$data);
	}

	public function create()
	{
		$data = array(
			'title'		=> 'Tambah Kantor/ATM BRI',
			'msg'		=> '',
			'form'		=> $this->form('insert')
		);

		return view('kantor.form',$data);
	}

	public function insert()
	{	
		$this->validation();
		
		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Tambah Kantor/ATM BRI',
				'msg'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('insert')
			);

			return view('kantor.form',$data);
        }
        else
        {
        	$request = $this->input->post();

        	// print_r($request);exit();
			$db = new Mkantor;
	        $db->id_jk = $request['id_jk'];
	        if ($request['id_parent']!="") {
	        	$db->id_parent = $request['id_parent'];
	        }else{
	        	$db->id_parent = 0;
	        }
	        $db->kode_k = $request['kode_k'];
	        $db->nama_k = $request['nama_k'];
	        $db->alamat_k = $request['alamat_k'];
	        $db->id_z = $request['id_z'];
	        $db->status_k = $request['status_k'];
	        $db->save();

        	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil dimasukkan!!!</div>');

            redirect('kantor');
        }
    }

	public function detail($id="")
	{
		$data = array(
			'title'		=> 'Detail Kantor',
			'msg'		=> $this->session->flashdata('msg'),
			'detail'	=> Mkantor::select('kantor.id_k',
											'kantor.kode_k',
											'kantor.nama_k',
											'kantor.id_parent',
											'kantor.alamat_k',
											'kantor.status_k',
											't2.nama_k as nama_parent',
											'jk.nama_jk',
											'z.nama_z')
							->leftjoin('kantor as t2', 't2.id_k','=','kantor.id_parent')
							->leftjoin("jenis_kantor as jk","kantor.id_jk","=","jk.id_jk")
							->leftjoin("zona as z","kantor.id_z","=","z.id_z")
							->find($id),
			'table'		=> Matm::where('id_k',$id)->get(),
		);

		return view('kantor.detail',$data);
	}

	public function edit($id="")
	{
		$data = array(
			'title'		=> 'Edit Kantor/ATM BRI',
			'msg'		=> '',
			'form'		=> $this->form('update',Mkantor::find($id))
		);

		return view('kantor.form',$data);
	}

	public function update($id)
	{
		$this->validation();

		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Edit Kantor/ATM BRI',
				'msg'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('update',Mkantor::find($id))
			);

			return view('kantor.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = Mkantor::find($id);
	        $db->id_jk = $request['id_jk'];
	        if ($request['id_parent']!="") {
	        	$db->id_parent = $request['id_parent'];
	        }else{
	        	$db->id_parent = 0;
	        }
	        $db->kode_k = $request['kode_k'];
	        $db->nama_k = $request['nama_k'];
	        $db->alamat_k = $request['alamat_k'];
	        $db->id_z = $request['id_z'];
	        $db->status_k = $request['status_k'];
	        $db->save();

	    	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil diubah!!!</div>');

	        redirect('kantor');
        }		
	}

	public function delete($id="")
	{		
		$db = Mkantor::find($id);
		$db->delete();
		$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
		redirect('kantor');
	}

	function validation()
	{
		
		$config = array(
		        array(
		                'field' => 'nama_k',
		                'label' => 'Nama Kantor',
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
			$form = $this->form_builder->open_form(array('action' => 'kantor/insert'));
		}elseif ($type=="update") {
			$form = $this->form_builder->open_form(array('action' => 'kantor/update/'.$data->id_k));
		}

		$jenis_kantor = Mjeniskantor::get();
		foreach ($jenis_kantor as $k) {
			$jenis_kantor_option[$k->id_jk] = $k->nama_jk;
		}
		$zona = Mzona::get();
		foreach ($zona as $k) {
			$zona_option[$k->id_z] = $k->nama_z.' ('.$k->deskripsi_z.')';
		}
		$kantor = Mkantor::get();
		$kantor_option[0] = '';
		foreach ($kantor as $k) {
			$kantor_option[$k->id_k] = $k->nama_k;
		}
		$defaults_object_or_array_from_db = NULL;

		$form .= $this->form_builder->build_form_horizontal(
        array(
                array(
                        'id' => 'kode_unit_kerja',
                        'placeholder' => 'Kode Unit Kerja',
                        'name' => 'kode_k',
                        'help' => form_error('kode_k'), 
                        'value' => set_value('kode_k',@$data->koed_k)
                ),
        		array(
                        'id' => 'jenis_kantor',
                        'type' => 'dropdown',
                        'name'	=> 'id_jk',	
                        'options' => $jenis_kantor_option,
                        'value' => set_value('id_jk',@$data->id_jk)
                ),
                array(
                        'id' => 'parent',
                        'type' => 'dropdown',
                        'name'	=> 'id_parent',	
                        'options' => $kantor_option,
                        'value' => set_value('id_parent',@$data->id_parent)
                ),
                array(
                        'id' => 'nama_kantor',
                        'placeholder' => 'Nama Kantor',
                        'name' => 'nama_k',
                        'help' => form_error('nama_k'), 
                        'value' => set_value('nama_k',@$data->nama_k)
                ),
                array(
                        'id' => 'alamat_kantor',
                        'placeholder' => 'Alamat Kantor',
                        'name' => 'alamat_k',
                        'help' => form_error('alamat_k'),                   
                        'value' => set_value('alamat_k',@$data->alamat_k)
                ),
        		array(
                        'id' => 'zona',
                        'type' => 'dropdown',
                        'name'	=> 'id_z',	
                        'options' => $zona_option,
                        'value' => set_value('id_z',@$data->id_z)
                ),
                array(
                        'id' => 'status',
                        'type' => 'dropdown',
                        'name'	=> 'status_k',	
                        'options' => array(
                                '1' => 'Aktif',
                                '0' => 'Tidak Aktif'
                        ),
                        'value' => set_value('status_k',@$data->status_k)
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
