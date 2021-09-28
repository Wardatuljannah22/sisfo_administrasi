<?php

class nama_kamar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('nama_kamar_model');
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
        // $this->load->view('admin/nama_kamar/view.php');
        // $this->load->view('template_admin/footer');
        // $this->load->view('admin/nama_kamar/script.php');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role_check'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('admin/nama_kamar/view.php');
        $this->load->view('templates/footer');
        $this->load->view('admin/nama_kamar/script.php');
    }

    public function get_all()
    {
        // if(!empty($_GET['j_kelamin'])){
        //     $j_kelamin = $_GET['j_kelamin'];
        //     $majelis_santri = $this->majelis_santri_model->tampil_data($j_kelamin);
        // }else if(empty($_GET['j_kelamin'])){
        //     $j_kelamin = null;
        //     $majelis_santri = $this->majelis_santri_model->tampil_data($j_kelamin);
        // }else if($_GET['j_kelamin']== 0){
        //     $j_kelamin = null;
        //     $majelis_santri = $this->majelis_santri_model->tampil_data($j_kelamin);
        // }
        $nama_kamar = $this->nama_kamar_model->get_all();
        $data['nama_kamar'] = $nama_kamar;
        $this->load->view('admin/nama_kamar/data_nama_kamar', $data);
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
                    'nama_ka' => $this->input->post('nama_ka'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'kuota_kamar' => $this->input->post('kuota_ka')
                );
                $result = $this->nama_kamar_model->insert($data);
                echo json_encode($result);
            }
        } else if ($mode == 'update') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $data = array(
                    'nama_ka' => $this->input->post('nama_ka'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'kuota_kamar' => $this->input->post('kuota_ka'),
                );
                $result = $this->nama_kamar_model->update($data, $id);
                echo json_encode($result);
            }
        } else if ($mode == 'delete') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $result = $this->nama_kamar_model->delete($id);
                echo json_decode($result);
            }
        }
    }
    public function get_by_id()
    {
        $id = $_GET['id'];
        $data = $this->nama_kamar_model->get_by_id($id);
        echo json_encode($data);
    }
}
