<?php

class Majelis_santri extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('majelis_santri_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('upload');
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
        $data['jabatan_ms']     = $this->majelis_santri_model->get_jabatan();
        $data['univ']           = $this->majelis_santri_model->get_univ();
        $data['nama_angkatan']  = $this->majelis_santri_model->get_angkatan();
        $data['biodata_santri']     = $this->majelis_santri_model->get_biodata();
        // $this->load->view('templates/header');
        // $this->load->view('user/index');
        // $this->load->view('admin/majelis_santri/view', $data);
        // $this->load->view('templates/footer');
        // $this->load->view('admin/majelis_santri/script.php');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role_check'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('admin/majelis_santri/view.php', $data);
        $this->load->view('templates/footer');
        $this->load->view('admin/majelis_santri/script.php');
    }
    public function get_all()
    {
        if (!empty($_GET['j_kelamin'])) {
            $j_kelamin = $_GET['j_kelamin'];
            $majelis_santri = $this->majelis_santri_model->tampil_data($j_kelamin);
        } else if (empty($_GET['j_kelamin'])) {
            $j_kelamin = null;
            $majelis_santri = $this->majelis_santri_model->tampil_data($j_kelamin);
        } else if ($_GET['j_kelamin'] == 0) {
            $j_kelamin = null;
            $majelis_santri = $this->majelis_santri_model->tampil_data($j_kelamin);
        }
        $data['majelis_santri'] = $majelis_santri;
        $data['jabatan_ms']     = $this->majelis_santri_model->get_jabatan();
        $data['univ']           = $this->majelis_santri_model->get_univ();
        $data['nama_angkatan']  = $this->majelis_santri_model->get_angkatan();
        $data['biodata_santri']     = $this->majelis_santri_model->get_biodata();
        $this->load->view('admin/majelis_santri/data_majelis_santri', $data);
    }

    public function _rules()
    {
    }

    // public function detail($nis){
    // 	$this->load->model('majelis_santri_model');
    // 	$detail = $this->majelis_santri_model->detail_data($nis);
    // 	$data['detail'] = $detail;
    // 	$this->load->view('templates/header');
    // 	$this->load->view('templates/sidebar');
    // 	$this->load->view('detail', $data);
    // 	$this->load->view('templates/footer');
    // }

    public function crud($mode)
    {
            if ($mode == 'insert') {
                $data = array(
                    'nis'           => $this->input->post('nis_ms'),
                    'id_jabatan'    => $this->input->post('id_jabatan'),
                );
                $query = $this->db->insert('majelis_santri', $data);
                echo json_decode($result);
            } else if ($mode == 'update') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $data = array(
                    'nis'       => $this->input->post('nis_ms'),
                    'id_jabatan'    => $this->input->post('id_jabatan'),
                );
                $result = $this->majelis_santri_model->update($data, $id);
                echo json_decode($result);
            }
        }else if ($mode == 'delete') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $result = $this->majelis_santri_model->delete($id);
                echo json_encode($result);
            }
        }
    }
    public function get_by_id()
    {
        $id = $this->input->get('id');
        $data = $this->majelis_santri_model->get_by_id($id);
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
                'nis'  => $rowData[0][0],
                'id_jabatan' => $rowData[0][1],

            );

            $insert = $this->db->insert("majelis_santri", $data);
        }
    }
    public function get_biodata() {
        $nis = $_GET['nis'];
        $data = $this->majelis_santri_model->get_biodata_santri($nis);
        echo json_encode($data);
    }
}
