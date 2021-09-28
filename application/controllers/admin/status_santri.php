<?php

class status_santri extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('status_santri_model');
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
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role_check'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('admin/status_santri/view.php');
        $this->load->view('templates/footer');
        $this->load->view('admin/status_santri/script.php');
    }

    public function get_all()
    {
        $status_santri = $this->status_santri_model->get_all();
        $data['status_santri'] = $status_santri;
        $this->load->view('admin/status_santri/data_status_santri', $data);
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
                    'nama_status' => $this->input->post('nama_status')
                );
                $result = $this->status_santri_model->insert($data);
                echo json_encode($result);
            }
        } else if ($mode == 'update') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $data = array(
                    'nama_status' => $this->input->post('nama_status')
                );
                $result = $this->status_santri_model->update($data, $id);
                echo json_encode($result);
            }
        } else if ($mode == 'delete') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $result = $this->status_santri_model->delete($id);
                echo json_decode($result);
            }
        }
    }
    public function get_by_id()
    {
        $id = $_GET['id'];
        $data = $this->status_santri_model->get_by_id($id);
        echo json_encode($data);
    }
}
