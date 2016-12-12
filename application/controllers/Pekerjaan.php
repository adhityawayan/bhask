<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pekerjaan extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('mpekerjaan','mkantor','msignage_atm','msignage','mpylon'));
        
        if ($this->session->userdata('isLogin')==FALSE) {
			redirect('login');
		}
    }

	public function index()
	{		
		$data = array(
			'title'		=> 'Pekerjaan',
			'msg'		=> $this->session->flashdata('msg'),
			'table'		=> Mpekerjaan::select('pekerjaan.*',
											'kantor.nama_k')
							->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
							->get(),
		);
		return view('pekerjaan.index',$data);
	}

	public function create()
	{
		$data = array(
			'title'		=> 'Tambah Pekerjaan',
			'msg'		=> '',
			'form'		=> $this->form('insert')
		);

		return view('pekerjaan.form',$data);
	}

	public function insert()
	{	
		$this->validation();
		
		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Tambah Pekerjaan',
				'msg'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('insert')
			);

			return view('pekerjaan.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = new Mpekerjaan;
	        $db->id_k = $request['id_k'];
	        $db->save();

        	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil dimasukkan!!!</div>');

            redirect('pekerjaan');
        }
    }

	public function detail($id="")
	{
		$data = array(
			'title'		=> 'Detail Pekerjaan',
			'msg'		=> $this->session->flashdata('msg'),
			'msg_s'		=> $this->session->flashdata('msg_s'),
			'msg_py'		=> $this->session->flashdata('msg_py'),
			'detail'	=> Mpekerjaan::select('pekerjaan.*',
											'kantor.nama_k')
							->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
							->find($id),
			'signage_atm'	=> Msignage_atm::leftjoin('bahan', 'bahan.id_b','=','signage_atm.id_b')
							->where('id_p',$id)->get(),
			'signage'	=> Msignage::leftjoin('bahan', 'bahan.id_b','=','signage.id_b')
							->where('id_p',$id)->get(),
			'pylon'	=> Mpylon::leftjoin('bahan', 'bahan.id_b','=','pylon.id_b')
							->where('id_p',$id)->get(),
		);

		return view('pekerjaan.detail',$data);
	}

	public function bast($id="")
	{
		$filename = "BAST".date('dmY').".doc";
	    header("Content-Type: application/vnd.ms-word");
	    header("Expires: 0");
	    header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
	    header("Content-disposition: attachment; filename=".$filename);

		$data = array(
			'title'		=> 'BAST #'.$id,
			'detail'	=> Mpekerjaan::select('pekerjaan.*',
											'kantor.nama_k')
							->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
							->find($id),
			'signage_atm'	=> Msignage_atm::leftjoin('bahan', 'bahan.id_b','=','signage_atm.id_b')
							->where('id_p',$id)->get(),
			'signage'	=> Msignage::leftjoin('bahan', 'bahan.id_b','=','signage.id_b')
							->where('id_p',$id)->get(),
			'pylon'	=> Mpylon::leftjoin('bahan', 'bahan.id_b','=','pylon.id_b')
							->where('id_p',$id)->get(),
		);

		$this->load->view('pekerjaan/bast',$data);
	}

	public function edit($id="")
	{
		$data = array(
			'title'		=> 'Edit Pekerjaan',
			'msg'		=> '',
			'form'		=> $this->form('update',Mpekerjaan::find($id)),

			'msg_s'		=> $this->session->flashdata('msg_s'),
			'msg_py'		=> $this->session->flashdata('msg_py'),
			'msg_sa'		=> $this->session->flashdata('msg_sa'),
			'detail'	=> Mpekerjaan::select('pekerjaan.*',
											'kantor.nama_k')
							->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
							->find($id),
			'signage_atm'	=> Msignage_atm::leftjoin('bahan', 'bahan.id_b','=','signage_atm.id_b')
							->where('id_p',$id)->get(),
			'signage'	=> Msignage::leftjoin('bahan', 'bahan.id_b','=','signage.id_b')
							->where('id_p',$id)->get(),
			'pylon'	=> Mpylon::leftjoin('bahan', 'bahan.id_b','=','pylon.id_b')
							->where('id_p',$id)->get(),
		);

		return view('pekerjaan.form',$data);
	}

	public function update($id)
	{
		$this->validation();

		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Edit Pekerjaan',
				'msg'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('update',Mpekerjaan::find($id)),

				'msg_s'		=> $this->session->flashdata('msg_s'),
				'msg_py'		=> $this->session->flashdata('msg_py'),
				'detail'	=> Mpekerjaan::select('pekerjaan.*',
												'kantor.nama_k')
								->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
								->find($id),
				'signage_atm'	=> Msignage_atm::leftjoin('bahan', 'bahan.id_b','=','signage_atm.id_b')
								->where('id_p',$id)->get(),
				'signage'	=> Msignage::leftjoin('bahan', 'bahan.id_b','=','signage.id_b')
								->where('id_p',$id)->get(),
				'pylon'	=> Mpylon::leftjoin('bahan', 'bahan.id_b','=','pylon.id_b')
								->where('id_p',$id)->get(),
			);

			return view('pekerjaan.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = Mpekerjaan::find($id);
	        $db->id_k = $request['id_k'];
	        $db->save();

	    	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil diubah!!!</div>');

	        redirect('pekerjaan');
        }		
	}

	public function delete($id="")
	{		
		$db = Mpekerjaan::find($id);
		$db->delete();
		$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
		redirect('pekerjaan');
	}

	function validation()
	{
		
		$config = array(
		        array(
		                'field' => 'id_k',
		                'label' => 'Kantor',
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
			$form = $this->form_builder->open_form(array('action' => 'pekerjaan/insert'));
		}elseif ($type=="update") {
			$form = $this->form_builder->open_form(array('action' => 'pekerjaan/update/'.$data->id_p));
		}
		$defaults_object_or_array_from_db = NULL;
		$kantor = Mkantor::select('kantor.id_k',
											'kantor.kode_k',
											'kantor.nama_k',
											'kantor.id_parent',
											'kantor.alamat_k',
											'kantor.status_k',
											't2.nama_k as nama_parent',
											'jk.nama_jk',
											'jk2.nama_jk as nama_jk2')
							->leftjoin('kantor as t2', 't2.id_k','=','kantor.id_parent')
							->leftjoin("jenis_kantor as jk","kantor.id_jk","=","jk.id_jk")
							->leftjoin("jenis_kantor as jk2","t2.id_jk","=","jk2.id_jk")
							->get();
		$kantor_option[0] = '';
		foreach ($kantor as $k) {
			if ($k->nama_parent!="") {
				$kantor_option[$k->id_k] = $k->kode_k.' '.$k->nama_jk.' '.$k->nama_k.' <<< '.$k->nama_jk2.' '.$k->nama_parent;
			}else{				
				$kantor_option[$k->id_k] = $k->kode_k.' '.$k->nama_jk.' '.$k->nama_k;
			}
		}
		$form .= $this->form_builder->build_form_horizontal(
        array(
                array(
                        'id' => 'nama_kantor/ATM',
                        'type' => 'dropdown',
                        'name'	=> 'id_k',	
                        'options' => $kantor_option,
                        'value' => set_value('id_k',@$data->id_k)
                ),
                // array(
                //         'id' => 'tanggal_bast',
                //         'type' => 'date',
                //         'name'	=> 'bast_k',	
                //         'placeholder' => 'Dikosongkan apabila baru membuat pekerjaan',
                //         'value' => set_value('bast_k',@$data->bast_k)
                // ),
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
