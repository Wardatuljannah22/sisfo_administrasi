<?php

class nama_angkatan_model extends CI_Model{
    public $table = 'nama_angkatan';

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($data, $id)
	{
		return $this->db->update($this->table, $data, array('id_angk' => $id));
	}

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id_angk' =>$id));
    }

    public function get_all(){
        $this->db->select('*');
        $this->db->from('nama_angkatan');
        return $this->db->get();
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where($this->table, array('id_angk' => $id));
        $data['object'] = $query->row();
        $data['array'] = $query->row_array();
        $data['count'] = $query->num_rows();
        return $data;
    }
}
?>