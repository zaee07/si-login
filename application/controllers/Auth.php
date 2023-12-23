<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property form_validation $form_validation
 * @property session $session
 * @property db $db
 * @property input $input
 */

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if($this->form_validation->run() == false ) {
            $this->goToDefaultPage();
            $data['title'] = 'sistem login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validasinya success
            $this->_login();
        }
    }

    private function _login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // echo password_verify('wahudi', '$2y$10$ef8ZZIZqIxBtVATED0YbLe/gju/5OA5fZCycJoQZx/wiwkH3Zedyu');die;

        $user = $this->db->get_where( 'users', ['email' => $email] )->row_array();
        // var_dump($user);die;

        if($user != null ) {
            # jika usernya aktif
            if ($user["is_active"] == 1) {
                # cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id'=> $user['user_role_id']
                    ];

                    $this->session->set_userdata($data);
                    $user['user_role_id'] != 2 ? redirect("admin"):redirect("account");//perubahan index jadi user 
                    // redirect('user');

                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">Password salah!</div>');
                    redirect('auth/');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">Email belum diaktivasi</div>');
                redirect('auth/');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">Email tidak terdaftar</div>');
            redirect('auth/');
        }
    }
    
    public function registrasi() {
        $this->goToDefaultPage();
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if( $this->form_validation->run() == false ) {
            $data['title'] = 'sistem pendaftaran';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasi');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post("email", true);
            $data = [
                "name" => htmlspecialchars($this->input->post("name", true)),
                "email" => htmlspecialchars($email),
                "image" => '1.png',
                "password" => htmlspecialchars( password_hash( $this->input->post("password1", true), PASSWORD_DEFAULT ) ),
                "user_role_id" => 2,
                "is_active" => 0, 
                "created" => time()
            ];

            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('users_token', $user_token);
            $this->db->insert('users', $data);
            $this->_sendemail($token, 'verify');
            $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible" role="alert">Email berhasil dikirim! silahkan aktivasi</div>');
            redirect('auth');
        }
    }

    private function _sendemail($token, $type) {
        // ini dari stackoverflow
        // $this->load->library('email');   
        $config = array();
        $config['protocol']     = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
        $config['smtp_host']    = "ssl://smtp.googlemail.com";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
        $config['smtp_user']    = "sublik85@gmail.com"; // client email gmail id
        $config['smtp_pass']    = "grpf tean akrt xual "; // client password
        $config['smtp_port']    =  465;
        // $config['smtp_crypto']  = 'ssl';
        // $config['smtp_timeout'] = "";
        $config['mailtype']     = 'html';
        $config['charset']      = "utf-8";
        $config['newline']      = "\r\n";
        // $config['wordwrap']     = TRUE;
        // $config['validate']     = FALSE;
        $this->load->library('email', $config);
        $email = $this->input->post('email');

        $this->email->from('sublik85@gmail.com', 'Ihza Ecosystem')->to($email);
        if ( $type == 'verify' ) {
            $this->email->subject('Verification')->message('klik untuk verifikasi : <a href="'. base_url() . 'auth/verify?email=' . $email . '&token=' . urlencode($token) . '">Activate</a>');
        } else {
            $this->email->subject('Reset Password')->message('klik untuk mengubah password : <a href="'. base_url() . 'auth/resetpassword?email=' . $email . '&token=' . urlencode($token) . '">Reset</a>');
        }
        
        if( $this->email->send() ) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify() {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('users', ['email' =>$email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('users_token', ['token' => $token])->row_array();
            // var_dump($user_token);echo "<hr>Okc9voirB/7yxO6Oeu2q5KDFfgCiZXQwyRA9MKmc+w8=<hr>";var_dump($this->db->queries);die;

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60*60*24)) {
                    $this->db->set('is_active', 1)->where('email', $email)->update('users');
                    $this->db->delete('users_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible" role="alert">Berhasil aktivasi</div>');
                    redirect('auth');
                }else{
                    $this->db->delete('users', ['email' => $email]);
                    $this->db->delete('users_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">gagal Aktivasi! karena kadaluarsa</div>');
                    redirect('auth');
                }

            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">gagal Aktivasi! karena token aneh</div>');
                redirect('auth');
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">gagal Aktivasi! karena email aneh</div>');
            redirect('auth');
        }
    }

    public function logout() {
        // $this->_deleteSession();

        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible" role="alert">Berhasil Logout</div>');
        redirect('auth');
    }

    public function goToDefaultPage() {
        if ($this->session->userdata('role_id')) {
            redirect("account");
        }
    }

    public function blocked() {
        $this->load->view('auth/blocked');
    }

    public function forgotPassword() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('users', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert('users_token', $user_token);
                $this->_sendemail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert">cek kotak masuk untuk mereset password!</div>');
                redirect('auth/forgotPassword');
            }else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">Email belum terdaftar atau belum aktif!</div>');
                redirect('auth/forgotPassword');
            }
        }
    }

    public function resetPassword() {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('users_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60*60*24)) {
                    //$this->db->set('is_active', 1)->where('email', $email)->update('users');
                    //$this->db->delete('users_token', ['email' => $email]);

                    $this->session->set_userdata('reset_email', $email);
                    $this->changePassword();
                }else{
                    $this->db->delete('users', ['email' => $email]);
                    $this->db->delete('users_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">gagal karena kadaluarsa</div>');
                    redirect('auth');
                }

                // $this->session->set_userdata('reset_email', $email);
                // $this->changePassword();

            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">gagal karena token aneh</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">gagal karena email aneh</div>');
            redirect('auth');
        }
    }

    public function changePassword() {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }
        $this->form_validation->set_rules('password1', 'password', 'trim|required|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'konfirmasi password', 'trim|required|min_length[6]|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password)->where('email', $email)->update('users');
            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible" role="alert">Berhasil ! silahkan login</div>');
            redirect('auth');
        }
    }
}