<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Register';

        $this->load->view('register', $data);
    }

    // public function tambah_user_simpan_customer()
    // {
    //     $this->load->model('user_model');
    //     $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[confirm_password]');
    //     $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|min_length[3]|matches[password]');

    //     $nama = $this->input->post('nama');
    //     $email = $this->input->post('email');
    //     $password = md5($this->input->post('password'));
    //     $alamat = $this->input->post('alamat');
    //     $gender = $this->input->post('gender');
    //     $no_telp = $this->input->post('no_telp');
    //     $no_ktp = $this->input->post('no_ktp');
    //     $level = 2;

    //     $scan_ktp = $_FILES['scan_ktp']['name'];

    //     if ($scan_ktp = '') {
    //     } else {
    //         $config['upload_path'] = './assets/upload/user';
    //         $config['allowed_types'] = 'jpg|jpeg|png';

    //         $this->load->library('upload', $config);
    //         if (!$this->upload->do_upload('scan_ktp')) {
    //             echo "<script>alert('Scan KTP Gagal di Upload')</script>";
    //             echo "<script>window.location='" . base_url('register') . "'; </script>";
    //             return;
    //         } else {
    //             $scan_ktp = $this->upload->data('file_name');
    //         }
    //     }

    //     $scan_kk = $_FILES['scan_kk']['name'];

    //     if ($scan_kk = '') {
    //     } else {
    //         $config['upload_path'] = './assets/upload/user';
    //         $config['allowed_types'] = 'jpg|jpeg|png';

    //         $this->load->library('upload', $config);
    //         if (!$this->upload->do_upload('scan_kk')) {
    //             echo "<script>alert('Scan KK Gagal di Upload')</script>";
    //             echo "<script>window.location='" . base_url('register') . "'; </script>";
    //             return;
    //         } else {
    //             $scan_kk = $this->upload->data('file_name');
    //         }
    //     }

    //     $data = array(
    //         'nama' => $nama,
    //         'email' => $email,
    //         'password' => $password,
    //         'alamat' => $alamat,
    //         'gender' => $gender,
    //         'no_telp' => $no_telp,
    //         'no_ktp' => $no_ktp,
    //         'scan_ktp' => $scan_ktp,
    //         'scan_kk' => $scan_kk,
    //         'level' => $level
    //     );

    //     $this->user_model->insert_data($data, 'user');
    //     $this->session->set_flashdata('pesan', '
    //     <div class="alert alert-success alert-dismissible fade show" role="alert">
    //     Registrasi berhasil, silahkan login.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //     <span aria-hidden="true">&times;</span></button></div>');
    //     redirect('auth/login');
    // }

    public function tambah_user_simpan_customers()
    {
        //Validation Rules
        $this->load->model('user_model');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'valid_email' => 'Email yang anda masukkan tidak benar.',
            'required' => 'Kolom email harus diisi!',
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
?>
        <script src="<?= base_url('assets/assets_stisla') ?>/assets/js/sweetalert2.all.min.js"></script>

        <body></body>
        <?php

        if ($this->form_validation->run() == FALSE) {
            //Views
            $data['title'] = 'Register';
            $this->load->view('register', $data);
        } else {
            //Create Data Array
            $nama          = $this->input->post('nama');
            $email         = $this->input->post('email');
            $password      = md5($this->input->post('password'));
            $alamat        = $this->input->post('alamat');
            $gender        = $this->input->post('gender');
            $no_telp       = $this->input->post('no_telp');
            $no_ktp        = $this->input->post('no_ktp');
            $gambar_user   = 'default-avatar.png';
            $level         = 2;

            $scan_ktp = $_FILES['scan_ktp']['name'];

            if ($scan_ktp = '') {
            } else {
                $config['upload_path'] = './assets/upload/user';
                $config['allowed_types'] = 'jpg|jpeg|png';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('scan_ktp')) {
        ?>
                    <script>
                        Swal({
                            title: 'Gagal',
                            type: 'error',
                            text: 'Scan KTP Gagal di Upload, File harus berupa JPG,PNG, atau JPEG!'
                        }).then((result => {
                            window.location = '<?= site_url('register') ?>';
                        }))
                    </script>;
                <?php
                    // echo "<script>alert('Scan KTP Gagal di Upload')</script>";
                    // echo "<script>window.location='" . base_url('register') . "'; </script>";
                    return;
                } else {
                    $scan_ktp = $this->upload->data('file_name');
                }
            }

            $scan_kk = $_FILES['scan_kk']['name'];

            if ($scan_kk = '') {
            } else {
                $config['upload_path'] = './assets/upload/user';
                $config['allowed_types'] = 'jpg|jpeg|png';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('scan_kk')) {
                ?>
                    <script>
                        Swal({
                            title: 'Gagal',
                            type: 'error',
                            text: 'Scan KK Gagal di Upload, File harus berupa JPG,PNG, atau JPEG!'
                        }).then((result => {
                            window.location = '<?= site_url('register') ?>';
                        }))
                    </script>;
<?php
                    // echo "<script>alert('Scan KK Gagal di Upload')</script>";
                    // echo "<script>window.location='" . base_url('register') . "'; </script>";
                    return;
                } else {
                    $scan_kk = $this->upload->data('file_name');
                }
            }

            $data = array(
                'nama' => $nama,
                'email' => $email,
                'password' => $password,
                'alamat' => $alamat,
                'gender' => $gender,
                'no_telp' => $no_telp,
                'no_ktp' => $no_ktp,
                'scan_ktp' => $scan_ktp,
                'scan_kk' => $scan_kk,
                'gambar_user' => $gambar_user,
                'level' => $level
            );

            $this->user_model->insert_data($data, 'user');
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                Registrasi berhasil, silahkan login.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></div>');
            redirect('auth/login');
        };
    }
}

    /* End of file Register.php */;
