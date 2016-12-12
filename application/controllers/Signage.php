<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signage extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('msignage','mbahan'));

        
        if ($this->session->userdata('isLogin')==FALSE) {
            redirect('login');
        }
    }

	public function create($id)
	{
		$data = array(
			'title'		=> 'Tambah Signage UKER',
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
				'title'		=> 'Tambah Signage UKER',
				'msg_s'		=> '<div class="alert alert-danger text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('insert',$id)
			);

			return view('pekerjaan.form_atm',$data);
        }
        else
        {
            $this->load->library('upload');
            $request = $this->input->post();
            unset($request['submit']);

            $db = new Msignage;
            $db->id_p = $id;
            foreach ($request as $key => $value)
            {
                if ($value!="") {
                    $db->$key = $value;
                }
            }
            $db->file_s = "";
            $db->file_foto_s = "";
            
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
                        $db->file_s = $this->upload->data('file_name');
                    }
                    if ($i==1) {
                        $db->file_foto_s = $this->upload->data('file_name');
                    }
                }
            }
               
            $db->save();

            // $config['upload_path']          = './uploads/montage/';
            // $config['allowed_types']        = 'ppt|pptx|pdf|doc|docx';
            // $config['encrypt_name']         = TRUE;

            // $this->load->library('upload', $config);
            // if ( ! $this->upload->do_upload('userfile')){
            //     $request = $this->input->post();
            //     unset($request['submit']);
            //     $db = new Msignage;
            //     $db->id_p = $id;
            //     foreach ($request as $key => $value)
            //     {
            //         if ($value!="") {
            //             $db->$key = $value;
            //         }
            //     }
            //     $db->save();
            // }else{
            //     $request = $this->input->post();
            //     unset($request['submit']);
            //     $db = new Msignage;
            //     $db->id_p = $id;
            //     foreach ($request as $key => $value)
            //     {
            //         if ($value!="") {
            //             $db->$key = $value;
            //         }
            //     }
            //     $db->file_s = $this->upload->data('file_name');
            //     $db->save();

            // }

        	$this->session->set_flashdata('msg_s','<div class="alert alert-success text-center">Data sudah berhasil dimasukkan!!!</div>');

            redirect('pekerjaan/edit/'.$id);
        }
    }

	public function edit($id="")
	{
		$id_s = $this->input->get('id_s');
		$data = array(
			'title'		=> 'Edit Signage UKER',
			'msg'		=> '',
			'form'		=> $this->form('update',$id,Msignage::find($id_s))
		);

		return view('pekerjaan.form_atm',$data);
	}

	public function update($id)
	{
		$this->validation();
		$id_s = $this->input->get('id_s');
		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Edit Signage UKER',
				'msg_'		=> '<div class="alert alert-danger text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('update',$id,Msignage_atm::find($id_s))
			);

			return view('pekerjaan.form_atm',$data);
        }
        else
        {
            $this->load->library('upload');
            $request = $this->input->post();
            unset($request['submit']);
            $db = Msignage::find($id_s);
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
                        $db->file_s = $this->upload->data('file_name');
                    }
                    if ($i==1) {
                        $db->file_foto_s = $this->upload->data('file_name');
                    }
                }
            }
            $db->save();

	    	$this->session->set_flashdata('msg_s','<div class="alert alert-success text-center">Data sudah berhasil diubah!!!</div>');

	        redirect('pekerjaan/edit/'.$id);
        }		
	}

	public function delete($id="")
	{		
		$id_s = $this->input->get('id_s');
		$db = Msignage::find($id_s);
		$db->delete();
		$this->session->set_flashdata('msg_s','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
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
			$form = $this->form_builder->open_form(array('action' => 'signage/insert/'.$id));
		}elseif ($type=="update") {
			$form = $this->form_builder->open_form(array('action' => 'signage/update/'.$id.'?id_s='.$data->id_s));
		}

		$bahan = Mbahan::get();
		foreach ($bahan as $k) {
			$bahan_option[$k->id_b] = $k->nama_b.' - Rp '.number_format($k->harga_tukang_b);
		}
		$btnfile="";
		if (@$data->file_s) {
			$btnfile = anchor_popup('uploads/'.@$data->file_s, 'Lihat File', array('class' => 'btn btn-primary'));
		}
        $btnfile2="";
        if (@$data->file_foto_s) {
            $btnfile2 = anchor_popup('uploads/'.@$data->file_foto_s, 'Lihat Foto', array('class' => 'btn btn-primary'));
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
                        'name' => 'survey_s',
                        'help' => form_error('survey_s'),                   
                        'value' => set_value('survey_s',@$data->survey_s)
                ),
                array(
                        'id' => 'montage',
                        'type' => 'dropdown',
                        'name'	=> 'montage_s',	
                        'options' => array(
                        		'0' => 'Pengajuan',
                                '1' => 'Approve',
                                '2' => 'Revisi',
                                '3' => 'Cancel'
                        ),
                        'value' => set_value('montage_s',@$data->montage_s)
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
                        'name' => 'nama_tukang_s',
                        'help' => form_error('nama_tukang_s'),                   
                        'value' => set_value('nama_tukang_s',@$data->nama_tukang_s)
                ),
                array(
                        'id' => 'ukuran_panjang',
                        'placeholder' => 'Ukuran Panjang',
                        'name' => 'panjang_s',
                        'help' => form_error('panjang_s'),                   
                        'value' => set_value('panjang_s',@$data->panjang_s)
                ),
                array(
                        'id' => 'ukuran_lebar',
                        'placeholder' => 'Ukuran Lebar',
                        'name' => 'lebar_s',
                        'help' => form_error('lebar_s'),                   
                        'value' => set_value('lebar_s',@$data->lebar_s)
                ),
                array(
                        'id' => 'tanggal_sticker',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal Sticker',
                        'name' => 'sticker_s',
                        'help' => form_error('sticker_s'),                   
                        'value' => set_value('sticker_s',@$data->sticker_s)
                ),
                array(
                        'id' => 'tanggal_pemasangan',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal Pemasangan',
                        'name' => 'pemasangan_s',
                        'help' => form_error('pemasangan_s'),                   
                        'value' => set_value('pemasangan_s',@$data->pemasangan_s)
                ),
                array(
                        'id' => 'foto_pemasangan',
                        'class' => 'datepicker',
                        'placeholder' => 'Foto Pemasangan',
                        'name' => 'foto_pemasangan_s',
                        'help' => form_error('foto_pemasangan_s'),                   
                        'value' => set_value('foto_pemasangan_s',@$data->foto_pemasangan_s)
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
                        'name' => 'bast_s',
                        'help' => form_error('bast_s'),                   
                        'value' => set_value('bast_s',@$data->bast_s)
                ),
                array(
                        'id' => 'tanggal_bapp',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal BAPP',
                        'name' => 'bapp_s',
                        'help' => form_error('bapp_s'),                   
                        'value' => set_value('bapp_s',@$data->bapp_s)
                ),
                array(
                        'id' => 'payment',
                        'placeholder' => 'Payment',
                        'name' => 'payment_s',
                        'help' => form_error('payment_s'),                   
                        'value' => set_value('payment_s',@$data->payment_s)
                ),
                array(
                        'id' => 'tanggal_payment',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal Payment',
                        'name' => 'tanggal_payment_s',
                        'help' => form_error('tanggal_payment_s'),                   
                        'value' => set_value('tanggal_payment_s',@$data->tanggal_payment_s)
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