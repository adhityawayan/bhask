<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signage_atm extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('msignage_atm','mbahan'));

        
        if ($this->session->userdata('isLogin')==FALSE) {
            redirect('login');
        }
    }

	public function create($id)
	{
		$data = array(
			'title'		=> 'Tambah Signage ATM',
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
				'title'		=> 'Tambah Signage ATM',
				'msg'		=> '<div class="alert alert-danger text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('insert',$id)
			);

			return view('pekerjaan.form_atm',$data);
        }
        else
        {
            $this->load->library('upload');
            $request = $this->input->post();
            unset($request['submit']);

            $db = new Msignage_atm;
            $db->id_p = $id;
            foreach ($request as $key => $value)
            {
                if ($value!="") {
                    $db->$key = $value;
                }
            }
            $db->file_sa = "";
            $db->file_foto_sa = "";
            
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
                        $db->file_sa = $this->upload->data('file_name');
                    }
                    if ($i==1) {
                        $db->file_foto_sa = $this->upload->data('file_name');
                    }
                }
            }
               
            $db->save();

        	$this->session->set_flashdata('msg_sa','<div class="alert alert-success text-center">Data sudah berhasil dimasukkan!!!</div>');

            redirect('pekerjaan/edit/'.$id);
        }
    }

	public function edit($id="")
	{
		$id_sa = $this->input->get('id_sa');
		$data = array(
			'title'		=> 'Edit Signage ATM',
			'msg'		=> '',
			'form'		=> $this->form('update',$id,Msignage_atm::find($id_sa))
		);

		return view('pekerjaan.form_atm',$data);
	}

	public function update($id)
	{
		$this->validation();
		$id_sa = $this->input->get('id_sa');
		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Edit Signage ATM',
				'msg'		=> '<div class="alert alert-danger text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('update',$id,Msignage_atm::find($id_sa))
			);

			return view('pekerjaan.form_atm',$data);
        }
        else
        {
            $this->load->library('upload');
            $request = $this->input->post();
            unset($request['submit']);
            $db = Msignage_atm::find($id_sa);
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
                        $db->file_sa = $this->upload->data('file_name');
                    }
                    if ($i==1) {
                        $db->file_foto_sa = $this->upload->data('file_name');
                    }
                }
            }
	    	$this->session->set_flashdata('msg_sa','<div class="alert alert-success text-center">Data sudah berhasil diubah!!!</div>');
            $db->save();

	        redirect('pekerjaan/edit/'.$id);
        }		
	}

	public function delete($id="")
	{		
		$id_sa = $this->input->get('id_sa');
		$db = Msignage_atm::find($id_sa);
		$db->delete();
		$this->session->set_flashdata('msg_sa','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
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
			$form = $this->form_builder->open_form(array('action' => 'signage_atm/insert/'.$id));
		}elseif ($type=="update") {
			$form = $this->form_builder->open_form(array('action' => 'signage_atm/update/'.$id.'?id_sa='.$data->id_sa));
		}

		$bahan = Mbahan::get();
		foreach ($bahan as $k) {
			$bahan_option[$k->id_b] = $k->nama_b.' - Rp '.number_format($k->harga_tukang_b);
		}
		$btnfile="";
		if (@$data->file_sa) {
			$btnfile = anchor_popup('uploads/'.@$data->file_sa, 'Lihat File', array('class' => 'btn btn-primary'));
		}
        $btnfile2="";
        if (@$data->file_foto_sa) {
            $btnfile2 = anchor_popup('uploads/'.@$data->file_foto_sa, 'Lihat Foto', array('class' => 'btn btn-primary'));
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
                        'name' => 'survey_sa',
                        'help' => form_error('survey_sa'),                   
                        'value' => set_value('survey_sa',@$data->survey_sa)
                ),
                array(
                        'id' => 'montage',
                        'type' => 'dropdown',
                        'name'	=> 'montage_sa',	
                        'options' => array(
                        		'0' => 'Pengajuan',
                                '1' => 'Approve',
                                '2' => 'Revisi',
                                '3' => 'Cancel'
                        ),
                        'value' => set_value('montage_sa',@$data->montage_sa)
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
                        'name' => 'nama_tukang_sa',
                        'help' => form_error('nama_tukang_sa'),                   
                        'value' => set_value('nama_tukang_sa',@$data->nama_tukang_sa)
                ),
                array(
                        'id' => 'ukuran_depan',
                        'placeholder' => 'Ukuran Depan',
                        'name' => 'depan_sa',
                        'help' => form_error('depan_sa'),                   
                        'value' => set_value('depan_sa',@$data->depan_sa)
                ),
                array(
                        'id' => 'ukuran_kanan',
                        'placeholder' => 'Ukuran Kanan',
                        'name' => 'kanan_sa',
                        'help' => form_error('kanan_sa'),                   
                        'value' => set_value('kanan_sa',@$data->kanan_sa)
                ),
                array(
                        'id' => 'ukuran_kiri',
                        'placeholder' => 'Ukuran Kiri',
                        'name' => 'kiri_sa',
                        'help' => form_error('kiri_sa'),                   
                        'value' => set_value('kiri_sa',@$data->kiri_sa)
                ),
                array(
                        'id' => 'ukuran_belakang',
                        'placeholder' => 'Ukuran Belakang',
                        'name' => 'belakang_sa',
                        'help' => form_error('belakang_sa'),                   
                        'value' => set_value('belakang_sa',@$data->belakang_sa)
                ),
                array(
                        'id' => 'ukuran_tinggi',
                        'placeholder' => 'Ukuran Tinggi',
                        'name' => 'tinggi_sa',
                        'help' => form_error('tinggi_sa'),                   
                        'value' => set_value('tinggi_sa',@$data->tinggi_sa)
                ),
                array(
                        'id' => 'tanggal_sticker',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal Sticker',
                        'name' => 'sticker_sa',
                        'help' => form_error('sticker_sa'),                   
                        'value' => set_value('sticker_sa',@$data->sticker_sa)
                ),
                array(
                        'id' => 'tanggal_pemasangan',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal Pemasangan',
                        'name' => 'pemasangan_sa',
                        'help' => form_error('pemasangan_sa'),                   
                        'value' => set_value('pemasangan_sa',@$data->pemasangan_sa)
                ),
                array(
                        'id' => 'foto_pemasangan',
                        'class' => 'datepicker',
                        'placeholder' => 'Foto Pemasangan',
                        'name' => 'foto_pemasangan_sa',
                        'help' => form_error('foto_pemasangan_sa'),                   
                        'value' => set_value('foto_pemasangan_sa',@$data->foto_pemasangan_sa)
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
                        'name' => 'bast_sa',
                        'help' => form_error('bast_sa'),                   
                        'value' => set_value('bast_sa',@$data->bast_sa)
                ),
                array(
                        'id' => 'tanggal_bapp',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal BAPP',
                        'name' => 'bapp_sa',
                        'help' => form_error('bapp_sa'),                   
                        'value' => set_value('bapp_sa',@$data->bapp_sa)
                ),
                array(
                        'id' => 'payment',
                        'placeholder' => 'Payment',
                        'name' => 'payment_sa',
                        'help' => form_error('payment_sa'),                   
                        'value' => set_value('payment_sa',@$data->payment_sa)
                ),
                array(
                        'id' => 'tanggal_payment',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal Payment',
                        'name' => 'tanggal_payment_sa',
                        'help' => form_error('tanggal_payment_sa'),                   
                        'value' => set_value('tanggal_payment_sa',@$data->tanggal_payment_sa)
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