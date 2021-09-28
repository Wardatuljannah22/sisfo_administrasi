<?php

class Data_kamar_model extends CI_Model{
    public $table = 'data_kamar';

	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function update($data, $id)
	{
		return $this->db->update($this->table, $data, array('id_kamar' => $id));
	}

    public function delete($id)
	{
		return $this->db->delete($this->table, array('id_kamar' => $id));
	}

    public function tampil_data($j_kelamin)
    {
        $sql='select data_kamar.*,nama_kamar.nama_ka, nama_angkatan.nama_angk, status_santri.nama_status from data_kamar INNER JOIN nama_kamar ON nama_kamar.id_ka=data_kamar.id_ka INNER JOIN nama_angkatan ON nama_angkatan.id_angk=data_kamar.id_angk INNER JOIN status_santri 
        ON status_santri.id_status=data_kamar.id_status WHERE data_kamar.jenis_kelamin = IFNULL(?,data_kamar.jenis_kelamin)';
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

    public function get_kamar(){
        $this->db->select('*');
        $this->db->from('nama_kamar');
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
        $this->db->select('k.id_kamar,k.id_ka,k.nama_penghuni,k.jenis_kelamin,k.kuota_kamar,k.id_angk,k.id_status,a.nama_angk,s.nama_status,n.kuota_kamar as kuota2');
        $this->db->from('data_kamar k');
        $this->db->join('nama_kamar n', 'n.id_ka=n.id_ka');
        $this->db->join('nama_angkatan a', 'a.id_angk=a.id_angk');
        $this->db->join('status_santri s', 's.id_status=k.id_status');
		$query = $this->db->get_where($this->table, array('k.id_kamar' => $id));
		$data['object'] = $query->row();
		$data['array'] = $query->row_array();
		$data['count'] = $query->num_rows();
		return $data;
	}
    public function get_kuota($id_ka){
		$this->db->select('kuota_kamar');
        $query = $this->db->get_where('nama_kamar', array('id_ka' => $id_ka));
        $data['object'] = $query->row();
		$data['array'] = $query->row_array();
		$data['count'] = $query->num_rows();
		return $data;
	}


  
}






// <?php

// class Data_kamar_model extends CI_Model{
//     public function tampil_data()
//     {   
//         $this->db->select('data_kamar.*, nama_kamar.nama_ka, nama_angkatan.nama_angk');
//         $this->db->from('data_kamar');
//         $this->db->join('nama_kamar', 'nama_kamar.id_ka=data_kamar.id_ka');
//         $query = $this->db->get();
//         return $query->result();

//         // return $this->db->get('data_kamar');
//     }

//     public function get_kamar(){
//         $this->db->select('*');
//         $this->db->from('nama_kamar');
//         return $this->db->get()->result();
//     }

//     public function get_angkatan(){
//         $this->db->select('*');
//         $this->db->from('nama_angkatan');
//         return $this->db->get()->result();
//     }

    
//     // public function input_data($data){}
// }
