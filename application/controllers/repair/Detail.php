<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('mrepairdetail','mrepairsubkon'));

        
        if ($this->session->userdata('isLogin')==FALSE) {
            redirect('login');
        }
    }

	public function create($id)
	{
		$data = array(
			'title'		=> 'Tambah Detail',
			'msg'		=> '',
			'form'		=> $this->form('insert',$id)
		);

		return view('repair.pekerjaan.form_atm',$data);
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

			return view('repair.pekerjaan.form_atm',$data);
        }
        else
        {
            $this->load->library('upload');
            $request = $this->input->post();
            unset($request['submit']);

            $db = new Mrepairdetail;
            $db->id_repair_pekerjaan = $id;
            foreach ($request as $key => $value)
            {
                if ($value!="") {
                    $db->$key = $value;
                }
            }
            $db->file_repair_detail = "";
            $db->file_foto_repair_detail = "";
            
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
                        $db->file_repair_detail = $this->upload->data('file_name');
                    }
                    if ($i==1) {
                        $db->file_foto_repair_detail = $this->upload->data('file_name');
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
            //     $db = new Mrepairdetail;
            //     $db->id_repair_pekerjaan = $id;
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
            //     $db = new Mrepairdetail;
            //     $db->id_repair_pekerjaan = $id;
            //     foreach ($request as $key => $value)
            //     {
            //         if ($value!="") {
            //             $db->$key = $value;
            //         }
            //     }
            //     $db->file_s = $this->upload->data('file_name');
            //     $db->save();

            // }

        	$this->session->set_flashdata('msg_py','<div class="alert alert-success text-center">Data sudah berhasil dimasukkan!!!</div>');

            redirect('repair/pekerjaan/edit/'.$id);
        }
    }

	public function edit($id="")
	{
		$id_repair_detail = $this->input->get('id_repair_detail');
		$data = array(
			'title'		=> 'Edit Repair Detail',
			'msg'		=> '',
			'form'		=> $this->form('update',$id,Mrepairdetail::find($id_repair_detail))
		);

		return view('repair.pekerjaan.form_atm',$data);
	}

	public function update($id)
	{
		$this->validation();
		$id_repair_detail = $this->input->get('id_repair_detail');
		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Edit Repair Detail',
				'msg_'		=> '<div class="alert alert-danger text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('update',$id,Mrepairdetail::find($id_repair_detail))
			);

			return view('repair.pekerjaan.form_atm',$data);
        }
        else
        {
            $this->load->library('upload');
            $request = $this->input->post();
            unset($request['submit']);
            $db = Mrepairdetail::find($id_repair_detail);
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
                        $db->file_repair_detail = $this->upload->data('file_name');
                    }
                    if ($i==1) {
                        $db->file_foto_repair_detail = $this->upload->data('file_name');
                    }
                }
            }
            $db->save();

	    	$this->session->set_flashdata('msg_py','<div class="alert alert-success text-center">Data sudah berhasil diubah!!!</div>');

	        redirect('repair/pekerjaan/edit/'.$id);
        }		
	}

	public function delete($id="")
	{		
		$id_repair_detail = $this->input->get('id_repair_detail');
		$db = Mrepairdetail::find($id_repair_detail);
		$db->delete();
		$this->session->set_flashdata('msg_py','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
		redirect('pekerjaan/edit/'.$id);
	}

	function validation()
	{
		
		$config = array(
				array(
		                'field' => 'id_repair_subkon',
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
			$form = $this->form_builder->open_form(array('action' => 'repair/detail/insert/'.$id));
		}elseif ($type=="update") {
			$form = $this->form_builder->open_form(array('action' => 'repair/detail/update/'.$id.'?id_repair_detail='.$data->id_repair_detail));
		}

		$subkon = Mrepairsubkon::get();
		foreach ($subkon as $k) {
			$subkon_option[$k->id_repair_subkon] = $k->nama_repair_subkon.' - Rp '.number_format($k->harga_repair_subkon);
		}
		$btnfile="";
		if (@$data->file_repair_detail) {
			$btnfile = anchor_popup('uploads/'.@$data->file_repair_detail, 'Lihat File', array('class' => 'btn btn-primary'));
		}
        $btnfile2="";
        if (@$data->file_foto_repair_detail) {
            $btnfile2 = anchor_popup('uploads/'.@$data->file_foto_repair_detail, 'Lihat Foto', array('class' => 'btn btn-primary'));
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
                        'id' => 'tanggal_survey',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal Survey',
                        'name' => 'survey_repair_detail',
                        'help' => form_error('survey_repair_detail'),                   
                        'value' => set_value('survey_repair_detail',@$data->survey_repair_detail)
                ),
                array(
                        'id' => 'montage',
                        'type' => 'dropdown',
                        'name'	=> 'montage_repair_detail',	
                        'options' => array(
                        		'0' => 'Pengajuan',
                                '1' => 'Approve',
                                '2' => 'Revisi',
                                '3' => 'Cancel'
                        ),
                        'value' => set_value('montage_repair_detail',@$data->montage_repair_detail)
                ),
                array(
                        'id' => 'file_montage',
                        'type' => 'upload',
                        'placeholder' => 'Foto Before',
                        'name' => 'upload[]',
                        'help' => $btnfile,
                ),
                array(
                        'id' => 'nama_tukang',
                        'placeholder' => 'Nama Tukang',
                        'name' => 'nama_tukang_repair_detail',
                        'help' => form_error('nama_tukang_repair_detail'),                   
                        'value' => set_value('nama_tukang_repair_detail',@$data->nama_tukang_repair_detail)
                ),
                array(
                        'id' => 'tanggal_sticker',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal Sticker',
                        'name' => 'sticker_repair_detail',
                        'help' => form_error('sticker_repair_detail'),                   
                        'value' => set_value('sticker_repair_detail',@$data->sticker_repair_detail)
                ),
                array(
                        'id' => 'tanggal_pemasangan',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal Pemasangan',
                        'name' => 'pemasangan_repair_detail',
                        'help' => form_error('pemasangan_repair_detail'),                   
                        'value' => set_value('pemasangan_repair_detail',@$data->pemasangan_repair_detail)
                ),
                // array(
                //         'id' => 'tanggal_foto_pemasangan',
                //         'class' => 'datepicker',
                //         'placeholder' => 'Tanggal Foto Pemasangan',
                //         'name' => 'foto_pemasangan_repair_detail',
                //         'help' => form_error('foto_pemasangan_repair_detail'),                   
                //         'value' => set_value('foto_pemasangan_repair_detail',@$data->foto_pemasangan_repair_detail)
                // ),
                array(
                        'id' => 'upload_foto',
                        'type' => 'upload',
                        'placeholder' => 'Foto Pemasangan',
                        'name' => 'upload[]',
                        'help' => $btnfile2,
                ),
                array(
                        'id' => 'tanggal_bast',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal BAST',
                        'name' => 'bast_repair_detail',
                        'help' => form_error('bast_repair_detail'),                   
                        'value' => set_value('bast_repair_detail',@$data->bast_repair_detail)
                ),
                // array(
                //         'id' => 'tanggal_bapp',
                //         'class' => 'datepicker',
                //         'placeholder' => 'Tanggal BAPP',
                //         'name' => 'bapp_repair_detail',
                //         'help' => form_error('bapp_repair_detail'),                   
                //         'value' => set_value('bapp_repair_detail',@$data->bapp_repair_detail)
                // ),
                array(
                        'id' => 'payment',
                        'placeholder' => 'Payment',
                        'name' => 'payment_repair_detail',
                        'help' => form_error('payment_repair_detail'),                   
                        'value' => set_value('payment_repair_detail',@$data->payment_repair_detail)
                ),
                array(
                        'id' => 'tanggal_payment',
                        'class' => 'datepicker',
                        'placeholder' => 'Tanggal Payment',
                        'name' => 'tanggal_payment_repair_detail',
                        'help' => form_error('tanggal_payment_repair_detail'),                   
                        'value' => set_value('tanggal_payment_repair_detail',@$data->tanggal_payment_repair_detail)
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