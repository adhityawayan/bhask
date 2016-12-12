<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pylon extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('mpylon','mbahan'));

        
        if ($this->session->userdata('isLogin')==FALSE) {
            redirect('login');
        }
    }

	public function create($id)
	{
		$data = array(
			'title'		=> 'Tambah Pylon',
			'msg'		=> '',
			'form'		=> $this->form('insert',$id)
		);

		return view('pekerjaan.form_atm',$data);
	}

	public function insert($id)
	{	
		$this->validation();
		
		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Tambah Signage',
				'msg_py'		=> '<div class="alert alert-danger text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('insert',$id)
			);

			return view('pekerjaan.form_atm',$data);
        }
        else
        {
            $this->load->library('upload');
            $request = $this->input->post();
            unset($request['submit']);

            $db = new Mpylon;
            $db->id_p = $id;
            foreach ($request as $key => $value)
            {
                if ($value!="") {
                    $db->$key = $value;
                }
            }
            $db->file_py = "";
            $db->file_foto_py = "";
            
            for ($i = 0; $i < 2; $i++) {
                $_FILES['userfile']['name']     = $_FILES['upload']['name'][$i];
                $_FILES['userfile']['type']     = $_FILES['upload']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $_FILES['upload']['tmp_name'][$i];
                $_FILES['userfile']['error']    = $_FILES['upload']['error'][$i];
                $_FILES['userfile']['size']     = $_FILES['upload']['size'][$i];
                if ($i==0) {
                    $config = array(
                        'overwrite'     => FALSE,
                        'allowed_types' => 'ppt|pptx|pdf|doc|docx',
                        'encrypt_name'  => TRUE,                
                        'upload_path'   => './uploads/'
                      );
                }
                if ($i==1) {
                    $config = array(
                        'overwrite'     => FALSE,
                        'allowed_types' => 'jpg|jpeg|png',
                        'encrypt_name'  => TRUE,                
                        'upload_path'   => './uploads/'
                      );
                }
                $this->upload->initialize($config);
                if ( ! $this->upload->do_upload('userfile')) {
                    $error = array('error' => $this->upload->display_errors());
                }else{
                    if ($i==0) {
                        $db->file_py = $this->upload->data('file_name');
                    }
                    if ($i==1) {
                        $db->file_foto_py = $this->upload->data('file_name');
                    }
                }
            }
               
            $db->save();

        	$this->session->set_flashdata('msg_py','<div class="alert alert-success text-center">Data sudah berhasil dimasukkan!!!</div>');

            redirect('pekerjaan/edit/'.$id);
        }
    }

	public function edit($id="")
	{
		$id_py = $this->input->get('id_py');
		$data = array(
			'title'		=> 'Edit Pylon',
			'msg'		=> '',
			'form'		=> $this->form('update',$id,Mpylon::find($id_py))
		);

		return view('pekerjaan.form_atm',$data);
	}

	public function update($id)
	{
		$this->validation();
		$id_py = $this->input->get('id_py');
		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Edit Pylon',
				'msg_'		=> '<div class="alert alert-danger text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('update',$id,Mpylon::find($id_py))
			);

			return view('pekerjaan.form_atm',$data);
        }
        else
        {
            $this->load->library('upload');
            $request = $this->input->post();
            unset($request['submit']);
            $db = Mpylon::find($id_py);
            foreach ($request as $key => $value)
            {
                if ($value!="") {
                    $db->$key = $value;
                }
            }
            for ($i = 0; $i < 2; $i++) {
                $_FILES['userfile']['name']     = $_FILES['upload']['name'][$i];
                $_FILES['userfile']['type']     = $_FILES['upload']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $_FILES['upload']['tmp_name'][$i];
                $_FILES['userfile']['error']    = $_FILES['upload']['error'][$i];
                $_FILES['userfile']['size']     = $_FILES['upload']['size'][$i];
                if ($i==0) {
                    $config = array(
                        'overwrite'     => FALSE,
                        'allowed_types' => 'ppt|pptx|pdf|doc|docx',
                        'encrypt_name'  => TRUE,                
                        'upload_path'   => './uploads/'
                      );
                }
                if ($i==1) {
                    $config = array(
                        'overwrite'     => FALSE,
                        'allowed_types' => 'jpg|jpeg|png',
                        'encrypt_name'  => TRUE,                
                        'upload_path'   => './uploads/'
                      );
                }
                $this->upload->initialize($config);
                if ( ! $this->upload->do_upload('userfile')) {
                    $error = array('error' => $this->upload->display_errors());
                }else{
                    if ($i==0) {
                        $db->file_py = $this->upload->data('file_name');
                    }
                    if ($i==1) {
                        $db->file_foto_py = $this->upload->data('file_name');
                    }
                }
            }
            $db->save();
        	

	    	$this->session->set_flashdata('msg_py','<div class="alert alert-success text-center">Data sudah berhasil diubah!!!</div>');

	        redirect('pekerjaan/edit/'.$id);
        }		
	}

	public function delete($id="")
	{		
		$id_py = $this->input->get('id_py');
		$db = Mpylon::find($id_py);
		$db->delete();
		$this->session->set_flashdata('msg_py','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
		redirect('pekerjaan/edit/'.$id);
	}

	function validation()
	{
		
		$config = array(
				array(
		                'field' => 'id_b',
		                'label' => 'Sub Kontraktor',
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
			$form = $this->form_builder->open_form(array('action' => 'pylon/insert/'.$id));
		}elseif ($type=="update") {
			$form = $this->form_builder->open_form(array('action' => 'pylon/update/'.$id.'?id_py='.$data->id_py));
		}

		$bahan = Mbahan::get();
		foreach ($bahan as $k) {
			$bahan_option[$k->id_b] = $k->nama_b.' - Rp '.number_format($k->harga_tukang_b);
		}
		$btnfile="";
		if (@$data->file_py) {
			$btnfile = anchor_popup('uploads/'.@$data->file_py, 'Lihat File', array('class' => 'btn btn-primary'));
		}
        $btnfile2="";
        if (@$data->file_foto_py) {
            $btnfile2 = anchor_popup('uploads/'.@$data->file_foto_py, 'Lihat Foto', array('class' => 'btn btn-primary'));
        }
		$defaults_object_or_array_from_db = NULL;
		$form .= $this->form_builder->build_form_horizontal(
        array(
        		array(
                        'id' => 'sub_kontraktor',
                        'type' => 'dropdown',
                        'name'	=> 'id_b',	
                        'options' => $bahan_option,
                        'value' => set_value('id_b',@$data->id_b)
                ),
                array(
                        'id' => 'tanggal_survey',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal Survey',
                        'name' => 'survey_py',
                        'help' => form_error('survey_py'),                   
                        'value' => set_value('survey_py',@$data->survey_py)
                ),
                array(
                        'id' => 'montage',
                        'type' => 'dropdown',
                        'name'	=> 'montage_py',	
                        'options' => array(
                        		'0' => 'Pengajuan',
                                '1' => 'Approve',
                                '2' => 'Revisi',
                                '3' => 'Cancel'
                        ),
                        'value' => set_value('montage_py',@$data->montage_py)
                ),
                array(
                        'id' => 'file_montage',
                        'type' => 'upload',
                        'placeholder' => 'File Montage',
                        'name' => 'upload[]',
                        'help' => $btnfile,
                ),
                array(
                        'id' => 'nama_tukang',
                        'placeholder' => 'Nama Tukang',
                        'name' => 'nama_tukang_py',
                        'help' => form_error('nama_tukang_py'),                   
                        'value' => set_value('nama_tukang_py',@$data->nama_tukang_py)
                ),
                array(
                        'id' => 'tanggal_sticker',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal Sticker',
                        'name' => 'sticker_py',
                        'help' => form_error('sticker_py'),                   
                        'value' => set_value('sticker_py',@$data->sticker_py)
                ),
                array(
                        'id' => 'tanggal_pemasangan',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal Pemasangan',
                        'name' => 'pemasangan_py',
                        'help' => form_error('pemasangan_py'),                   
                        'value' => set_value('pemasangan_py',@$data->pemasangan_py)
                ),
                array(
                        'id' => 'foto_pemasangan',
                        'class' => 'datepicker',
                        'placeholder' => 'Foto Pemasangan',
                        'name' => 'foto_pemasangan_py',
                        'help' => form_error('foto_pemasangan_py'),                   
                        'value' => set_value('foto_pemasangan_py',@$data->foto_pemasangan_py)
                ),
                array(
                        'id' => 'upload_foto',
                        'type' => 'upload',
                        'placeholder' => 'Upload Foto',
                        'name' => 'upload[]',
                        'help' => $btnfile2,
                ),
                array(
                        'id' => 'tanggal_bast',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal BAST',
                        'name' => 'bast_py',
                        'help' => form_error('bast_py'),                   
                        'value' => set_value('bast_py',@$data->bast_py)
                ),
                array(
                        'id' => 'tanggal_bapp',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal BAPP',
                        'name' => 'bapp_py',
                        'help' => form_error('bapp_py'),                   
                        'value' => set_value('bapp_py',@$data->bapp_py)
                ),
                array(
                        'id' => 'payment',
                        'placeholder' => 'Payment',
                        'name' => 'payment_py',
                        'help' => form_error('payment_py'),                   
                        'value' => set_value('payment_py',@$data->payment_py)
                ),
                array(
                        'id' => 'tanggal_payment',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal Payment',
                        'name' => 'tanggal_payment_py',
                        'help' => form_error('tanggal_payment_py'),                   
                        'value' => set_value('tanggal_payment_py',@$data->tanggal_payment_py)
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