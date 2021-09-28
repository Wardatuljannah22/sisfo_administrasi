<?php

class Majelis_santri_model extends CI_Model{
    public $table = 'majelis_santri';

	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function update($data, $id)
	{
		return $this->db->update($this->table, $data, array('id' => $id));
	}

    public function delete($id)
	{
		return $this->db->delete($this->table, array('id' => $id));
	}

    public function tampil_data($j_kelamin)
    {
        $sql='select majelis_santri.*,majelis_santri.id as id2,jabatan_ms.nama_jabatan,biodata_santri.jenis_kelamin,biodata_santri.nama_santri,biodata_santri.foto as foto2, univ.nama_univ, nama_angkatan.nama_angk from majelis_santri INNER JOIN jabatan_ms ON jabatan_ms.id_jabatan=majelis_santri.id_jabatan INNER JOIN biodata_santri ON biodata_santri.nis=majelis_santri.nis INNER JOIN univ ON univ.id_univ=biodata_santri.id_univ INNER JOIN nama_angkatan 
        ON nama_angkatan.id_angk=biodata_santri.id_angk WHERE biodata_santri.jenis_kelamin = IFNULL(?,biodata_santri.jenis_kelamin)';
        return $this->db->query($sql, array($j_kelamin));
    }

    // public function tampil_data()
    // {
    //     $this->db->select('data_kamar.*, nama_kamar.nama_ka, nama_angkatan.nama_angk, status_santri.nama_status');
    //     $this->db->from('data_kamar');
    //     $this->db->join('nama_kamar', 'nama_kamar.id_ka=data_kamar.id_ka');
    //     $this->db->join('nama_angkatan', 'nama_angkatan.id_angk=data_kamar.id_angk');
    //     $this->db->join('status_santri', 'status_santri.id_status=data_kamar.id_status');
    //     return $this->db->get();
    // }

    public function get_jabatan(){
        $this->db->select('*');
        $this->db->from('jabatan_ms');
        return $this->db->get()->result();
    }
    public function get_biodata(){
        $this->db->select('*');
        $this->db->from('biodata_santri');
        return $this->db->get()->result();
    }

    public function get_univ(){
        $this->db->select('*');
        $this->db->from('univ');
        return $this->db->get()->result();
    }
    public function get_angkatan(){
        $this->db->select('*');
        $this->db->from('nama_angkatan');
        return $this->db->get()->result();
    }
    public function get_by_id($id)
	{
        $this->db->select('m.id,m.id_jabatan,b.jenis_kelamin,u.nama_univ,a.nama_angk,m.nis');
        $this->db->from('majelis_santri m');
        $this->db->join('biodata_santri b','b.nis=m.nis');
        $this->db->join('jabatan_ms j', 'j.id_jabatan=j.id_jabatan');
        $this->db->join('univ u', 'u.id_univ=b.id_univ');
        $this->db->join('nama_angkatan a', 'a.id_angk=a.id_angk');
		$query = $this->db->get_where($this->table, array('m.id' => $id));
		$data['object'] = $query->row();
		$data['array'] = $query->row_array();
		$data['count'] = $query->num_rows();
		return $data;
	}
    public function get_biodata_santri($nis)
	{
        $this->db->select('b.nis,b.nama_santri,b.tempat_lahir,b.tgl_lahir,b.jenis_kelamin,b.alamat,b.jurusan,b.id_univ,b.id_angk,b.id_status,b.foto,u.nama_univ,n.nama_angk,s.nama_status,n.nama_angk');
        $this->db->from('biodata_santri b');
        $this->db->join('univ u', 'u.id_univ=b.id_univ');
        $this->db->join('nama_angkatan n', 'n.id_angk=b.id_angk');
        $this->db->join('status_santri s', 's.id_status=b.id_status');
		$query = $this->db->get_where($this->table, array('b.nis' => $nis));
		$data['object'] = $query->row();
		$data['array'] = $query->row_array();
		$data['count'] = $query->num_rows();
		return $data;
	}
   


  
}







