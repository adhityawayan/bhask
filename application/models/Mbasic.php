<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mbasic extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    function getPekerjaan($limit, $start, $spk)
    {
    	$this->db->select('pekerjaan.id_p,
							kantor.kode_k,
							kantor.id_parent,
							kantor.id_jk,
							kantor.nama_k,
							zona.nama_z,
							kantor.alamat_k,
							jenis_kantor.nama_jk');

		$this->db->join('kantor', 'kantor.id_k = pekerjaan.id_k', 'left');
		$this->db->join("jenis_kantor","jenis_kantor.id_jk = kantor.id_jk", 'left');
		$this->db->join("zona","zona.id_z = kantor.id_z", 'left');

        $this->db->join("r_sp","pekerjaan.id_p = r_sp.id_p");
        $this->db->join("spk","spk.id_sp = r_sp.id_sp");

        if ($spk!="") {
            $this->db->like('spk.no_sp',$spk);
        }
		$this->db->limit($limit, $start);
    	$query = $this->db->get('pekerjaan');
        return $query->result();
    }

    function countPekerjaan($spk)
    {
        $this->db->join("r_sp","pekerjaan.id_p = r_sp.id_p");
        $this->db->join("spk","spk.id_sp = r_sp.id_sp");

        if ($spk!="") {
            $this->db->like('spk.no_sp',$spk);
        }
        
        $query = $this->db->get('pekerjaan');
        return $query->num_rows();
    }

    function getRepairPekerjaan($limit, $start, $spk)
    {
        $this->db->select('repair_pekerjaan.id_repair_pekerjaan,
                            kantor.kode_k,
                            kantor.id_parent,
                            kantor.id_jk,
                            kantor.nama_k,
                            zona.nama_z,
                            kantor.alamat_k,
                            jenis_kantor.nama_jk');

        $this->db->join('kantor', 'kantor.id_k = repair_pekerjaan.id_k', 'left');
        $this->db->join("jenis_kantor","jenis_kantor.id_jk = kantor.id_jk", 'left');
        $this->db->join("zona","zona.id_z = kantor.id_z", 'left');


        $this->db->join("repair_relasi_spk","repair_pekerjaan.id_repair_pekerjaan = repair_relasi_spk.id_repair_pekerjaan");
        $this->db->join("repair_spk","repair_spk.id_repair_spk = repair_relasi_spk.id_repair_spk");

        if ($spk!="") {
            $this->db->like('repair_spk.no_repair_spk',$spk);
        }

        $this->db->limit($limit, $start);
        $query = $this->db->get('repair_pekerjaan');
        return $query->result();
    }

    function countRepairPekerjaan($spk)
    {   

        $this->db->join("repair_relasi_spk","repair_pekerjaan.id_repair_pekerjaan = repair_relasi_spk.id_repair_pekerjaan");
        $this->db->join("repair_spk","repair_spk.id_repair_spk = repair_relasi_spk.id_repair_spk");

        if ($spk!="") {
            $this->db->like('repair_spk.no_repair_spk',$spk);
        }


        $query = $this->db->get('repair_pekerjaan');

        return $query->num_rows();
    }

}