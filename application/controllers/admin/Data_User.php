<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model('pesan_model');
        $this->load->model('user_model');
        $this->load->model('transaksi_model');
    }

    public function index()
    {
        $data['title'] = 'Data User';
        $data['user'] = $this->user_model->get_data('user')->result();
        $data['transaksi'] = $this->transaksi_model->get_data_transaksi()->result();
        $data['pesan'] = $this->pesan_model->get_data_user('pesan')->result();

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/data_user', $data);
        $this->load->view('template_admin/footer');
    }

    public function tambah_user()
    {
        $data['title'] = 'Form Tambah Data User';
        $data['pesan'] = $this->pesan_model->get_data_user('pesan')->result();
        $data['transaksi'] = $this->transaksi_model->get_data_transaksi()->result();

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/form_tambah_user');
        $this->load->view('template_admin/footer');
    }

    public function tambah_user_simpan()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambah_user();
        } else {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $alamat = $this->input->post('alamat');
            $gender = $this->input->post('gender');
            $no_telp = $this->input->post('no_telp');
            $no_ktp = $this->input->post('no_ktp');
            $level = $this->input->post('level');

            $scan_ktp = $_FILES['scan_ktp']['name'];

            if ($scan_ktp = '') {
            } else {
                $config['upload_path'] = './assets/upload/user';
                $config['allowed_types'] = 'jpg|jpeg|png';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('scan_ktp')) {
                    echo "Scan KTP user Gagal Di-Upload";
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
                    echo "Scan KK user Gagal Di-Upload";
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
                'level' => $level
            );

            $this->user_model->insert_data($data, 'user');
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data User Berhasil Ditambahkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('admin/data_user');
        }
    }

    public function edit_user($id)
    {
        $where = array('id_user' => $id);
        $data['title'] = 'Form Ubah Data User';
        $data['user'] = $this->db->query("SELECT * FROM user us WHERE us.id_user='$id'")->result();
        $data['pesan'] = $this->pesan_model->get_data_user('pesan')->result();
        $data['transaksi'] = $this->transaksi_model->get_data_transaksi('transaksi')->result();

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/form_edit_user', $data);
        $this->load->view('template_admin/footer');
    }

    public function edit_user_simpan()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telepon', 'required');
        $this->form_validation->set_rules('no_ktp', 'No KTP', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        if ($this->input->post('password')) {
        $this->form_validation->set_rules('password', 'Password', 'min_length[4]', [
            'min_length' => 'minimal 4 karakter'
        ]);
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'matches[password]');
    }

        $id = $this->input->post('id_user');
        if ($this->form_validation->run() == FALSE) {
            $this->edit_user($id);
        } else {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $alamat = $this->input->post('alamat');
            $gender = $this->input->post('gender');
            $no_telp = $this->input->post('no_telp');
            $no_ktp = $this->input->post('no_ktp');
            $level = $this->input->post('level');
            
            // Prepare data array
            $data = array(
                'nama' => $nama,
                'email' => $email,
                'alamat' => $alamat,
                'gender' => $gender,
                'no_telp' => $no_telp,
                'no_ktp' => $no_ktp,
                'level' => $level
            );

            // Only set the password if it's provided
            if ($this->input->post('password')) {
                $data['password'] = md5($this->input->post('password'));
            }

            // Handle file uploads
            if ($_FILES['scan_ktp']['name']) {
                $config['upload_path'] = './assets/upload/user';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('scan_ktp')) {
                    $scan_ktp = $this->upload->data('file_name');
                    $data['scan_ktp'] = $scan_ktp;
                } else {
                    echo $this->upload->display_errors();
                }
            }

            if ($_FILES['scan_kk']['name']) {
                $config['upload_path'] = './assets/upload/user';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('scan_kk')) {
                    $scan_kk = $this->upload->data('file_name');
                    $data['scan_kk'] = $scan_kk;
                } else {
                    echo $this->upload->display_errors();
                }
            }

            if ($_FILES['gambar_user']['name']) {
                $config['upload_path'] = './assets/upload/gambar_user';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar_user')) {
                    $gambar_user = $this->upload->data('file_name');
                    $data['gambar_user'] = $gambar_user;
                } else {
                    echo $this->upload->display_errors();
                }
            }

            // Update user data
            $where = array('id_user' => $id);
            $this->user_model->edit_data('user', $data, $where);
            
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data User Berhasil Diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('admin/data_user');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telepon', 'required');
        $this->form_validation->set_rules('no_ktp', 'No KTP', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
    }

    // public function detail_user($id)
    // {
    //     $data['title'] = 'Detail Data User';
    //     $data['detail'] = $this->user_model->ambil_id_user($id);

    //     $this->load->view('template_admin/header', $data);
    //     $this->load->view('template_admin/sidebar', $data);
    //     $this->load->view('admin/detail_user', $data);
    //     $this->load->view('template_admin/footer');
    // }

    public function delete_user($id)
    {
        $where = array('id_user' => $id);
        $this->user_model->delete_data($where, 'user');
        $this->session->set_flashdata('pesan', '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Data User Berhasil Dihapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('admin/data_user');
    }

    //fitur print laporan
    function laporan_print()
    {
        $data['title'] = 'Laporan Daftar Customer';
        $data['user'] = $this->user_model->get_data('user')->result();
        $this->load->view('admin/laporan_user_print', $data);
    }
}
