<?php

class form_santri_model extends CI_Model{
    public $table = 'biodata_santri';

   

    public function update($data, $id)
	{
		return $this->db->update($this->table, $data, array('nis' => $id));
	}
   

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
