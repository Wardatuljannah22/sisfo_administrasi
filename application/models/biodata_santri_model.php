<?php

class biodata_santri_model extends CI_Model{
    public $table = 'biodata_santri';

	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function update($data, $id)
	{
		return $this->db->update($this->table, $data, array('nis' => $id));
	}

	public function delete($id)
	{
        $get_santri = $this->db->get_where('biodata_santri',['nis' => $id])->row();
        if ($get_santri){
           if ($get_santri->foto == NULL) {
		      $query = $this->db->delete('biodata_santri',['nis'=>$id]);
		   }
           else {
			  $query = $this->db->delete('biodata_santri',['nis'=>$id]);
			  if($query){
				return unlink("assets/uploads/foto_santri/".$get_santri->foto);
			}
		  }
        }
	}
    public function tampil_data($j_kelamin)
    {
        $sql='select biodata_santri.*,univ.nama_univ, nama_angkatan.nama_angk, status_santri.nama_status from biodata_santri INNER JOIN univ ON univ.id_univ=biodata_santri.id_univ INNER JOIN nama_angkatan ON nama_angkatan.id_angk=biodata_santri.id_angk INNER JOIN status_santri 
        ON status_santri.id_status=biodata_santri.id_status WHERE biodata_santri.jenis_kelamin = IFNULL(?,biodata_santri.jenis_kelamin)';
        return $this->db->query($sql, array($j_kelamin));
    }
    public function tampil_data_satu($email)
    {
        $sql='select biodata_santri.*,univ.nama_univ, nama_angkatan.nama_angk, status_santri.nama_status from biodata_santri INNER JOIN univ ON univ.id_univ=biodata_santri.id_univ INNER JOIN nama_angkatan ON nama_angkatan.id_angk=biodata_santri.id_angk INNER JOIN status_santri 
        ON status_santri.id_status=biodata_santri.id_status INNER JOIN user u ON u.nis=biodata_santri.nis where u.email=?';
        return $this->db->query($sql,array($email));
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

    public function get_status(){
        $this->db->select('*');
        $this->db->from('status_santri');
        return $this->db->get()->result();
    }
    public function get_by_id($id)
	{
        $this->db->select('b.nis,b.nama_santri,b.tempat_lahir,b.tgl_lahir,b.jenis_kelamin,b.alamat,b.jurusan,b.id_univ,b.id_angk,b.id_status,b.foto,u.nama_univ,n.nama_angk,s.nama_status');
        $this->db->from('biodata_santri b');
        $this->db->join('univ u', 'u.id_univ=b.id_univ');
        $this->db->join('nama_angkatan n', 'n.id_angk=b.id_angk');
        $this->db->join('status_santri s', 's.id_status=b.id_status');
		$query = $this->db->get_where($this->table, array('b.nis' => $id));
		$data['object'] = $query->row();
		$data['array'] = $query->row_array();
		$data['count'] = $query->num_rows();
		return $data;
	}

   


  
    // public function get_status(){
    //     return $this->db->get('status_santri');
    // }
    // public function input_data($data){}

    // public function detail_data($id = NULL){
	// 	$query = $this->db->get_where('biodata_Santri', array('id' => $id))->row();
	// 	return $query;
	// }
}