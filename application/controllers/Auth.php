<?php

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function login()
    {
        $data['title'] = 'Login';

        $this->load->view('login', $data);
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($post['login'])) {
            $query = $this->user_model->login($post);
            ?>
            <script src="<?= base_url('assets/assets_stisla') ?>/assets/js/sweetalert2.all.min.js"></script>
            <body></body>
            <?php
            if ($query->num_rows() > 0) {
                $row = json_decode(json_encode($query->row()), true);
                // $params = array(
                //     'id_user' => $row->id_user,
                //     'email' => $row->email,
                //     'nama' => $row->nama,
                //     'alamat' => $row->alamat,
                //     'level' => $row->level
                // );
                $this->session->set_userdata($row);
                if ($row['level'] == 1) {
                    ?>
                    <script>
                        Swal({
                            title: 'Login',
                            type: 'success',
                            text: 'Berhasil login sebagai Admin!'
                        }).then((result => {
                            window.location ='<?= site_url('admin/dashboard') ?>';
                        }))
                    </script>;
                    <?php
                } else {
                    ?>
                    <script>
                        Swal({
                            title: 'Login',
                            type: 'success',
                            text: 'Berhasil login!'
                        }).then((result => {
                            window.location ='<?= site_url('customer/dashboard') ?>';
                        }))
                    </script>;
                    <?php
                }
            } else {
                $this->session->set_flashdata('pesan', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                email atau password Anda salah!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></div>');
                redirect('auth/login');
            }
            
        }
    }

    public function logout()
    {
        $params = array('id_user', 'level');
        $this->session->unset_userdata($params);
        $this->session->set_flashdata('pesan', '
        <div class="alert alert-info alert-dismissible fade show" role="alert">
        Anda telah keluar!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button></div>');
        redirect('auth/login');
    }

    public function ganti_password()
    {
        $data['title'] = 'Ganti Password';
        $this->load->view('ganti_password', $data);
    }

    public function ganti_password_aksi()
    {
        $password_baru = $this->input->post('password_baru');
        $password_confirm = $this->input->post('password_confirm');

        $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|trim|min_length[3]|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|trim|min_length[3]|matches[password_baru]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Ganti Password';
            $this->load->view('ganti_password', $data);
        } else {
            $data = array('password' => md5($password_baru));
            $id = array('id_user' => $this->session->userdata('id_user'));

            $this->user_model->ubah_password($id, $data, 'user');
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Password berhasil diubah, silahkan login.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('auth/login');
        }
    }

    public function ubah_profile($id)
    {
        // $data['title'] = 'Ubah Profile';
        // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['user'] = $this->db->get_where('user', ['alamat' => $this->session->userdata('alamat')])->row_array();
        $data['title'] = 'Ubah Profil';
        // $data['user'] = $this->user_model->get_data(['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['user'] = $this->db->query("SELECT * FROM user WHERE id_user='$id'")->result();

        if ($id !== $this->session->userdata('id_user')) {
            $ci = &get_instance();
            if ($ci->fungsi->user_login()->level == 1) {
                redirect('admin/dashboard');
            } else {
                redirect('customer/dashboard');
            }
        }

        $this->load->view('ubah_profile', $data);
    }

    public function ubah_profile_aksi()
    {
        $id = $this->session->userdata('id_user');
        $data['user'] = $this->db->query("SELECT * FROM user WHERE id_user='$id'")->result();

        $nama_baru = $this->input->post('nama_baru');
        $alamat_baru = $this->input->post('alamat_baru');
        $password_baru = $this->input->post('password_baru');
        $password_confirm = $this->input->post('password_confirm');
        $gambar_baru = $_FILES['gambar_user']['name'];

        $this->form_validation->set_rules('nama_baru', 'Nama Baru', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('alamat_baru', 'Alamat Baru', 'required|trim|min_length[3]');
        if (!empty($password_baru)){
            $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|trim|min_length[3]|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|trim|min_length[3]|matches[password_baru]');
        };

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Ubah Profile';
            $this->load->view('ubah_profile', $data);
            // $this->ubah_profile($data);

        } else {
            $data_baru = array(
                'nama' => $nama_baru,
                'alamat' => $alamat_baru);
                if (!empty($password_baru)){
                    $data_baru['password'] = md5($password_baru);
                };
                $id = array('id_user' => $this->session->userdata('id_user'));
                $data['user'] = json_decode(json_encode($data['user']), true);
                // var_dump($data);

            if ($gambar_baru) {
                $config['upload_path'] = './assets/upload/gambar_user';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['maintain_ratio'] = 'TRUE';
        
                $this->load->library('upload', $config);
        
                if ($this->upload->do_upload('gambar_user')) {
                    $gambar_lama = $data['user'][0]['gambar_user'];
                    if($gambar_lama != 'default-avatar.png' && file_exists(FCPATH . 'assets/upload/gambar_user/' . $gambar_lama)) {
                        unlink(FCPATH . 'assets/upload/gambar_user/' . $gambar_lama); }
                    $data_baru['gambar_user'] = $this->upload->data('file_name');
                    // var_dump(FCPATH . 'assets/upload/gambar_user/' . $gambar_lama);
                }
            }

            $this->user_model->ubah_profile($id, $data_baru, 'user');
            // dd($id['id_user']);
            $idUser = $id['id_user'];
            $updatedUser = $this->db->query("SELECT * FROM user WHERE id_user='$idUser'")->result();
            $updatedUser = json_decode(json_encode($updatedUser), true);
            $this->session->set_userdata($updatedUser[0]);
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Profile berhasil diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('auth/ubah_profile/' . $idUser);
        }
    }
}