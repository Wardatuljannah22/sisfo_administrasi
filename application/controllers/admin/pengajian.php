<?php

class Pengajian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('upload');
        $this->load->model('pengajian_model');
        $this->load->library('Excel');

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
        $data['hari']        = $this->pengajian_model->get_hari();
        $data['kitab']        = $this->pengajian_model->get_kitab();
        $data['kyai']        = $this->pengajian_model->get_kyai();
        $data['waktu']        = $this->pengajian_model->get_waktu();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role_check'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]);
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar');
        $this->load->view('admin/pengajian/view', $data);
        $this->load->view('templates/footer');
        $this->load->view('admin/pengajian/script.php');
    }

    public function get_all()
    {
        if (!empty($_GET['id_waktu'])) {
            $id_waktu = $_GET['id_waktu'];
        } else if (empty($_GET['id_waktu'])) {
            $id_waktu = null;
        } else if ($_GET['id_waktu'] == 0) {
            $id_waktu = null;
        }
        $data['pengajian']     = $this->pengajian_model->tampil_data($id_waktu);
        $data['hari']          = $this->pengajian_model->get_hari();
        $data['kitab']         = $this->pengajian_model->get_kitab();
        $data['waktu']         = $this->pengajian_model->get_waktu();
        $data['kyai']        = $this->pengajian_model->get_kyai();
        $this->load->view('admin/pengajian/pengajian_harian', $data);
    }
    public function crud($mode)
    {
        if ($mode == 'insert') {
            if ($this->input->is_ajax_request()) {
                $data = array(
                    'id_ngaji' => $this->input->post('id_ngaji'),
                    'id_hari' => $this->input->post('id_hari'),
                    'id_kitab' => set_value('id_kitab'),
                    'id_kyai' => $this->input->post('id_kyai'),
                    'id_w' => $this->input->post('id_w'),

                );
                $result =  $this->pengajian_model->insert($data);
                echo json_decode($result);
            }
        } else if ($mode == 'update') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $data = array(
                    'id_hari' => $this->input->post('id_hari'),
                    'id_kitab' => set_value('id_kitab'),
                    'id_kyai' => $this->input->post('id_kyai'),
                    'id_w' => $this->input->post('id_w'),
                );
                $result = $this->pengajian_model->update($data, $id);
                echo json_encode($result);
            }
        } else if ($mode == 'delete') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $result = $this->pengajian_model->delete($id);
                echo json_encode($result);
            }
        }
    }
    public function get_by_id()
    {
        $id = $this->input->get('id');
        $data = $this->pengajian_model->get_by_id($id);
        echo json_encode($data);
    }
    public function importExcel()
    {
        $fileName = time() . '-' . $_FILES['excel']['name'];
        $config['upload_path'] = './assets/uploads/excel/'; //path upload
        $config['file_name'] = $fileName;  // nama file
        $config['allowed_types'] = 'xls|xlsx|csv'; //tipe file yang diperbolehkan
        $config['max_size'] = 10000; // maksimal sizze

        $this->load->library('upload'); //meload librari upload
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('excel')) {
            echo $this->upload->display_errors();
            exit();
        }

        $inputFileName = './assets/uploads/excel/' . $fileName;
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($row = 2; $row <= $highestRow; $row++) {  // Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
            // Key array harus sesuai dengan nama kolom yang ada di database
            $data = array(
                'id_kyai'  => $rowData[0][0],
                'id_kitab'  => $rowData[0][1],
                'id_hari'  => $rowData[0][2],
                'id_w'  => $rowData[0][3],
            );

            $insert = $this->db->insert("pengajian", $data);
        }
    }
}
