<?php

class Madin_model extends CI_Model{
    public $table = 'madin';

	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function update($data, $id)
	{
		return $this->db->update($this->table, $data, array('id_ma' => $id));
	}

	public function delete($id)
	{   
       return $this->db->delete('madin',['id_ma'=>$id]);
	}
    public function tampil_data($id_hari)
    {
       $sql='SELECT m.id_ma,m.nama_ust,k.nama_kelas,h.nama_hari,ma.nama_mapel FROM madin m INNER JOIN hari h ON m.id_hari=h.id_hari INNER JOIN mapel ma ON ma.id_mapel=m.id_mapel INNER JOIN kelas k ON k.id_kelas=m.id_kelas WHERE m.id_hari = IFNULL(?,m.id_hari)';
       return $this->db->query($sql, array($id_hari));
    }

    public function get_kelas(){
        $this->db->select('*');
        $this->db->from('kelas');
        return $this->db->get()->result();
    }

    public function get_mapel(){
        $this->db->select('*');
        $this->db->from('mapel');
        return $this->db->get()->result();
    }

    public function get_hari(){
        $this->db->select('*');
        $this->db->from('hari');
        return $this->db->get()->result();
    }
    public function get_by_id($id)
	{
        $this->db->select('m.id_ma,m.nama_ust,m.id_kelas,m.id_mapel,m.id_hari,k.nama_kelas,l.nama_mapel,h.nama_hari');
        $this->db->from('madin m');
        $this->db->join('kelas k', 'm.id_kelas=m.id_kelas');
        $this->db->join('mapel l', 'l.id_mapel=l.id_mapel');
        $this->db->join('hari h', 'h.id_hari=h.id_hari');
		$query = $this->db->get_where($this->table, array('m.id_ma' => $id));
		$data['object'] = $query->row();
		$data['array'] = $query->row_array();
		$data['count'] = $query->num_rows();
		return $data;
	}
}