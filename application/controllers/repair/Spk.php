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

        $this->load->model(array('mrepairspk','mkantor','mrepairrelasispk','mrepairpekerjaan','mrepairdetail','mrepairsubkon','mrepairharga'));

        
        if ($this->session->userdata('isLogin')==FALSE) {
			redirect('login');
		}
    }

	public function index()
	{		
		$data = array(
			'title'		=> 'SPK',
			'msg'		=> $this->session->flashdata('msg'),
			'table'		=> Mrepairspk::get(),
		);
		return view('repair.spk.index',$data);
	}

	public function create()
	{
		$data = array(
			'title'		=> 'Tambah SPK',
			'msg'		=> '',
			'form'		=> $this->form('insert'),
			'detail'	=> false,
		);

		return view('repair.spk.form',$data);
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

			return view('repair.spk.form',$data);
        }
        else
        {
        	$request = $this->input->post();
        	echo "<pre>";
        	var_dump($request);
        	echo "</pre>";
        	// exit();
        	unset($request['submit']);
			$db = new Mrepairspk;
	        foreach ($request as $key => $value)
            {
                if ($value!="") {
                    $db->$key = $value;
                }
            }
	        $db->save();

        	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil dimasukkan!!!</div>');

            redirect('repair/spk/edit/'.$db->id_repair_spk);
        }
    }

	public function edit($id="")
	{
		$data = array(
			'title'		=> 'Edit SPK',
			'msg'		=> '',
			'msg_r'		=> '',
			'detail'	=> true,
			'form'		=> $this->form('update',Mrepairspk::find($id)),
			'form2'		=> $this->form2($id),
			'relasi'	=> Mrepairrelasispk::leftjoin('repair_pekerjaan', 'repair_pekerjaan.id_repair_pekerjaan','=','repair_relasi_spk.id_repair_pekerjaan')
							->leftjoin('kantor', 'kantor.id_k','=','repair_pekerjaan.id_k')
							->where('id_repair_spk',$id)
							->get()
		);

		return view('repair.spk.form',$data);
	}

	public function spk($id="")
	{
		$filename = "SPKREPAIR".date('dmY').".doc";
	    header("Content-Type: application/vnd.ms-word");
	    header("Expires: 0");
	    header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
	    header("Content-disposition: attachment; filename=".$filename);

        $data = array(
			'title'		=> 'SPK Repair- '.$id,
			'spk'		=> Mrepairspk::find($id),
			'relasi'	=> Mrepairrelasispk::leftjoin('repair_pekerjaan', 'repair_pekerjaan.id_repair_pekerjaan','=','repair_relasi_spk.id_repair_pekerjaan')
							->leftjoin('kantor', 'kantor.id_k','=','repair_pekerjaan.id_k')
							->where('id_repair_spk',$id)
							->get()
		);
        $this->load->view('repair/spk/spk',$data);

    }

	public function bapp($id="")
	{
		$filename = "BAPPREPAIR".date('dmY').".doc";
	    header("Content-Type: application/vnd.ms-word");
	    header("Expires: 0");
	    header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
	    header("Content-disposition: attachment; filename=".$filename);

        $data = array(
			'title'		=> 'BAPP REPAIR - '.$id,
			'spk'		=> Mrepairspk::select('kantor.id_k',
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
											'repair_spk.*')
							->leftjoin('kantor', 'kantor.id_k','=','repair_spk.id_k')
							->leftjoin('kantor as t2', 't2.id_k','=','kantor.id_parent')
							->leftjoin('kantor as t3', 't3.id_k','=','repair_spk.id_k_logistik')
							->leftjoin("jenis_kantor as jk","kantor.id_jk","=","jk.id_jk")
							->leftjoin("jenis_kantor as jk2","t2.id_jk","=","jk2.id_jk")
							->leftjoin("jenis_kantor as jk3","t3.id_jk","=","jk3.id_jk")
							->find($id),
			'relasi'	=> Mrepairrelasispk::leftjoin('repair_pekerjaan', 'repair_pekerjaan.id_repair_pekerjaan','=','repair_relasi_spk.id_repair_pekerjaan')
							->leftjoin('kantor', 'kantor.id_k','=','repair_pekerjaan.id_k')
							->where('id_repair_spk',$id)
							->get()
		);
        $this->load->view('repair/spk/bapp',$data);
    }

	public function invoice($id="")
	{
		$filename = "INVOICEREPAIR".date('dmY').".doc";
	    header("Content-Type: application/vnd.ms-word");
	    header("Expires: 0");
	    header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
	    header("Content-disposition: attachment; filename=".$filename);

	 //    $request = $this->input->post();
		// $db = Mrepairspk::find($id);
  //       $db->no_invoice = $id ." - ".substr(date('Y'), -2).date('md').$id;
  //       $db->tanggal_invoice = date('Y-m-d');
  //       $db->save();


        $data = array(
			'title'		=> 'BAPP REPAIR - '.$id,
			'spk'		=> Mrepairspk::select('kantor.id_k',
											'kantor.kode_k',
											'kantor.nama_k',
											'kantor.id_parent',
											'kantor.alamat_k',
											'kantor.status_k',
											't2.nama_k as nama_parent',
											'jk.nama_jk',
											'jk2.nama_jk as nama_jk2',
											'repair_spk.*')
							->leftjoin('kantor', 'kantor.id_k','=','repair_spk.id_k')
							->leftjoin('kantor as t2', 't2.id_k','=','kantor.id_parent')
							->leftjoin("jenis_kantor as jk","kantor.id_jk","=","jk.id_jk")
							->leftjoin("jenis_kantor as jk2","t2.id_jk","=","jk2.id_jk")
							->find($id),
			'relasi'	=> Mrepairrelasispk::leftjoin('repair_pekerjaan', 'repair_pekerjaan.id_repair_pekerjaan','=','repair_relasi_spk.id_repair_pekerjaan')
							->leftjoin('kantor', 'kantor.id_k','=','repair_pekerjaan.id_k')
							->where('id_repair_spk',$id)
							->get()
		);
        $this->load->view('repair/spk/invoice',$data);
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
				'form'		=> $this->form('update',Mrepairspk::find($id)),
				'form2'		=> $this->form2($id),
				'relasi'	=> Mrsp::leftjoin('pekerjaan', 'pekerjaan.id_p','=','r_repair_spk.id_p')
								->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
								->where('id_repair_spk',$id)
								->get()
			);


			return view('repair.spk.form',$data);
        }
        else
        {
        	$request = $this->input->post();
        	unset($request['submit']);
			$db = Mrepairspk::find($id);
	        foreach ($request as $key => $value)
            {
                if ($value!="") {
                    $db->$key = $value;
                }
            }
	        $db->save();

	    	$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Data sudah berhasil diubah!!!</div>');

	        redirect('repair/spk');
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
				'form'		=> $this->form('update',Mrepairspk::find($id)),
				'form2'		=> $this->form2($id),
				'relasi'	=> Mrepairrelasispk::leftjoin('repair_pekerjaan', 'repair_pekerjaan.id_repair_pekerjaan','=','repair_relasi_spk.id_repair_pekerjaan')
								->leftjoin('kantor', 'kantor.id_k','=','repair_pekerjaan.id_k')
								->where('id_repair_spk',$id)
								->get()
			);

			return view('repair.spk.form',$data);
        }
        else
        {
        	$request = $this->input->post();
			$db = new Mrepairrelasispk;
	        $db->id_repair_spk = $request['id_repair_spk'];
	        $db->id_repair_pekerjaan = $request['id_repair_pekerjaan'];
	        $db->save();

	    	$this->session->set_flashdata('msg_r','<div class="alert alert-success text-center">Data sudah berhasil ditambah!!!</div>');

	        redirect('repair/spk/edit/'.$id);
        }		
	}

	public function delete($id="")
	{		
		$db = Mrepairspk::find($id);
		$db->delete();
		$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
		redirect('repair/spk');
	}

	public function delete_relasi($id="")
	{		
		$db = Mrepairrelasispk::find($this->input->get('id_repair_relasi_spk'));
		$db->delete();
		$this->session->set_flashdata('msg_r','<div class="alert alert-danger text-center">Data berhasil di hapus!!!</div>');
		redirect('repair/spk/edit/'.$id);
	}

	function validation()
	{
		
		$config = array(
		        array(
		                'field' => 'judul_repair_spk',
		                'label' => 'Judul',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Anda harus mengisi kolom %s.',
		                ),
		        ),
		        array(
		                'field' => 'no_pengajuan_repair_spk',
		                'label' => 'Nomor Pengajuan',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Anda harus mengisi kolom %s.',
		                ),
		        ),
		        array(
		                'field' => 'tanggal_pengajuan_repair_spk',
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
		                'field' => 'id_repair_pekerjaan',
		                'label' => 'Pekerjaan',
		                'rules' => 'required|is_unique[repair_relasi_spk.id_repair_pekerjaan]',
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
			$form = $this->form_builder->open_form(array('action' => 'repair/spk/insert'));
		}elseif ($type=="update") {
			$form = $this->form_builder->open_form(array('action' => 'repair/spk/update/'.$data->id_repair_spk));
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
                        'name' => 'judul_repair_spk',
                        'help' => form_error('judul_repair_spk'), 
                        'value' => set_value('judul_repair_spk',@$data->judul_repair_spk)
                ),
                array(
                        'id' => 'nomor_pengajuan',
                        'placeholder' => 'Nomor Pengajuan',
                        'name' => 'no_pengajuan_repair_spk',
                        'help' => form_error('no_pengajuan_repair_spk'),                   
                        'value' => set_value('no_pengajuan_repair_spk',@$data->no_pengajuan_repair_spk)
                ),
                array(
                        'id' => 'tanggal_pengajuan',
                        'placeholder' => 'Tanggal Pengajuan',
                        'class' => 'datepicker',
                        'name' => 'tanggal_pengajuan_repair_spk',
                        'help' => form_error('tanggal_pengajuan_repair_spk'),                   
                        'value' => set_value('tanggal_pengajuan_repair_spk',@$data->tanggal_pengajuan_repair_spk)
                ),
                array(
                        'id' => 'nomor_spk',
                        'placeholder' => 'Nomor SPK',
                        'name' => 'no_repair_spk',
                        'help' => form_error('no_repair_spk'),                   
                        'value' => set_value('no_repair_spk',@$data->no_repair_spk)
                ),
                array(
                        'id' => 'tanggal_spk',
                        'placeholder' => 'Tanggal SPK',
                        'class' => 'datepicker',
                        'name' => 'tanggal_repair_spk',
                        'help' => form_error('tanggal_repair_spk'),                   
                        'value' => set_value('tanggal_repair_spk',@$data->tanggal_repair_spk)
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
                        'id' => 'tanggal_payment_invoice',
                        'placeholder' => 'Tanggal Payment Invoice',
                        'class' => 'datepicker',
                        'name' => 'tanggal_payment_invoice_repair_spk',
                        'help' => form_error('tanggal_payment_invoice_repair_spk'),                   
                        'value' => set_value('tanggal_payment_invoice_repair_spk',@$data->tanggal_payment_invoice_repair_spk)
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
		$form = $this->form_builder->open_form(array('action' => 'repair/spk/insert_relasi/'.$id));
		$defaults_object_or_array_from_db = NULL;
		$pekerjaan = Mrepairpekerjaan::select('kantor.id_k',
											'kantor.kode_k',
											'kantor.nama_k',
											'kantor.id_parent',
											'kantor.alamat_k',
											'kantor.status_k',
											'repair_pekerjaan.id_repair_pekerjaan',
											't2.nama_k as nama_parent',
											'jk.nama_jk',
											'jk2.nama_jk as nama_jk2')
							->leftjoin('kantor', 'kantor.id_k','=','repair_pekerjaan.id_k')
							->leftjoin('kantor as t2', 't2.id_k','=','kantor.id_parent')
							->leftjoin("jenis_kantor as jk","kantor.id_jk","=","jk.id_jk")
							->leftjoin("jenis_kantor as jk2","t2.id_jk","=","jk2.id_jk")
							->get();
		foreach ($pekerjaan as $k) {
			$pekerjaan_option[$k->id_repair_pekerjaan] = '#'.$k->id_repair_pekerjaan.' - '.$k->nama_k.' <<< '.$k->nama_jk2.' '.$k->nama_parent;
		}
		$form .= $this->form_builder->build_form_horizontal(
        array(
        		array(/* HIDDEN */
                        'id' => 'id_repair_spk',
                        'type' => 'hidden',
                        'name'	=> 'id_repair_spk',
                        'value' => set_value('id_repair_spk',$id)
                ),
        		array(
                        'id' => 'pekerjaan',
                        'type' => 'dropdown',
                        'name'	=> 'id_repair_pekerjaan',	
                        'options' => $pekerjaan_option,
                        'help' => form_error('id_repair_pekerjaan'),   
                        'value' => set_value('id_repair_pekerjaan',@$data->id_repair_pekerjaan)
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
