<?php

class Pengajian_model extends CI_Model{
    public $table = 'pengajian';

	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function update($data, $id)
	{
		return $this->db->update($this->table, $data, array('id_ngaji' => $id));
	}

	public function delete($id)
	{   
        return $this->db->delete($this->table, array('id_ngaji' => $id));
	}
    public function tampil_data($id_waktu)
    {
       $sql='SELECT p.id_ngaji,d.nama_kyai,k.nama_kitab,h.nama_hari,w.waktu_p,d.foto FROM pengajian p INNER JOIN hari h ON h.id_hari=p.id_hari INNER JOIN kitab k ON k.id_kitab=p.id_kitab INNER JOIN dewan_kyai d ON d.id_kyai=p.id_kyai INNER JOIN waktu w ON w.id_w=p.id_w WHERE p.id_w = IFNULL(?,p.id_w)';
       return $this->db->query($sql, array($id_waktu));
    }

    public function get_hari(){
        $this->db->select('*');
        $this->db->from('hari');
        return $this->db->get()->result();
    }

    public function get_kitab(){
        $this->db->select('*');
        $this->db->from('kitab');
        return $this->db->get()->result();
    }

    public function get_dewan_kyai(){
        $this->db->select('*');
        $this->db->from('dewan_kyai');
        return $this->db->get()->result();
    }

    public function get_waktu(){
        $this->db->select('*');
        $this->db->from('waktu');
        return $this->db->get()->result();
    }
    public function get_kyai(){
        $this->db->select('*');
        $this->db->from('dewan_kyai');
        return $this->db->get()->result();
    }
    public function get_by_id($id)
	{
        $this->db->select('p.id_ngaji,p.id_hari,p.id_kitab,p.id_kyai,p.id_w,h.nama_hari,k.nama_kitab,d.nama_kyai,w.waktu_p');
        $this->db->from('pengajian p');
        $this->db->join('hari h', 'h.id_hari=p.id_hari');
        $this->db->join('kitab k', 'k.id_kitab=p.id_kitab');
        $this->db->join('dewan_kyai d', 'd.id_kyai=p.id_kyai');
        $this->db->join('waktu w', 'w.id_w=p.id_w');
		$query = $this->db->get_where($this->table, array('p.id_ngaji' => $id));
		$data['object'] = $query->row();
		$data['array'] = $query->row_array();
		$data['count'] = $query->num_rows();
		return $data;
	}
}