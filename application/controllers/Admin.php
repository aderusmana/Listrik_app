<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
    }

    public function index()
    {
        $this->load->view('auth/v_adminlogin');
    }

    public function admin_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi.'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password harus diisi.'));
        if ($this->form_validation->run() == TRUE) {
            if ($this->M_admin->do_admin_login()->num_rows() > 0) {
                $data = $this->M_admin->do_admin_login()->row();
                $dataadmin = array(
                    'login' => TRUE,
                    'username' => $data->username,
                    'nama_admin' => $data->nama_admin,
                    'level' => $data->id_level,
                    'id_admin' => $data->id_admin
                );
                $this->session->set_userdata($dataadmin);
                redirect('Dashboard', 'refresh');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal Login. Periksa username dan password Anda!</div>');
                redirect('Admin');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning">' . validation_errors() . '</div>');
            redirect('Admin');
        }
    }

    public function data_admin()
    {
        $data['konten'] = 'masterdata/v_admin';
        $data['count'] = $this->M_admin->do_admin_hitung();
        $data['admin'] = $this->M_admin->do_admin_tampil();
        $data['level'] = $this->M_admin->do_level_tampil();
        $data['active'] = 'Admin';
        $data['judul'] = 'Admin';
        $this->load->view('layout/template', $data);
    }

    public function admin_tambah()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi.'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password harus diisi.'));
        $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'trim|required', array('required' => 'Nama Admin harus diisi.'));
        $this->form_validation->set_rules('id_level', 'Level', 'trim|required', array('required' => 'Level harus diisi.'));
        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('tambah')) {
                if ($this->M_admin->do_admin_tambah() == TRUE) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses menambah admin.</div>');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menambah admin.</div>');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Terjadi kesalahan pada jaringan.</div>');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning">' . validation_errors() . '</div>');
        }
        redirect('Admin/data_admin');
    }

    public function get_admin_id($id)
    {
        $data = $this->M_admin->get_dataadmin_id($id);
        echo (json_encode($data));
    }

    public function admin_ubah()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi.'));
        $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'trim|required', array('required' => 'Nama Admin harus diisi.'));
        $this->form_validation->set_rules('id_level', 'Level', 'trim|required', array('required' => 'Level harus diisi.'));
        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('ubah')) {
                if ($this->M_admin->do_admin_ubah() == TRUE) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses mengubah admin.</div>');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal mengubah admin.</div>');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Terjadi kesalahan pada jaringan.</div>');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning">' . validation_errors() . '</div>');
        }
        redirect('Admin/data_admin');
    }

    public function admin_hapus($id = '')
    {
        $hapus = $this->M_admin->do_admin_hapus($id);
        if ($hapus == TRUE) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses menghapus admin.</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menghapus admin.</div>');
        }
        redirect('Admin/data_admin');
    }

    public function admin_logout()
    {
        $this->session->sess_destroy();
        redirect('/', 'refresh');
    }
}
