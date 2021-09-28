<?php

class FormSantri extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('biodata_santri_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('upload');
        $this->load->library('Excel');
        // Your own constructor code
    }
    public function index()
    {
        $data['univ']           = $this->biodata_santri_model->get_univ();
        $data['nama_angkatan']  = $this->biodata_santri_model->get_angkatan();
        $data['status'] = $this->biodata_santri_model->get_status();
        $email =  $this->session->userdata('email');
        $this->db->select('b.nama_santri,b.foto');
        $this->db->from('user u');
        $this->db->join('biodata_santri b','b.nis=u.nis','left');
        $this->db->where('u.email',$email);
        $user = $this->db->get();
        $data['biodata'] =$user;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role_check'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]);
        // $this->load->view('template_admin/header');
        // $this->load->view('template_admin/sidebar');
        // $this->load->view('admin/biodata_santri/view', $data);
        // $this->load->view('template_admin/footer');
        // $this->load->view('admin/biodata_santri/script.php');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/form_santri/view.php', $data);
        $this->load->view('templates/footer');
        $this->load->view('admin/form_santri/script.php', $data);
    }
    public function get_all()
    {
        $email =  $this->session->userdata('email');
        //Bagian if else digunakan untuk logika filter.$_GET digunakan mendapatkan value dari ajax yang terdapat di data{}
        $biodata_santri = $this->biodata_santri_model->tampil_data_satu($email);
        $data['biodata_santri'] = $biodata_santri;
        $data['univ']           = $this->biodata_santri_model->get_univ();
        $data['nama_angkatan']  = $this->biodata_santri_model->get_angkatan();
        $data['status'] = $this->biodata_santri_model->get_status();
        $this->load->view('admin/form_santri/data_biodata_santri', $data);
    }
    public function crud($mode)
    {
        if ($mode == 'update') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $data = array(
                    'nama_santri' => $this->input->post('nama_santri'),
                    'tempat_lahir' => $this->input->post('tempat_lahir'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'jenis_kelamin' => set_value('jenis_kelamin'),
                    'alamat' => $this->input->post('alamat'),
                    'jurusan' => $this->input->post('jurusan'),
                    'id_univ' => $this->input->post('id_univ'),
                    'id_angk' => $this->input->post('id_angk'),
                    'id_status' => $this->input->post('id_status'),
                );
                $result = $this->biodata_santri_model->update($data, $id);
                echo json_decode($result);
            }
        }
    }
    public function get_by_id()
    {
        $id = $this->input->get('id');
        $data = $this->biodata_santri_model->get_by_id($id);
        echo json_encode($data);
    }
}
