<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index() //untuk loginnya
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }


        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header');
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else { // jika berhasil
            $this->_login(); //_ function private

        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        //query select * from table user where emailnya = email
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            //usernya ada
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin/admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
                    Wrong password!
                </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
               This email has not been activated!
                </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
            Email is not registered.
            </div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }


        $this->form_validation->set_rules('name', 'Name', 'required|trim'); //trim untuk spasi tidak masuk database
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This Email has already Registered!'
        ]); //is_unique untuk email unik kurang siku untuk nama tabel(user) dan field(email) db
        $this->form_validation->set_rules('nis', 'Nis', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password1', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match! ',
            'min_length' => 'Password too short!'
        ]); // min_leght batas nulis pass, matches agar sama dengan pass 2
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header');
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name'  => htmlspecialchars($this->input->post('name', true)), // true untuk menghindari ss crose scripting
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT), //enkripsi punyanya php password_hash, PASSWORD_DEFAULT agar dipilihkan yang baik oleh phpnya
                'nis' => htmlspecialchars($this->input->post('nis', true)),
                'role_id' => 2, //member
                'is_active' => 1, // otomatis aktif kalo 1//agar gk aktif dan gk login sebelum aktivasi
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
            Congratulation!. Your Account has been created. Please Login
            </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
            You have been logged out!
            </div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    private function _sendEmail($token, $type) //argumen tokennya 1, kedua type forgot pass
    {

        // Konfigurasi email
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'jannah22@gmail.com',  // Email gmail
            'smtp_pass'   => 'fe103b04',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from('wardatuljannah525@gmail.com', 'Wardatuljannah');

        // Email penerima
        $this->email->to('jannah22@gmail.com'); // Ganti dengan email tujuan

        // Lampiran email, isi dengan url/path file
        $this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

        // Subject email
        $this->email->subject(' Forgot Password | MasRud.com');

        // Isi email
        $this->email->message("Ini adalah contoh email yang dikirim menggunakan SMTP Gmail pada CodeIgniter.<br><br> Klik <strong><a href='https://masrud.com/post/kirim-email-dengan-smtp-gmail' target='_blank' rel='noopener'>disini</a></strong> untuk melihat tutorialnya.");

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }

        // $this->email->initialize($config);
        // // $this->load->library('email', $config); //konfigurasi masuk sebagai parameter librarynya

        // $this->email->from('jannahmu22@gmail.com', 'Sistem Aplikasi Website Administrasi Luhur');
        // $this->email->to($this->input->post('email')); //ngambil dari register sebenrnya

        // if ($type == 'verify') {
        //     $this->email->subject('Account Verification');
        //     $this->email->message('Click this link to verify your account : 
        //         <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        // } else if ($type == 'forgot') {
        //     $this->email->subject('Reset Password');
        //     $this->email->message('Click this link to reset your password : 
        //         <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        // }

        // if ($this->email->send()) { //kalo berhasil dikirim return true,
        //     return true;
        // } else { //kalo gagal tampil errornya apa
        //     echo $this->email->print_debugger();
        //     die; //agar programnya berhenti
        // }
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32)); // pake base64 agar karakter aneh berubah jadi numerik dan huruf
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
                Please check your email to reset your password!
                </div>');
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
               Email is not registered or activated!
                </div>');
                redirect('auth/forgotpassword');
            }
        }
    }
}
