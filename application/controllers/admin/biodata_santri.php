<?php

class biodata_santri extends CI_Controller
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
        $this->load->view('admin/biodata_santri/view.php', $data);
        $this->load->view('templates/footer');
        $this->load->view('admin/biodata_santri/script.php', $data);
    }
    public function get_all()
    {
        //Bagian if else digunakan untuk logika filter.$_GET digunakan mendapatkan value dari ajax yang terdapat di data{}
        if (!empty($_GET['j_kelamin'])) {
            $j_kelamin = $_GET['j_kelamin'];
            $biodata_santri = $this->biodata_santri_model->tampil_data($j_kelamin);
        } else if (empty($_GET['j_kelamin'])) {
            $j_kelamin = null;
            $biodata_santri = $this->biodata_santri_model->tampil_data($j_kelamin);
        } else if ($_GET['j_kelamin'] == 0) {
            $j_kelamin = null;
            $biodata_santri = $this->biodata_santri_model->tampil_data($j_kelamin);
        }
        $data['biodata_santri'] = $biodata_santri;
        $data['univ']           = $this->biodata_santri_model->get_univ();
        $data['nama_angkatan']  = $this->biodata_santri_model->get_angkatan();
        $data['status'] = $this->biodata_santri_model->get_status();
        $this->load->view('admin/biodata_santri/data_biodata_santri', $data);
    }

    public function _rules()
    {
    }



    public function crud($mode)
    {
        if ($mode == 'insert') {
            $config['upload_path']          = './assets/uploads/foto_santri/';
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
                $config['source_image'] = './assets/uploads/foto_santri/' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '100%';
                $config['width'] = 400;
                $config['height'] = 600;
                $config['new_image'] = './assets/uploads/foto_santri/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $data = array(
                    'nis' => $this->input->post('nis'),
                    'nama_santri' => $this->input->post('nama_santri'),
                    'tempat_lahir' => $this->input->post('tempat_lahir'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'jenis_kelamin' => set_value('jenis_kelamin'),
                    'alamat' => $this->input->post('alamat'),
                    'jurusan' => $this->input->post('jurusan'),
                    'id_univ' => $this->input->post('id_univ'),
                    'id_angk' => $this->input->post('id_angk'),
                    'id_status' => $this->input->post('id_status'),
                    'foto' => $gbr['file_name'],
                );
                $result = $this->db->insert('biodata_santri', $data);
                echo json_decode($result);
            }
        } else if ($mode == 'update') {
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
                if (empty($_FILES['foto']['name'])) {
                    // $data['foto']=harus null biar bisa diinsert
                } else {
                    $patch = $this->db->get_where('biodata_santri', ['nis' => $id])->row();
                    if ($patch) {
                        if (file_exists("assets/uploads/foto_santri/" . $patch->foto)) {
                            unlink("assets/uploads/foto_santri/" . $patch->foto);
                        } else {
                        }
                    }
                    $config['upload_path']          = './assets/uploads/foto_santri/';
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
                        $config['source_image'] = './assets/uploads/foto_santri/' . $gbr['file_name'];
                        $config['create_thumb'] = FALSE;
                        $config['maintain_ratio'] = FALSE;
                        $config['quality'] = '100%';
                        $config['width'] = 400;
                        $config['height'] = 600;
                        $config['new_image'] = './assets/uploads/foto_santri/' . $gbr['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                        $data['foto'] = $gbr['file_name'];
                    }
                }
                $result = $this->biodata_santri_model->update($data, $id);
                echo json_decode($result);
            }
        } else if ($mode == 'delete') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $result = $this->biodata_santri_model->delete($id);
                echo json_encode($result);
            }
        }
    }
    public function get_by_id()
    {
        $id = $this->input->get('id');
        $data = $this->biodata_santri_model->get_by_id($id);
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
                'nama_santri'  => $rowData[0][1],
                'tempat_lahir' => $rowData[0][2],
                'tgl_lahir' =>  \PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][3], 'YYYY-MM-DD'),
                'jenis_kelamin' => $rowData[0][4],
                'alamat' => $rowData[0][5],
                'jurusan' => $rowData[0][6],
                'id_univ' => $rowData[0][7],
                'id_angk' => $rowData[0][8],
                'id_status' => $rowData[0][9],
                'foto' => $rowData[0][10]
            );

            $insert = $this->db->insert("biodata_santri", $data);
        }
    }

    // Upload Multi Image With Resize
    public function multipleUpload()
    {
        $config['upload_path'] = './assets/uploads/foto_santri';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 10240;
        $config['encrypt_name'] = FALSE;

        $this->load->library('upload');

        $files = $_FILES;
        $cpt = count($_FILES['files']['name']);
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['files']['name'] = $files['files']['name'][$i];
            $_FILES['files']['type'] = $files['files']['type'][$i];
            $_FILES['files']['tmp_name'] = $files['files']['tmp_name'][$i];
            $_FILES['files']['error'] = $files['files']['error'][$i];
            $_FILES['files']['size'] = $files['files']['size'][$i];

            $this->upload->initialize($config);
            $this->upload->do_upload('files');
            $tmp = $this->upload->data();

            $this->load->library('image_lib');

            //untuk mengatur Resize Multiple
            $config_r['source_image'] = './assets/uploads/foto_santri/' . $tmp['file_name'];
            $config_r['create_thumb'] = FALSE;
            $config_r['maintain_ratio'] = FALSE;
            $config_r['quality'] = 100;
            $config_r['width'] = 300;
            $config_r['height'] = 400;

            //end of configs
            $this->load->library('image_lib', $config_r);
            $this->image_lib->initialize($config_r);
            if (!$this->image_lib->resize())
                echo "Failed." . $this->image_lib->display_errors();
        }
    }
}
