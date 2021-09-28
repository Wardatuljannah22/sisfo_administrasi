<?php

class Data_kamar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('data_kamar_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('upload');
        $this->load->library('Excel');
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
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role_check'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]);
        $data['nama_kamar']    = $this->data_kamar_model->get_kamar();
        $data['nama_angkatan'] = $this->data_kamar_model->get_angkatan();
        $data['status']        = $this->data_kamar_model->get_status();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/data_kamar/view.php', $data);
        $this->load->view('templates/footer');
        $this->load->view('admin/data_kamar/script.php');
    }

    public function get_all()
    {
        if (!empty($_GET['j_kelamin'])) {
            $j_kelamin = $_GET['j_kelamin'];
            $data_kamar = $this->data_kamar_model->tampil_data($j_kelamin);
        } else if (empty($_GET['j_kelamin'])) {
            $j_kelamin = null;
            $data_kamar = $this->data_kamar_model->tampil_data($j_kelamin);
        } else if ($_GET['j_kelamin'] == 0) {
            $j_kelamin = null;
            $data_kamar = $this->data_kamar_model->tampil_data($j_kelamin);
        }
        $data['data_kamar']     = $data_kamar;
        $data['nama_kamar']     = $this->data_kamar_model->get_kamar();
        $data['nama_angkatan']  = $this->data_kamar_model->get_angkatan();
        $data['status']         = $this->data_kamar_model->get_status();
        $this->load->view('admin/data_kamar/daftar_kamar', $data);
    }

    public function crud($mode)
    {
        if ($mode == 'insert') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $data = array(
                    'id_ka' => $this->input->post('id_ka'),
                    'nama_penghuni' => $this->input->post('nama_penghuni'),
                    'jenis_kelamin' => set_value('jenis_kelamin'),
                    'kuota_kamar' => $this->input->post('kuota_ka'),
                    'id_angk' => $this->input->post('id_angk'),
                    'id_status' => $this->input->post('id_status'),
                );
                $result =  $this->data_kamar_model->insert($data, $id);
                echo json_decode($result);
            }
        } else if ($mode == 'update') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $data = array(
                    'nama_penghuni' => $this->input->post('nama_penghuni'),
                    'jenis_kelamin' => set_value('jenis_kelamin'),
                    'kuota_kamar' => $this->input->post('kuota_kamar'),
                    'id_angk' => $this->input->post('id_angk'),
                    'id_status' => $this->input->post('id_status'),
                );
                $result = $this->data_kamar_model->update($data, $id);
                echo json_encode($result);
            }
        } else if ($mode == 'delete') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $result = $this->data_kamar_model->delete($id);
                echo json_encode($result);
            }
        }
    }
    public function get_by_id()
    {
        $id = $this->input->get('id');
        $data = $this->data_kamar_model->get_by_id($id);
        echo json_encode($data);
    }
    public function get_kuota()
    {
        $id_ka = $_GET['id_ka'];
        $data = $this->data_kamar_model->get_kuota($id_ka);
        echo json_encode($data);
    }
}
