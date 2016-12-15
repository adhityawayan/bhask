<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spk extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('mspk','mkantor','mrsp','mpekerjaan','msignage_atm','msignage','mpylon','mharga_bahan'));

        
        if ($this->session->userdata('isLogin')==FALSE) {
			redirect('login');
		}
    }

	public function index()
	{		
		$data = array(
			'title'		=> 'SPK',
			'msg'		=> $this->session->flashdata('msg'),
			'table'		=> Mspk::get(),
		);
		return view('spk.index',$data);
	}

	public function create()
	{
		$data = array(
			'title'		=> 'Tambah SPK',
			'msg'		=> '',
			'form'		=> $this->form('insert'),
			'detail'	=> false,
		);

		return view('spk.form',$data);
	}

	public function insert()
	{	
		$this->validation();
		
		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Tambah Sub Kontraktor',
				'msg'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('insert'),
				'detail'	=> false,
			);

			return view('spk.form',$data);
        }
        else
        {
        	$request = $this->input->post();
        	unset($request['submit']);
			$db = new Mspk;
	        foreach ($request as $key => $value)
            {
                if ($value!="") {
                    $db->$key = $value;
                }
            }
	        $db->save();

        	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil dimasukkan!!!</div>');

            redirect('spk/edit/'.$db->id_sp);
        }
    }

	public function edit($id="")
	{
		$data = array(
			'title'		=> 'Edit SPK',
			'msg'		=> '',
			'msg_r'		=> '',
			'detail'	=> true,
			'form'		=> $this->form('update',Mspk::find($id)),
			'form2'		=> $this->form2($id),
			'relasi'	=> Mrsp::leftjoin('pekerjaan', 'pekerjaan.id_p','=','r_sp.id_p')
							->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
							->where('id_sp',$id)
							->get()
		);

		return view('spk.form',$data);
	}

	public function spk($id="")
	{
		$filename = "SPK".date('dmY').".doc";
	    header("Content-Type: application/vnd.ms-word");
	    header("Expires: 0");
	    header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
	    header("Content-disposition: attachment; filename=".$filename);

        $data = array(
			'title'		=> 'SPK - '.$id,
			'spk'		=> Mspk::find($id),
			'relasi'	=> Mrsp::leftjoin('pekerjaan', 'pekerjaan.id_p','=','r_sp.id_p')
							->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
							->where('id_sp',$id)
							->get()
		);
        $this->load->view('spk/spk',$data);

    }

	public function bapp($id="")
	{
		$filename = "BAPP".date('dmY').".doc";
	    header("Content-Type: application/vnd.ms-word");
	    header("Expires: 0");
	    header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
	    header("Content-disposition: attachment; filename=".$filename);

        $data = array(
			'title'		=> 'BAPP - '.$id,
			'spk'		=> Mspk::select('kantor.id_k',
											'kantor.kode_k',
											'kantor.nama_k',
											'kantor.id_parent',
											'kantor.alamat_k',
											'kantor.status_k',
											't2.nama_k as nama_parent',
											't2.alamat_k as alamat_parent',
											't3.nama_k as nama_logistik',
											'jk.id_jk',
											'jk.nama_jk',
											'jk2.id_jk as id_jk2',
											'jk2.nama_jk as nama_jk2',
											'jk3.nama_jk as nama_jk3',
											'spk.*')
							->leftjoin('kantor', 'kantor.id_k','=','spk.id_k')
							->leftjoin('kantor as t2', 't2.id_k','=','kantor.id_parent')
							->leftjoin('kantor as t3', 't3.id_k','=','spk.id_k_logistik')
							->leftjoin("jenis_kantor as jk","kantor.id_jk","=","jk.id_jk")
							->leftjoin("jenis_kantor as jk2","t2.id_jk","=","jk2.id_jk")
							->leftjoin("jenis_kantor as jk3","t3.id_jk","=","jk3.id_jk")
							->find($id),
			'relasi'	=> Mrsp::leftjoin('pekerjaan', 'pekerjaan.id_p','=','r_sp.id_p')
							->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
							->where('id_sp',$id)
							->get()
		);
        $this->load->view('spk/bapp',$data);
    }

	public function invoice($id="")
	{
		$filename = "INVOICE".date('dmY').".doc";
	    header("Content-Type: application/vnd.ms-word");
	    header("Expires: 0");
	    header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
	    header("Content-disposition: attachment; filename=".$filename);

	 //    $request = $this->input->post();
		// $db = Mspk::find($id);
  //       $db->no_invoice = $id ." - ".substr(date('Y'), -2).date('md').$id;
  //       $db->tanggal_invoice = date('Y-m-d');
  //       $db->save();


        $data = array(
			'title'		=> 'BAPP - '.$id,
			'spk'		=> Mspk::select('kantor.id_k',
											'kantor.kode_k',
											'kantor.nama_k',
											'kantor.id_parent',
											'kantor.alamat_k',
											'kantor.status_k',
											't2.nama_k as nama_parent',
											'jk.nama_jk',
											'jk2.nama_jk as nama_jk2',
											'spk.*')
							->leftjoin('kantor', 'kantor.id_k','=','spk.id_k')
							->leftjoin('kantor as t2', 't2.id_k','=','kantor.id_parent')
							->leftjoin("jenis_kantor as jk","kantor.id_jk","=","jk.id_jk")
							->leftjoin("jenis_kantor as jk2","t2.id_jk","=","jk2.id_jk")
							->find($id),
			'relasi'	=> Mrsp::leftjoin('pekerjaan', 'pekerjaan.id_p','=','r_sp.id_p')
							->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
							->where('id_sp',$id)
							->get()
		);
        $this->load->view('spk/invoice',$data);
    }

	public function update($id)
	{
		$this->validation();

		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Edit SPK',
				'msg'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'msg_r'		=> '',
				'id_rsp'	=> $id,
				'detail'	=> true,
				'form'		=> $this->form('update',Mspk::find($id)),
				'form2'		=> $this->form2($id),
				'relasi'	=> Mrsp::leftjoin('pekerjaan', 'pekerjaan.id_p','=','r_sp.id_p')
								->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
								->where('id_sp',$id)
								->get()
			);


			return view('spk.form',$data);
        }
        else
        {
        	$request = $this->input->post();
        	unset($request['submit']);
			$db = Mspk::find($id);
	        foreach ($request as $key => $value)
            {
                if ($value!="") {
                    $db->$key = $value;
                }
            }
	        $db->save();

	    	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil diubah!!!</div>');

	        redirect('spk');
        }		
	}

	public function insert_relasi($id)
	{
		$this->validation2();

		if ($this->form_validation->run() == FALSE)
        {
            $data = array(
				'title'		=> 'Edit SPK',
				'detail'	=> true,
				'msg'		=> '',
				'msg_r'		=> '<div class="alert alert-warning text-center">Silahkan dicek kembali yang Anda masukkan!!!</div>',
				'form'		=> $this->form('update',Mspk::find($id)),
				'form2'		=> $this->form2($id),
				'relasi'	=> Mrsp::leftjoin('pekerjaan', 'pekerjaan.id_p','=','r_sp.id_p')
								->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
								->where('id_sp',$id)
								->get()
			);

			return view('spk.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = new Mrsp;
	        $db->id_sp = $request['id_sp'];
	        $db->id_p = $request['id_p'];
	        $db->save();

	    	$this->session->set_flashdata('msg_r','<div class="alert alert-success text-center">Data sudah berhasil ditambah!!!</div>');

	        redirect('spk/edit/'.$id);
        }		
	}

	public function delete($id="")
	{		
		$db = Mspk::find($id);
		$db->delete();
		$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
		redirect('spk');
	}

	public function delete_relasi($id="")
	{		
		$db = Mrsp::find($this->input->get('id_rsp'));
		$db->delete();
		$this->session->set_flashdata('msg_r','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
		redirect('spk/edit/'.$id);
	}

	function validation()
	{
		
		$config = array(
		        array(
		                'field' => 'judul_sp',
		                'label' => 'Judul',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Anda harus mengisi kolom %s.',
		                ),
		        ),
		        array(
		                'field' => 'no_pengajuan_sp',
		                'label' => 'Nomor Pengajuan',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Anda harus mengisi kolom %s.',
		                ),
		        ),
		        array(
		                'field' => 'tanggal_pengajuan_sp',
		                'label' => 'Tanggal Pengajuan',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Anda harus mengisi kolom %s.',
		                ),
		        ),
		);
		return $this->form_validation->set_rules($config);
	}
	function validation2()
	{
		
		$config = array(
		        array(
		                'field' => 'id_p',
		                'label' => 'Pekerjaan',
		                'rules' => 'required|is_unique[r_sp.id_p]',
		                'errors' => array(
		                        'required' => 'Anda harus mengisi kolom %s.',
		                        'is_unique' => 'Pekerjaan sudah memiliki SPK'
		                ),
		        ),
		);
		return $this->form_validation->set_rules($config);
	}
	function form($type="",$data="")
	{
		if ($type=="insert") {
			$form = $this->form_builder->open_form(array('action' => 'spk/insert'));
		}elseif ($type=="update") {
			$form = $this->form_builder->open_form(array('action' => 'spk/update/'.$data->id_sp));
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
                array(
                        'id' => 'judul',
                        'placeholder' => 'Judul',
                        'name' => 'judul_sp',
                        'help' => form_error('judul_sp'), 
                        'value' => set_value('judul_sp',@$data->judul_sp)
                ),
                array(
                        'id' => 'nomor_pengajuan',
                        'placeholder' => 'Nomor Pengajuan',
                        'name' => 'no_pengajuan_sp',
                        'help' => form_error('no_pengajuan_sp'),                   
                        'value' => set_value('no_pengajuan_sp',@$data->no_pengajuan_sp)
                ),
                array(
                        'id' => 'tanggal_pengajuan',
                        'placeholder' => 'Tanggal Pengajuan',
                        'class' => 'datepicker',
                        'name' => 'tanggal_pengajuan_sp',
                        'help' => form_error('tanggal_pengajuan_sp'),                   
                        'value' => set_value('tanggal_pengajuan_sp',@$data->tanggal_pengajuan_sp)
                ),
                array(
                        'id' => 'nomor_spk',
                        'placeholder' => 'Nomor SPK',
                        'name' => 'no_sp',
                        'help' => form_error('no_sp'),                   
                        'value' => set_value('no_sp',@$data->no_sp)
                ),
                array(
                        'id' => 'tanggal_spk',
                        'placeholder' => 'Tanggal SPK',
                        'class' => 'datepicker',
                        'name' => 'tanggal_sp',
                        'help' => form_error('tanggal_sp'),                   
                        'value' => set_value('tanggal_sp',@$data->tanggal_sp)
                ),
                array(
                        'id' => 'nomor_invoice',
                        'placeholder' => 'Nomor Invoice',
                        'name' => 'no_invoice',
                        'help' => form_error('no_invoice'),                   
                        'value' => set_value('no_invoice',@$data->no_invoice)
                ),
                array(
                        'id' => 'tanggal_invoice',
                        'placeholder' => 'Tanggal SPK',
                        'class' => 'datepicker',
                        'name' => 'tanggal_invoice',
                        'help' => form_error('tanggal_invoice'),                   
                        'value' => set_value('tanggal_invoice',@$data->tanggal_invoice)
                ),
        		array(
                        'id' => 'Lokasi Logistik',
                        'type' => 'dropdown',
                        'name'	=> 'id_k_logistik',	
                        'options' => $kantor_option,
                        'value' => set_value('id_k_logistik',@$data->id_k_logistik)
                ),
                array(
                        'id' => 'tanggal_payment_95%',
                        'placeholder' => 'Tanggal',
                        'class' => 'datepicker',
                        'name' => 'tanggal_payment_invoice',
                        'help' => form_error('tanggal_payment_invoice'),                   
                        'value' => set_value('tanggal_payment_invoice',@$data->tanggal_payment_invoice)
                ),
                array(
                        'id' => 'tanggal_retensi_5%',
                        'placeholder' => 'Tanggal',
                        'class' => 'datepicker',
                        'name' => 'tanggal_retensi_invoice',
                        'help' => form_error('tanggal_retensi_invoice'),                   
                        'value' => set_value('tanggal_retensi_invoice',@$data->tanggal_retensi_invoice)
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
	function form2($id="")
	{
		$form = $this->form_builder->open_form(array('action' => 'spk/insert_relasi/'.$id));
		$defaults_object_or_array_from_db = NULL;
		$pekerjaan = Mpekerjaan::select('kantor.id_k',
											'kantor.kode_k',
											'kantor.nama_k',
											'kantor.id_parent',
											'kantor.alamat_k',
											'kantor.status_k',
											'pekerjaan.id_p',
											't2.nama_k as nama_parent',
											'jk.nama_jk',
											'jk2.nama_jk as nama_jk2')
							->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
							->leftjoin('kantor as t2', 't2.id_k','=','kantor.id_parent')
							->leftjoin("jenis_kantor as jk","kantor.id_jk","=","jk.id_jk")
							->leftjoin("jenis_kantor as jk2","t2.id_jk","=","jk2.id_jk")
							->get();
		foreach ($pekerjaan as $k) {
			$pekerjaan_option[$k->id_p] = '#'.$k->id_p.' - '.$k->nama_k.' <<< '.$k->nama_jk2.' '.$k->nama_parent;
		}
		$form .= $this->form_builder->build_form_horizontal(
        array(
        		array(/* HIDDEN */
                        'id' => 'id_sp',
                        'type' => 'hidden',
                        'name'	=> 'id_sp',
                        'value' => set_value('id_sp',$id)
                ),
        		array(
                        'id' => 'pekerjaan',
                        'type' => 'dropdown',
                        'name'	=> 'id_p',	
                        'options' => $pekerjaan_option,
                        'help' => form_error('id_p'),   
                        'value' => set_value('id_p',@$data->id_p)
                ),
                array(
                        'id' => 'submit',
                        'type' => 'submit',
                        'label'	=> 'Insert'
                )
        ), $defaults_object_or_array_from_db);
		$form .= $this->form_builder->close_form();

		return $form;
	}
}
