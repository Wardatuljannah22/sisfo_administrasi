<?php

class Users extends CI_controller{
    // dalam function index ini akan menampilkan semua akun user yg masuk database
    public function index()
    {
        $data['users'] = $this->user_model->tampil_data('users')->result();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/daftar_users',$data);
        $this->load->view('template_admin/footer');
    }

    public function tambah_users()
    {
        $data = array(
        'username' => set_value('username'),
        'password' => set_value('password'),
        'email'    => set_value('email'),
        'level'    => set_value('level'),
        'blokir'   => set_value('blokir'),
        );
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/users_form',$data);
        $this->load->view('template_admin/footer');

    }

    public function tambah_users_aksi()
    {
        $this->_rules();

        if($this->form_validation->run() == FALSE)
        {
            $this->tambah_users(); // untuk memanggil
        }else{
            $data = array(
                'username'    => $this->input->post('username',TRUE),
                'password'    => md5($this->input->post('password',TRUE)),
                'email'       => $this->input->post('email',TRUE),
                'level'       => $this->input->post('level',TRUE),
                'blokir'      => $this->input->post('blokir',TRUE),
                'id_sessions' => md5($this->input->post('id_sessions',TRUE)),
            );
        }
        
        $this->user_model->insert_data($data, 'users');
        $this->session->set_flashdata('pesan', '<div class="alert 
        alert-success alert-dismissable fade show" role="alert">
            Data User Berhasil Ditambahkan!
        <button type="button" class="close" data-dismiss="alert" 
        aria-label="Close"> <span aria-hidden="true">&times;</span>
        </button> </div>');
        redirect('admin/users');
    }

    public function _rules()
    {
        $this->form_validation->set_rules('username','Username','required',['required' => 
        'Username wajib diisi!']);
        $this->form_validation->set_rules('password','Password','required',['required' => 
        'Password wajib diisi!']);
        $this->form_validation->set_rules('email','Email','required',['required' => 
        'Email wajib diisi!']);
        $this->form_validation->set_rules('level','Level','required',['required' => 
        'Level wajib diisi!']);
        $this->form_validation->set_rules('blokir','Blokir','required',['required' => 
        'Blokir wajib diisi!']);
    }

}