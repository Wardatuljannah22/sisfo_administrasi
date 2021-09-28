<?php

class jumlah_santri_model extends CI_Model{
    public $table = 'jumlah_santri';

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($data, $id)
	{
		return $this->db->update($this->table, $data, array('id_jumlah' => $id));
	}

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id_jumlah' =>$id));
    }

    public function get_all(){
        $this->db->select('*');
        $this->db->from('jumlah_santri');
        return $this->db->get();
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where($this->table, array('id_jumlah' => $id));
        $data['object'] = $query->row();
        $data['array'] = $query->row_array();
        $data['count'] = $query->num_rows();
        return $data;
    }
}
?>