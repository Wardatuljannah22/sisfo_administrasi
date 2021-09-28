<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Welcome Admin';
        $email =  $this->session->userdata('email');
        $this->db->select('b.nama_santri,b.foto');
        $this->db->from('user u');
        $this->db->join('biodata_santri b','b.nis=u.nis','left');
        $this->db->where('u.email',$email);
        $user = $this->db->get();
        $data['biodata'] =$user;
        $data['user'] =$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role_check'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
}
