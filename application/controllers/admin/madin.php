<?php

class Madin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('madin_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('upload');
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
        $data['kelas'] = $this->madin_model->get_kelas();
        $data['mapel'] = $this->madin_model->get_mapel();
        $data['hari'] = $this->madin_model->get_hari();
        // $this->load->view('templates/header');
        // $this->load->view('user/index');
        // $this->load->view('admin/madin/view', $data);
        // $this->load->view('templates/footer');
        // $this->load->view('admin/madin/script.php');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role_check'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('admin/madin/view.php', $data);
        $this->load->view('templates/footer');
        $this->load->view('admin/madin/script.php');
        // $this->load->view('template_admin/header');
        // $this->load->view('template_admin/sidebar');
        // $this->load->view('admin/madin/view',$data);
        // $this->load->view('template_admin/footer');
    }

    public function get_all()
    {
        if (!empty($_GET['id_hari'])) {
            $id_hari = $_GET['id_hari'];
        } else if (empty($_GET['id_hari'])) {
            $id_hari = null;
        } else if ($_GET['id_hari'] == 0) {
            $id_hari = null;
        }
        $data['madin'] = $this->madin_model->tampil_data($id_hari);
        $data['kelas'] = $this->madin_model->get_kelas();
        $data['mapel'] = $this->madin_model->get_mapel();
        $data['hari'] = $this->madin_model->get_hari();
        $this->load->view('admin/madin/keg_madin', $data);
    }

    public function crud($mode)
    {
        if ($mode == 'insert') {
            if ($this->input->is_ajax_request()) {
                $data = array(
                    'id_ma' => $this->input->post('id_ma'),
                    'id_kelas' => $this->input->post('id_kelas'),
                    'nama_ust' => $this->input->post('nama_ust'),
                    'id_mapel' => $this->input->post('id_mapel'),
                    'id_hari' => $this->input->post('id_hari'),
                );
                $result = $this->madin_model->insert($data);
                echo json_encode($result);
            }
        } else if ($mode == 'update') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $data = array(
                    'id_kelas' => $this->input->post('id_kelas'),
                    'nama_ust' => $this->input->post('nama_ust'),
                    'id_mapel' => $this->input->post('id_mapel'),
                    'id_hari' => $this->input->post('id_hari'),
                );
                $result = $this->madin_model->insert($data, $id);
                echo json_encode($result);
            }
        } else if ($mode == 'delete') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $result = $this->madin_model->delete($id);
                echo json_encode($result);
            }
        }
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

        for ($row = 3; $row <= $highestRow; $row++) {  // Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
            // Key array harus sesuai dengan nama kolom yang ada di database
            $data = array(
                'id_kelas'  => $rowData[0][1],
                'nama_ust'  => $rowData[0][2],
                'id_mapel' => $rowData[0][3],
                'id_hari' => $rowData[0][4]
            );

            $insert = $this->db->insert("madin", $data);
        }
    }

    public function get_by_id()
    {
        $id = $_GET['id'];
        $data = $this->madin_model->get_by_id($id);
        echo json_encode($data);
    }
}
