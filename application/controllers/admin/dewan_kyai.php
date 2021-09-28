<?php

class dewan_kyai extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dewan_kyai_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('upload');
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
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/dewan_kyai/view.php');
        $this->load->view('templates/footer');
        $this->load->view('admin/dewan_kyai/script.php');
    }

    public function get_all()
    {
        $dewan_kyai = $this->dewan_kyai_model->get_all();
        $data['dewan_kyai'] = $dewan_kyai;
        $this->load->view('admin/dewan_kyai/data_dewan_kyai', $data);
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
                $config['upload_path']          = './assets/uploads/foto_kyai/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1024;
                $config['width']                = 300;
                $config['height']               = 400;
                $this->upload->initialize($config);
                if ($this->upload->do_upload("foto")) {
                    $gbr = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/uploads/foto_kyai/' . $gbr['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '100%';
                    $config['width'] = 400;
                    $config['height'] = 600;
                    $config['new_image'] = './assets/uploads/foto_kyai/' . $gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $data = array(
                        'nama_kyai' => $this->input->post('nama_kyai'),
                        'foto' => $gbr['file_name'],
                    );
                    $result = $this->db->insert('dewan_kyai', $data);
                    echo json_decode($result);
                }
            }
        } else if ($mode == 'update') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $data = array(
                    'nama_kyai' => $this->input->post('nama_kyai'),
                );
                if (empty($_FILES['foto']['name'])) {
                    // $data['foto']=harus null biar bisa diinsert
                } else {
                    $patch = $this->db->get_where('dewan_kyai', ['id_kyai' => $id])->row();
                    if ($patch) {
                        if (file_exists("assets/uploads/foto_kyai/" . $patch->foto)) {
                            unlink("assets/uploads/foto_kyai/" . $patch->foto);
                        } else {
                        }
                    }
                    $config['upload_path']          = './assets/uploads/foto_kyai/';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 1024;
                    $config['width']                = 300;
                    $config['height']               = 400;
                    $filename = $this->input->post('nis');
                    $config['file_name'] = $filename;
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload("foto")) {
                        $gbr = $this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './assets/uploads/foto_kyai/' . $gbr['file_name'];
                        $config['create_thumb'] = FALSE;
                        $config['maintain_ratio'] = FALSE;
                        $config['quality'] = '100%';
                        $config['width'] = 400;
                        $config['height'] = 600;
                        $config['new_image'] = './assets/uploads/foto_kyai/' . $gbr['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                        $data['foto'] = $gbr['file_name'];
                    }
                }
                $result = $this->dewan_kyai_model->update($data, $id);
                echo json_decode($result);
            }
        } else if ($mode == 'delete') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $result = $this->dewan_kyai_model->delete($id);
                echo json_decode($result);
            }
        }
    }
    public function get_by_id()
    {
        $id = $_GET['id'];
        $data = $this->dewan_kyai_model->get_by_id($id);
        echo json_encode($data);
    }
}
