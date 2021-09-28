<?php

class dewan_kyai_model extends CI_Model{
    public $table = 'dewan_kyai';

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($data, $id)
	{
		return $this->db->update($this->table, $data, array('id_kyai' => $id));
	}

    public function delete($id)
    {
        $get_kyai = $this->db->get_where('dewan_kyai',['id_kyai' => $id])->row();
        if ($get_kyai){
           if ($get_kyai->foto == NULL) {
		      $query = $this->db->delete('dewan_kyai',['id_kyai'=>$id]);
		   }
           else {
			  $query = $this->db->delete('dewan_kyai',['id_kyai'=>$id]);
			  if($query){
				return unlink("assets/uploads/foto_kyai/".$get_kyai->foto);
			}
		  }
        }
    }

    public function get_all(){
        $this->db->select('*');
        $this->db->from('dewan_kyai');
        return $this->db->get();
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where($this->table, array('id_kyai' => $id));
        $data['object'] = $query->row();
        $data['array'] = $query->row_array();
        $data['count'] = $query->num_rows();
        return $data;
    }
}
?>