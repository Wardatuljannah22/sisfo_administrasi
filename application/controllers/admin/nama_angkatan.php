<?php

class nama_angkatan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('nama_angkatan_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        // Your own constructor code
    }

    public function index()
    {
        $email =  $this->session->userdata('email');
        $this->db->select('b.nama_santri,b.foto');
        $this->db->from('user u');
        $this->db->join('biodata_santri b','b.nis=u.nis','left');
        $this->db->where('u.email',$email);
        $user = $this->db->get();
        $data['biodata'] =$user;
        // $data['dewan_kyai'] = $this->dewan_kyai_model->tampil_data();
        // $this->load->view('template_admin/header');
        // $this->load->view('user/index');
        // $this->load->view('admin/nama_angkatan/view.php');
        // $this->load->view('template_admin/footer');
        // $this->load->view('admin/nama_angkatan/script.php');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role_check'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('admin/nama_angkatan/view.php');
        $this->load->view('templates/footer');
        $this->load->view('admin/nama_angkatan/script.php');
    }

    public function get_all()
    {
        $nama_angkatan = $this->nama_angkatan_model->get_all();
        $data['nama_angkatan'] = $nama_angkatan;
        $this->load->view('admin/nama_angkatan/data_nama_angkatan', $data);
    }

    // public function data()
    // {
    //     // nama table
    //     $table = 'dewan_kyai';
    //     // nama PK
    //     $primarykey = 'id_kyai';
    //     // list field yang mau ditampilkan 

    // }
    public function crud($mode)
    {
        if ($mode == 'insert') {
            if ($this->input->is_ajax_request()) {
                $data = array(
                    'nama_angk' => $this->input->post('nama_angk')
                );
                $result = $this->nama_angkatan_model->insert($data);
                echo json_encode($result);
            }
        } else if ($mode == 'update') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $data = array(
                    'nama_angk' => $this->input->post('nama_angk')
                );
                $result = $this->nama_angkatan_model->update($data, $id);
                echo json_encode($result);
            }
        } else if ($mode == 'delete') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $result = $this->nama_angkatan_model->delete($id);
                echo json_decode($result);
            }
        }
    }
    public function get_by_id()
    {
        $id = $_GET['id'];
        $data = $this->nama_angkatan_model->get_by_id($id);
        echo json_encode($data);
    }
}
