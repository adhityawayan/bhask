<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	/**
	 * Developer Rizky Aidil Adha
	 * Phone/SMS/WA 08115511413
	 * Web http://aidil.web.id
	 */


	public function __construct()
    {
        parent::__construct();

        $this->load->model(array('mkantor','mrsp','mjeniskantor','mharga_bahan','msignage','msignage_atm','mpylon','matm','mzona','mpekerjaan','mbasic'));
        
        if ($this->session->userdata('isLogin')==FALSE) {
			redirect('login');
		}
    }

	public function index()
	{		

        $spk = $this->input->get('spk');
		$this->load->library('pagination');
		//pagination settings
        $config['base_url'] = site_url('laporan/index');
        $config['total_rows'] = $this->mbasic->countPekerjaan($spk);
        $config['per_page'] = "10";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data = array(
			'title'		=> 'Laporan',
			'msg'		=> $this->session->flashdata('msg'),
			'pekerjaan' => $this->mbasic->getPekerjaan($config["per_page"], $data['page'],$spk),
			'pagination' => $this->pagination->create_links()
		);
		return view('laporan.index',$data);
	}

	public function excel()
	{	
		$filename = "LAPORAN".date('dmY').".xls";
	    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	    header("Expires: 0");
	    header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
	    header("Content-disposition: attachment; filename=".$filename);

		$data = array(
			'pekerjaan' => Mpekerjaan::select('pekerjaan.id_p',
											'kantor.kode_k',
											'kantor.id_parent',
											'kantor.id_jk',
											'kantor.nama_k',
											'zona.nama_z',
											'kantor.alamat_k',
											'jenis_kantor.nama_jk')
							->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
							->leftjoin("jenis_kantor","jenis_kantor.id_jk","=","kantor.id_jk")
							->leftjoin("zona","zona.id_z","=","kantor.id_z")
							// ->leftjoin('r_sp', 'r_sp.id_p','=','pekerjaan.id_p')
							// ->leftjoin('spk', 'spk.id_sp','=','r_sp.id_sp')
							->get(),
				
		);

		$this->load->view('laporan/excel',$data);
	}

    public function excellaporanbri()
    {   
        $filename = "LAPORAN".date('dmY').".xls";
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Expires: 0");
        header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
        header("Content-disposition: attachment; filename=".$filename);

        $data = array(
            'pekerjaan' => Mpekerjaan::select('pekerjaan.id_p',
                                            'kantor.kode_k',
                                            'kantor.id_parent',
                                            'kantor.id_jk',
                                            'kantor.nama_k',
                                            'zona.nama_z',
                                            'kantor.alamat_k',
                                            'jenis_kantor.nama_jk')
                            ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                            ->leftjoin("jenis_kantor","jenis_kantor.id_jk","=","kantor.id_jk")
                            ->leftjoin("zona","zona.id_z","=","kantor.id_z")
                            // ->leftjoin('r_sp', 'r_sp.id_p','=','pekerjaan.id_p')
                            // ->leftjoin('spk', 'spk.id_sp','=','r_sp.id_sp')
                            ->get(),
                
        );

        $this->load->view('laporan/excellaporanbri',$data);
    }

     public function excellaporantukang()
    {   
        $filename = "LAPORAN".date('dmY').".xls";
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Expires: 0");
        header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
        header("Content-disposition: attachment; filename=".$filename);

        $data = array(
            'pekerjaan' => Mpekerjaan::select('pekerjaan.id_p',
                                            'kantor.kode_k',
                                            'kantor.id_parent',
                                            'kantor.id_jk',
                                            'kantor.nama_k',
                                            'zona.nama_z',
                                            'kantor.alamat_k',
                                            'jenis_kantor.nama_jk')
                            ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                            ->leftjoin("jenis_kantor","jenis_kantor.id_jk","=","kantor.id_jk")
                            ->leftjoin("zona","zona.id_z","=","kantor.id_z")
                            // ->leftjoin('r_sp', 'r_sp.id_p','=','pekerjaan.id_p')
                            // ->leftjoin('spk', 'spk.id_sp','=','r_sp.id_sp')
                            ->get(),
                
        );

        $this->load->view('laporan/excellaporantukang',$data);
    }

    public function excellaporankanwil()
    {   
        $filename = "LAPORAN".date('dmY').".xls";
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Expires: 0");
        header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
        header("Content-disposition: attachment; filename=".$filename);

        $data = array(
            'pekerjaan' => Mpekerjaan::select('pekerjaan.id_p',
                                            'kantor.kode_k',
                                            'kantor.id_parent',
                                            'kantor.id_jk',
                                            'kantor.nama_k',
                                            'zona.nama_z',
                                            'kantor.alamat_k',
                                            'jenis_kantor.nama_jk')
                            ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                            ->leftjoin("jenis_kantor","jenis_kantor.id_jk","=","kantor.id_jk")
                            ->leftjoin("zona","zona.id_z","=","kantor.id_z")
                            // ->leftjoin('r_sp', 'r_sp.id_p','=','pekerjaan.id_p')
                            // ->leftjoin('spk', 'spk.id_sp','=','r_sp.id_sp')
                            ->get(),
                
        );

        $this->load->view('laporan/excellaporankanwil',$data);
    }

	public function laporantukang()
	{
		$spk = $this->input->get('spk');
		$this->load->library('pagination');
		//pagination settings
        $config['base_url'] = site_url('laporan/laporantukang');
        $config['total_rows'] = $this->mbasic->countPekerjaan($spk);
        $config['per_page'] = "10";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data = array(
			'title'		=> 'Laporan',
			'msg'		=> $this->session->flashdata('msg'),
			'pekerjaan' => $this->mbasic->getPekerjaan($config["per_page"], $data['page'],$spk),
			'pagination' => $this->pagination->create_links()
		);
		return view('laporan.laporantukang',$data);
	}

    public function laporanbri()
    {
        $spk = $this->input->get('spk');
        $this->load->library('pagination');
        //pagination settings
        $config['base_url'] = site_url('laporan/laporanbri');
        $config['total_rows'] = $this->mbasic->countPekerjaan($spk);
        $config['per_page'] = "10";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data = array(
            'title'     => 'Laporan',
            'msg'       => $this->session->flashdata('msg'),
            'pekerjaan' => $this->mbasic->getPekerjaan($config["per_page"], $data['page'],$spk),
            'pagination' => $this->pagination->create_links()
        );
        return view('laporan.laporanbri',$data);
    }

    public function laporankanwil()
    {
        $spk = $this->input->get('spk');
        $this->load->library('pagination');
        //pagination settings
        $config['base_url'] = site_url('laporan/laporankanwil');
        $config['total_rows'] = $this->mbasic->countPekerjaan($spk);
        $config['per_page'] = "10";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data = array(
            'title'     => 'Laporan',
            'msg'       => $this->session->flashdata('msg'),
            'pekerjaan' => $this->mbasic->getPekerjaan($config["per_page"], $data['page'],$spk),
            'pagination' => $this->pagination->create_links()
        );
        return view('laporan.laporankanwil',$data);
    }
}
