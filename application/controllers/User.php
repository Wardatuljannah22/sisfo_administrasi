<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
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
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role_check'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    // public function edit()
    // {
    //     $data['title'] = 'Edit Profile';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['role_check'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]);

    //     $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('user/edit', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $name = $this->input->post('name'); //kenapa kok post? karena kalo pakke multipart pasti post
    //         $email = $this->input->post('email');

    //         //cek jika ada gambara yang akan diupload
    //         $upload_image = $_FILES['image']['name'];

    //         if ($upload_image) {
    //             $config['allowed_types'] = 'gif|jpg|png';
    //             $config['max_size'] = '2048';
    //             $config['upload_path'] = './assets/img/profile/';

    //             $this->load->library('upload', $config);

    //             if ($this->upload->do_upload('image')) {
    //                 $old_image = $data['user']['image'];
    //                 if ($old_image != 'default.jpg') {
    //                     unlink(FCPATH . 'assets/img/profile/' . $old_image); //pake alamat lengkapnya front controllernya
    //                 }

    //                 $new_image = $this->upload->data('file_name');
    //                 $this->db->set('image', $new_image);
    //             } else {
    //                 echo $this->upload->display_errors();
    //             }
    //         }

    //         $this->db->set('name', $name); //yang diubah namanya
    //         $this->db->where('email', '$email'); //pake query builder jadi ini ditaruh diatasnya emal
    //         $this->db->update('user');

    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
    //         You Profile has been updated!
    //         </div>');
    //         redirect('user');
    //     }
    // }

    public function changepassword()
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

        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role_check'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]);

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else { //kalo validasi lolos
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) { //kzlo gk sama
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
                Wrong current password!
                </div>'); //harus tau dulu passwordnya yang lama
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) { //pass lama dan baru kalo sama gk boleh
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
                    New password cannot be the same as current password!
                    </div>');
                    redirect('user/changepassword');
                } else { // kalo pass beda aman
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT); //acak password

                    $this->db->set('password', $password_hash); //set pass baru yg sudah di hash
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user'); //baru ubah password

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
               Password changed!
                </div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    // public function form_santri()
    // {
    //     $data['biodata_santri']    = $this->biodata_santri_model->get_biodata_santri();
    //     $this->load->view('user/form_santri/data_biodata_santri', $data);

    //     ($mode == 'update') { 
    //         if ($this->input->is_ajax_request()) {
    //             $id = $this->input->post('id');
    //             $data = array(
    //                 'nama_santri' => $this->input->post('nama_santri'),
    //                 'tempat_lahir' => $this->input->post('tempat_lahir'),
    //                 'tgl_lahir' => $this->input->post('tgl_lahir'),
    //                 'jenis_kelamin' => set_value('jenis_kelamin'),
    //                 'alamat' => $this->input->post('alamat'),
    //                 'jurusan' => $this->input->post('jurusan'),
    //                 'id_univ' => $this->input->post('id_univ'),
    //                 'id_angk' => $this->input->post('id_angk'),
    //                 'id_status' => $this->input->post('id_status'),
    //             );
    //             if (empty($_FILES['foto']['name'])) {
    //                 // $data['foto']=harus null biar bisa diinsert
    //             } 

    //     }
    // }
}
