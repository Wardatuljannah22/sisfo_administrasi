<?php

class nama_kamar_model extends CI_Model{
    public $table = 'nama_kamar';

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($data, $id)
	{
		return $this->db->update($this->table, $data, array('id_ka' => $id));
	}

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id_ka' =>$id));
    }

    // public function tampil_data($j_kelamin)
    // {
    //     $sql='select nama_kamar.*, WHERE nama_kamar.jenis_kelamin = IFNULL(?,nama_kamar.jenis_kelamin)';
    //     return $this->db->query($sql, array($j_kelamin));
    // }    

    public function get_all(){
        $this->db->select('*');
        $this->db->from('nama_kamar');
        return $this->db->get();
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where($this->table, array('id_ka' => $id));
        $data['object'] = $query->row();
        $data['array'] = $query->row_array();
        $data['count'] = $query->num_rows();
        return $data;
    }
}
?>